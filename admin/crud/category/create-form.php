<?php require_once __DIR__ . "/../../layout/header.php"; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des catégories</h1>
    </div>
    <form method="post" action="create-query.php">
        <div class="form-group">
            <label>Libellé</label>
            <input type="text" name="label" class="form-control" placeholder="Libellé" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>