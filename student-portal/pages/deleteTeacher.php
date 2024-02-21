<?php

include("../phpFiles/dbConnect.php");

if(isset($_GET['teacherID'])){
    $id = $_GET['teacherID'];

    $sql = "DELETE FROM teachers WHERE teacherID=$id";
    $connect->query($sql);
}

header('location: teacher.php');
exit;


?>