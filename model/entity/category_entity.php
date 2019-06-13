<?php

function insertCategory(string $label) : bool {
    global $connection;

    $query = "
        INSERT INTO category (label)
        VALUES (:label)
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":label", $label);

    return $stmt->execute();
}

function updateCategory(int $id, string $label) {
    global $connection;

    $query = "UPDATE category SET label = :label WHERE id = :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":label", $label);

    return $stmt->execute();
}