<?php

include("../phpFiles/dbConnect.php");

if(isset($_GET['studentID'])){
    $id = $_GET['studentID'];

    $sql = "DELETE FROM students WHERE studentID=$id";
    $connect->query($sql);
}

header('location: student.php');
exit;


?>