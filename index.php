<?php require_once __DIR__ . "/layout/header.php"; ?>
<?php require_once __DIR__ . "/model/database.php";

$projects = getAllProject(null,3);
$categories = getAllRows("category");
?>


    <header class="home-banner">
        <h1>Bienvenue sur <strong>Ecolidaire</strong></h1>
        <p>Let's go Green!</p>
        <form method="get" action="search.php">
            <input type="text" name="search" placeholder="Rechercher...">
            <select name="category_id">
                <option value="">Choisissez votre catégorie</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category["id"];?>"><?= $category["label"];?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit">
        </form>
    </header>

    <section class="container">
        <h2>Nos dernières actions</h2>
        <div class="actions">
            <?php foreach ($projects as $project) : ?>
                <?php require __DIR__ . "/include/project_inc.php"; ?>
            <?php endforeach; ?>
        </div>
    </section>

<?php require_once __DIR__ . "/layout/footer.php"; ?>