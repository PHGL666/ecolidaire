<?php

function getAllProjects(int $id = null, int $limit = 0) {
    global $connection;

    $query = "
        SELECT
            project.*,
            DATE_FORMAT(project.date_start, '%d/%m/%Y') AS date_start_format,
            category.label AS category,
            COUNT(phm.member_id) AS nb_members
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN project_has_member AS phm ON project.id = phm.project_id
    ";

    // Si l'identifiant d'un projet est défini, on ajoute une clause WHERE
    if ($id != null) {
        $query .= " WHERE project.id = $id";
    }

    $query .= " GROUP BY project.id
                ORDER BY project.date_start DESC";

    // Si la limite du nombre de lignes est supérieur à zéro, on ajoute une clause LIMIT
    if ($limit > 0) {
        $query .= " LIMIT $limit";
    }

    $stmt = $connection->prepare($query);
    $stmt->execute();

    // Si la requête ne retourne qu'une seule ligne, la fonction renvoie uniquement cette ligne
    if ($id != null || $limit == 1) {
        return $stmt->fetch();
    } else {
        return $stmt->fetchAll();
    }
}

function getAllProjectsByCategory(int $id) : array {
    global $connection;

    $query = "
        SELECT
            project.*,
            DATE_FORMAT(project.date_start, '%d/%m/%Y') AS date_start_format,
            category.label AS category,
            COUNT(phm.member_id) AS nb_members
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN project_has_member AS phm ON project.id = phm.project_id
        WHERE category.id = :id
        GROUP BY project.id
        ORDER BY project.date_start DESC
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function searchProjects(string $search, ?int $categoryId) : array {
    global $connection;

    $query = "
        SELECT
            project.*,
            DATE_FORMAT(project.date_start, '%d/%m/%Y') AS date_start_format,
            category.label AS category,
            COUNT(phm.member_id) AS nb_members,
            MATCH(project.title, project.description) AGAINST ('$search') AS score
        FROM project
        INNER JOIN category ON project.category_id = category.id
        LEFT JOIN project_has_member AS phm ON project.id = phm.project_id
        WHERE 1 = 1
    ";

    if ($search != "") {
        $query .= " AND (project.title LIKE '%$search%' OR project.description LIKE '%$search%')";
    }

    if ($categoryId != null) {
        $query .= " AND category.id = $categoryId";
    }

    $query .= " GROUP BY project.id
                ORDER BY score DESC
    ";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}