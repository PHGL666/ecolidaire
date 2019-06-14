<?php
require_once __DIR__ . "/../../security.php";
require_once __DIR__ . "/../../../model/database.php";

// Récupérer les données du formulaire
$title = $_POST["title"];
$categoryId = $_POST["category_id"];
$filePicture = $_FILES["picture"];
$picture = $filePicture["name"];
$description = $_POST["description"];
$price = $_POST["price"];
$dateStart = $_POST["date_start"];
$dateEnd = $_POST["date_end"];
$memberIds = $_POST["member_ids"];

if ($dateEnd != "" && $dateStart > $dateEnd) {
    $_SESSION["flash"][] = ["type" => "danger", "message" => "Dates incorrectes !"];
    header("Location: create-form.php");
    exit;
} else {
    move_uploaded_file($filePicture["tmp_name"], "../../../images/$picture");

    // Envoyer les données à la base de données
    insertProject($title, $picture, $description, $price, $dateStart, $dateEnd, $categoryId, $memberIds);
}

// Rediriger l'utilisateur
header("Location: index.php");