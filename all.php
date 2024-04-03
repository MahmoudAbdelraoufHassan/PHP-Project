<?php
include("pdoDb.php");
    $data = $connect->prepare("SELECT l.* , c.ategory_name from listings as l 
    inner join categories as c on c.categ_id = l.category_id");
$data->execute();
$res = $data->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);
?>