<?php
require_once __DIR__ . "/../model/database.php";
$categories = getAllRows("category");

?>
</main>
<footer class="site-footer">
    <div class="container">
        Copyright © 2013 Ecolidaire
        <?php foreach ($categories as $category) : ?>
            <a href="category.php?id=<?= $category["id"]; ?>"><?= $category["label"]; ?></a>
        <?php endforeach; ?>
        <form method="post" action="footer-query.php">
            <input type="text" name="label" placeholder="Catégorie">
            <input type="submit">
        </form>
    </div>
</footer>

</body>
</html>