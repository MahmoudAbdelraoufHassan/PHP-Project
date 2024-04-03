<?php
include("pdoDb.php");
    $input = $_POST["input"];
    $res = $connect->prepare("SELECT l.* , c.ategory_name 
     FROM listings as l 
     inner join categories as c
     on c.categ_id = l.category_id
     WHERE title LIKE CONCAT(:input, '%')");
    $res->bindValue(':input', $input, PDO::PARAM_STR);
    $res->execute();
    $result = $res->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>