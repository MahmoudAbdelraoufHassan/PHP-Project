<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if (empty($_SESSION['id'])) {
    header("login.php");
    exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once ("db.php");

$sql = "SELECT * FROM listings WHERE user_id='$_SESSION[id]'  AND id='$_GET[id]'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: employer.php");
    exit();
}


$sql = "DELETE  FROM listings WHERE user_id='$_SESSION[id]' AND id='$_GET[id]'";
if ($conn->query($sql) === TRUE) {
    header("Location: employerJob.php");
    exit();
}

?>