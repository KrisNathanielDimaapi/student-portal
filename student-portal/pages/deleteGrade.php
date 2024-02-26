<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

if(isset($_GET['gradeID'])){
    $gradeID= $_GET['gradeID'];

    $sql = "DELETE FROM grades WHERE gradeID=$gradeID";
    $connect->query($sql);
}

header('location: result.php');
exit;


?>