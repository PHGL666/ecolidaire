<article class="action">
    <a href="project.php?id=<?= $project["id"]; ?>">
        <img src="images/<?= $project["picture"]; ?>" alt="<?= $project["title"]; ?>">
        <footer class="overlay">
            <div class="info">
                <div class="tag"><?= number_format($project["price"], 0, ',', ' '); ?> €</div>

                <?php if ($project["date_end"] == null): ?>
                    <div class="tag">En cours</div>
                <?php endif; ?>

                <h3><?= $project["title"]; ?></h3>
            </div>
            <div class="more-info">
                <div class="action-info">
                    <i class="fa fa-calendar"></i>
                    <?= $project["date_start_format"]; ?>
                </div>
                <div class="action-info">
                    <i class="fa fa-tag"></i>
                    <?= $project["category"]; ?>
                </div>
                <div class="action-info">
                    <i class="fa fa-users"></i>
                    <?= $project["nb_members"]; ?>
                </div>
            </div>
        </footer>
    </a>
</article>