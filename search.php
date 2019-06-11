<?php
require_once __DIR__ . "/model/database.php";

$search = $_GET["search"];
$category_id = ($_GET["category_id"] != "") ? $_GET["category_id"] : null;

$projects = searchProject($search, $category_id);
require_once __DIR__ . "/layout/header.php";
?>

    <section class="container">
        <h1>Résultats de la recherche :</h1>
        <div class="actions">
            <?php foreach ($projects as $project) : ?>
                <?php include __DIR__ . "/include/project_inc.php"; ?>
            <?php endforeach; ?>
        </div>
    </section>


<?php require_once __DIR__ . "/layout/footer.php"; ?>