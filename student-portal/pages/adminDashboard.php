<?php
    session_start(); // Start the session

    include("../phpFiles/dbConnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Student Portal</title>
    <?php include("../pages/header.php");?>
    <link rel="stylesheet" href="../styles/adminDashboard.css">
</head>
<body>
    <div class="container">
        <?php 
            // if(isset($_SESSION["accRole"]) && $_SESSION["accRole"] == "Teacher"){
                include('adminSidebar.php'); 
            // }else{
            //     include('sidebar.php'); 
            // } 
        ?>  
    </div>
</body>
</html>
