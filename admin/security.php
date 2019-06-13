<?php

session_start();

require_once __DIR__ . "/../model/database.php";

$user = null;

// Vérifier si l'utilisateur essaie de se connecter
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = getUserByEmailPassword($email, $password);
    if ($user) {
        $_SESSION["id"] = $user["id"];
    }
// Si l'utilisateur est déjà connecté
} else if (isset($_SESSION["id"])) {
    $user = getOneRow("user", $_SESSION["id"]);
}

if (!$user) {
    header("Location: login.php");
} else if (!$user["admin"]) {
    header("Location: ../");
}
