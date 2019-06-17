<?php

require_once __DIR__ . "/../../security.php";
require_once __DIR__ . "/../../../model/database.php";

//Récupérer les données du formulaire
$title = $_POST["title"];
$categoryId = $_POST["category_id"];
$filePicture = $_FILES["picture"];
$picture = $filePicture["name"];
$description = $_POST["description"];
$price = $_POST["price"];
$dateStart = $_POST["date_start"];
$dateEnd = $_POST["date_end"];
$memberIds = $_POST["member_ids"];

// Envoyer les données à la base de données
updateProject($id, $title, $categoryId, $picture, $description, $price, $dateStart, $dateEnd);

// Rediriger l'utilisateur
header("Location: index.php");