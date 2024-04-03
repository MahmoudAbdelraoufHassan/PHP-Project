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

$sql = "SELECT * FROM applications WHERE organizer_id='$_SESSION[id]' AND applicant_id='$_GET[id]' AND listing_id='$_GET[id_job]'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: employer.php");
    exit();
}


$sql = "UPDATE applications SET status='2' WHERE organizer_id='$_SESSION[id]' AND applicant_id='$_GET[id]' AND listing_id='$_GET[id_job]'";
if ($conn->query($sql) === TRUE) {
    header("Location: employer_requests.php");
    exit();
}

?>