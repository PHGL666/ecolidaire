<?php
require_once __DIR__ . "/../../config/parameters.php";
require_once __DIR__ . "/../security.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= SITE_ADMIN; ?>node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= SITE_ADMIN; ?>node_modules/font-awesome/css/font-awesome.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?= SITE_ADMIN; ?>css/dashboard.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Administration</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?= SITE_ADMIN; ?>logout.php">Déconnexion</a>
        </li>
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?= SITE_URL; ?>">
                <i class="fa fa-external-link"></i>
                Front
            </a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <?php require_once __DIR__ . "/menu.php"; ?>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

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