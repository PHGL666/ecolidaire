<?php
require_once __DIR__ . "/../../../model/database.php";

$id = $_GET["id"];
$project = getOneRow("project", $id);
$categories = getAllRows("category");
$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php";
?>

<h1>Modifier le projet</h1>

<form method="post" action="update-query.php" enctype="multipart/form-data">
    <div class="form-group">
        <label>Libellé</label>
        <input type="text" name="label" maxlength="255" value="<?= $project["title"]; ?>" class="form-control" placeholder="Libellé" required>
    </div>
    <input type="hidden" name="id" value="<?= $project["id"]; ?>">
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category_id" class="form-control">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category["id"]; ?>">
                    <?= $category["label"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="picture" value="<?= $project["picture"]; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"><?= $project["description"]; ?></textarea>
    </div>
    <div class="form-group">
        <label>Prix</label>
        <input type="number" name="price" value="<?= $project["price"]; ?>" class="form-control" placeholder="Prix" required>
    </div>
    <div class="form-group">
        <label>Date de début</label>
        <input type="date" name="date_start" value="<?= $project["date_start"]; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Date de fin</label>
        <input type="date" name="date_end" value="<?= $project["date_end"]; ?>" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-check"></i>
        Modifier
    </button>
</form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>


