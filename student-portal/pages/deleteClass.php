<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

if(isset($_GET['classID'])){
    $classID= $_GET['classID'];

    $sql = "DELETE FROM classes WHERE classID=$classID";
    $connect->query($sql);
}

header('location: classes.php');
exit;


?>