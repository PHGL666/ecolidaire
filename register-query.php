<?php
require_once __DIR__ . "/model/database.php";

//Récupérer les données du formulaire

$pseudo = $_POST["pseudo"];
$email = $_POST["email"];
$password = $_POST["password"];

// Envoyer les données à la base de données
insertUser($pseudo, $email,$password);

// Rediriger l'utilisateur
header("Location: index.php");