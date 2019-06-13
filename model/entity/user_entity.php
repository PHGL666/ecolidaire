<?php

function getUserByEmailPassword(string $email, string $password) {
    global $connection;

    $query = "SELECT * FROM user WHERE email = :email";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (password_verify($password, $user["password"])) {
        return $user;
    } else {
        return false;
    }
}

function insertUser(string $pseudo, string $email, string $password, int $isAdmin = 0) : bool {
    global $connection;

    $query = "
        INSERT INTO user (pseudo, email, password, admin)
        VALUES (:pseudo, :email, :password, :admin)
    ";

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":pseudo", $pseudo);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":admin", $isAdmin);

    return $stmt->execute();
}