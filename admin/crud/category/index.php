<?php
require_once __DIR__ . "/../../../model/database.php";

$categories = getAllRows("category");

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Gestion des catégories</h1>

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
                <td></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>