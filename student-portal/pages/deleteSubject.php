<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../phpFiles/dbConnect.php");

if(isset($_GET['subjectID'])){
    $subjectID = $_GET['subjectID'];

    $sql = "DELETE FROM subjects WHERE subjectID=$subjectID";
    $connect->query($sql);
}

header('location: subject.php');
exit;


?>