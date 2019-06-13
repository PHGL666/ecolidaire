<?php
require_once __DIR__ . "/model/database.php";

$id = $_GET["id"];
$project = getAllProjects($id);
$members = getAllMembersByProject($id);
$pictures = getAllRows("project_picture", ["project_id" => $id]);

require_once __DIR__ . "/layout/header.php";
?>

    <section class="container">
        <h1><?= $project["title"]; ?></h1>
        <p>
            Catégorie : <a href="category.php?id=<?= $project["category_id"]; ?>"><?= $project["category"]; ?></a>
        </p>
        <h2><?= $project["nb_members"]; ?> membre(s) sur ce projet</h2>
        <ul>
            <?php foreach ($members as $member) : ?>
                <li>
                    <?= $member["firstname"]; ?>
                    <?= $member["lastname"]; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="grid col-4">
            <?php foreach ($pictures as $picture) : ?>
                <img src="images/<?= $picture["filename"]; ?>" class="img-cover" alt="<?= $picture["alt"]; ?>">
            <?php endforeach; ?>
        </div>
    </section>


<?php require_once __DIR__ . "/layout/footer.php"; ?>