<?php
include("pdoDb.php");
if(isset($_POST["category"])){
    $data = $connect->prepare("SELECT l.* , c.ategory_name from listings as l 
    inner join categories as c on c.categ_id = l.category_id
    where c.ategory_name = :value");
$category =$_POST['category'];
$data->bindParam(':value', $category, PDO::PARAM_STR);
$data->execute();
$res = $data->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);
}
?>