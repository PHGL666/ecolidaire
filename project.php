<?php

require_once __DIR__ . "/model/database.php";

$id = $_GET["id"];
$project = getAllProject($id);
$membres = getAllMembersByProject($id);
$pictures = getAllRows("project_picture", ["project_id" => $id]);

require_once __DIR__ . "/layout/header.php";
?>
<section class="container">
    <h1><?= $project["title"]; ?></h1>
    <p>
        <a href="category.php?id=<?= $project["category_id"]; ?>"><?= $project["category_label"]; ?></a>
    </p>
    <h2><?= $project["nb_members"]; ?> membre(s) ont participés à ce projet</h2>
    <ul>
        <?php foreach ($membres as $membre) : ?>
            <li>
                <?= $membre["firstname"]; ?>
                <?= $membre["lastname"]; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="grid col-4">
        <?php foreach ($pictures as $picture) : ?>
            <img src="images/<?= $picture["filename"]; ?>" class="img-cover" alt="<?= $picture["alt"]; ?>">
        <?php endforeach; ?>
    </div>

    <p><?= $project["description"]; ?></p>
</section>


<?php require_once __DIR__ . "/layout/footer.php"; ?>
