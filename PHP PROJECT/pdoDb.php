<?php
    $db = 'mysql:host=localhost;dbname=project';
    $username = 'root';
    $password = '12345678';
    try {
        $connect = new PDO($db, $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e) {
    echo 'Field'. $e->getMessage();
}
    ?>