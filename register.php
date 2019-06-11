<?php
require_once __DIR__ . "/layout/header.php";

?>
<section class="container">
    <form method="post" action="register-query.php">
        <input type="text" name="pseudo" placeholder="pseudo">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit">
    </form>
</section>

<?php require_once __DIR__ . "/layout/footer.php"; ?>