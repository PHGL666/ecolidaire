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