<?php
require_once __DIR__ . "/../../../model/database.php";

$categories = getAllRows("category");
$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Créer un projet</h1>

    <form method="post" action="create-query.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" placeholder="Titre" required>
        </div>
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
            <input type="file" name="picture" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="price" class="form-control" placeholder="Prix" required>
        </div>
        <div class="form-group">
            <label>Date de début</label>
            <input type="date" name="date_start" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date de fin</label>
            <input type="date" name="date_end" class="form-control">
        </div>
        <div class="form-group">
            <label>Membres</label>
            <select name="member_ids[]" multiple class="form-control">
                <?php foreach ($members as $member) : ?>
                    <option value="<?= $member["id"]; ?>">
                        <?= $member["firstname"] . " " . $member["lastname"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>