<?php
require_once __DIR__ . "/../../../model/database.php";

$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Ajouter un membre</h1>

    <form method="post" action="create-query.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="firstname" class="form-control" placeholder="Prénom" required>
        </div><div class="form-group">
            <label>Nom</label>
            <input type="text" name="lastname" class="form-control" placeholder="Nom" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="picture" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>