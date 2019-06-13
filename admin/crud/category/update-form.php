<?php
require_once __DIR__ . "/../../../model/database.php";

$id = $_GET["id"];
$category = getOneRow("category", $id);

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Modifier une catégorie</h1>

    <form method="post" action="update-query.php">
        <div class="form-group">
            <label>Libellé</label>
            <input type="text" name="label" maxlength="255" value="<?= $category["label"]; ?>" class="form-control" placeholder="Libellé" required>
        </div>
        <input type="hidden" name="id" value="<?= $category["id"]; ?>">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Modifier
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>