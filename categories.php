<?php

include("pdoDb.php");
$data = $connect->prepare("SELECT count(l.category_id) as listing_count, c.ategory_name 
FROM categories as c
left join listings as l on l.category_id = c.categ_id
group by c.ategory_name;");
$data->execute();
$rows=$data->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rows);

?>