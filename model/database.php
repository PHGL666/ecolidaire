<?php

require_once __DIR__ . "/../config/parameters.php";

// Création de la connexion à la base de données
try {
    $connection = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4', lc_time_names = 'fr_FR'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $exception) {
    echo "Erreur de connexion à la base de données";
    exit;
}

/**
 * Récupérer l'ensemble des ligne d'un table
 * @param string $table Nom de la table
 * @param array $conditions Liste des conditions dans la clause WHERE
 * @param int $limit Nombre de ligne à retourner
 * @return array Liste des données retournées
 */

function getAllRows(string $table, array $conditions = [], int $limit = 0): array
{
    global $connection;

    // Stock la requête SQL dans une variable
    $query = "SELECT * FROM $table";

    //["project_id" => 2, "date_start" => "2019-06-15"]
    $query .= " WHERE 1 = 1";
    foreach ($conditions as $key => $value) {
        $query .= " AND $key = :$key";
    }

    if ($limit > 0) {
        $query = $query . " LIMIT $limit";
    }

    // Préparer la requête SQL
    $stmt = $connection->prepare($query);
    foreach ($conditions as $key => $value) {
        $stmt->bindParam(":$key", $value);
    }
    $stmt->execute(); // Executer la requête

    // Récupérer l'ensemble des résultats de la requête
    return $stmt->fetchAll();
}

/**
 * Récupérer une ligne d'un table
 * @param string $table Nom de la table
 * @param int $id L'identifiant de la ligne
 * @return array    La ligne retournée
 */
function getOneRow(string $table, int $id): array
{
    global $connection;

    $query = "SELECT * FROM $table WHERE id = :id";

    // Préparer la requête SQL
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Executer la requête

    // Récupérer l'ensemble des résultats de la requête
    return $stmt->fetch();
}

function getAllProject(int $id = null, int $limit = 0)
{
    global $connection;

    $query = "
        SELECT 
            project.*,
            DATE_FORMAT(date_start,'%d/%m/%Y') AS date_fr,
            category.label AS category_label,
            COUNT(phm.member_id) AS nb_members
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN  project_has_member phm on project.id = phm.project_id
        ";


    if ($id != null) {
        $query .= " WHERE project.id = $id";
    }

    $query .= " GROUP BY project.id
                ORDER BY project.date_start DESC";

    //Si la limite du nombre de ligne est supérieur a zéro, on ajoute une clause LIMIT
    if ($limit > 0) {
        $query = $query . " LIMIT $limit";
    }

    // Préparer la requête SQL
    $stmt = $connection->prepare($query);
    $stmt->execute(); // Executer la requête

    //Si la requête ne retourne qu'une seule ligne, la fonction renvoie uniquement cette ligne
    if ($id != null || $limit == 1) {
        return $stmt->fetch();
    } else {
        return $stmt->fetchAll();
    }
}

function getAllMembersByProject(int $id): array
{

    global $connection;

    $query = "
        SELECT *
        FROM member
        LEFT JOIN  project_has_member phm ON member.id = phm.member_id
        WHERE phm.project_id = :id
        ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Executer la requête

    return $stmt->fetchAll();
}

function getAllProjectByCategory(int $id): array
{

    global $connection;

    $query = "
        SELECT 
            project.*,
            DATE_FORMAT(date_start,'%d/%m/%Y') AS date_fr,
            category.label AS category_label,
            COUNT(phm.member_id) AS nb_members
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN  project_has_member phm on project.id = phm.project_id
        WHERE category.id = :id
        GROUP BY project.id
        ORDER BY project.date_start DESC
        ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Executer la requête

    return $stmt->fetchAll();
}

function insertUser(string $pseudo, string $email, string $password, int $isAdmin = 0)
{
    global $connection;

    $query = "
        INSERT INTO user(pseudo, email, password, admin)
        VALUES (:pseudo, :email, :password, :admin)
        ";

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":pseudo", $pseudo);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":admin", $isAdmin);

    return $stmt->execute(); // Executer la requête
}

function insertCategory(string $label): bool
{
    global $connection;

    $query = "
        INSERT INTO category(label)
        VALUES (:label)
        ";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":label", $label);

    return $stmt->execute(); // Executer la requête
}

function searchProject(string $search, ?int $categoryId): array
{

    global $connection;

    $query = "
        SELECT
            project.*,
            DATE_FORMAT(project.date_start, '%d/%m/%Y') AS date_fr,
            category.label AS category_label,
            COUNT(phm.member_id) AS nb_members,
            MATCH(project.title, project.description) AGAINST ('eaux') AS score
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN project_has_member AS phm ON project.id = phm.project_id
        WHERE 1 = 1
    ";
    if ($search != ""){
        $query .= " AND (project.title LIKE '%$search%'  OR project.description LIKE '%$search%')";
    }

    if ($categoryId != null){
        $query .= " AND category.id = $categoryId";
    }
    $query .= " GROUP BY project.id
                ORDER BY score DESC
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getUserByEmailPassword(string $email, $password) {
    global $connection;

    $query = "SELECT * FROM user WHERE email = :email";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (password_verify($password, $user["password"])) {
        return $user;
    } else {
        return false;
    }
}

/**
 * Supprimer une ligne d'un table
 * @param string $table Nom de la table
 * @param int $id L'identifiant de la table
 * @return ?int Null ou code erreur
 */
function deleteRow(string $table, int $id): ?int {
    global $connection;

    $query = "DELETE FROM $table WHERE id = :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
    } catch (PDOException $exception) {
        return $exception->getCode();
    }
    return null;
}

function updateCategory(int $id, string $label) {
    global $connection;

    $query = "UPDATE category SET label = :label WHERE id = :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":label", $label);

    return $stmt->execute();
}
