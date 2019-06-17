<?php

function getAllMembersByProject(int $id) : array {
    global $connection;

    $query = "
        SELECT *
        FROM member
        INNER JOIN project_has_member AS phm ON member.id = phm.member_id
        WHERE phm.project_id = :id
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

function insertMember(string $firstname, string $lastname, string $picture)
{
    global $connection;

    $query = "
       INSERT INTO member(firstname, lastname, picture)
       VALUES(:firstname, :lastname, :picture)
   ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":picture", $picture);
    $stmt->execute();

    $memberId = $connection->lastInsertId();

}