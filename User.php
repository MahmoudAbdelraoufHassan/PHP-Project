<?php

function getUserById($id, $db)
{
    $sql = $db->prepare("SELECT * FROM users WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();


    if ($result->num_rows > 0) {

        return $result->fetch_assoc();
    } else {
        return null;
    }
}

?>