<?php
require_once __DIR__ . "/../../../model/database.php";

$categories = getAllRows("category");

require_once __DIR__ . "/../../layout/header.php";
?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des catégories</h1>
        <a href="create-form.php" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Ajouter
        </a>
    </div>

    <div>
        <?php if (isset($_SESSION["flash"])): ?>
            <?php foreach ($_SESSION["flash"] as $error) : ?>
                <div class="alert alert-<?= $error["type"]; ?> alert-dismissible fade show">
                    <?= $error["message"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION["flash"]); ?>
        <?php endif; ?>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Libellé</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?= $category["label"]; ?></td>
                <td>
                    <form action="delete-query.php" method="post">
                        <input type="hidden" name="id" value="<?= $category["id"]; ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>