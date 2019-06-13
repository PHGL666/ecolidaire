<?php
require_once __DIR__ . "/../../../model/database.php";

$projects = getAllProjects();

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Gestion des projets</h1>

    <a href="create-form.php" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        Ajouter
    </a>

    <hr>

    <table class="table table-striped table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Image</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project) : ?>
            <tr>
                <td><?= $project["title"]; ?></td>
                <td><?= $project["category"]; ?></td>
                <td>
                    <img src="../../../images/<?= $project["picture"]; ?>" class="img-thumbnail">
                </td>
                <td><?= $project["price"]; ?></td>
                <td class="actions">
                    <div class="d-flex justify-content-around">
                        <a href="update-form.php?id=<?= $project["id"]; ?>" class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                            Modifier
                        </a>
                        <form method="post" action="delete-query.php">
                            <input type="hidden" name="id" value="<?= $project["id"]; ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>