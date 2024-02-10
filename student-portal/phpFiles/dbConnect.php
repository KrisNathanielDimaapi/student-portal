<?php
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "student_portal";

    try{
        $conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
    }catch(mysqli_sql_exception){
        echo "Connection Error!";
    }
?>