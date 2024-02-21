<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
include("../phpFiles/dbConnect.php");

// Check if the user is logged in
if (!isset($_SESSION["loggedIn"]) || ($_SESSION["accRole"] !== "student" && $_SESSION["accRole"] !== "teacher")) {
    header("Location: login.php");
    exit();
}

// Debugging
// echo "User Email: " . $_SESSION["activeUser"];

// Get the email of the logged-in user (student or teacher)
$loggedInUserEmail = $_SESSION["activeUser"];

// Determine the user type (student or teacher)
$userType = ($_SESSION["accRole"] === "student") ? "students" : "teachers";

// Query to get user details based on email and user type
$userQuery = "SELECT * FROM $userType WHERE email = '$loggedInUserEmail'";
$resultUser = mysqli_query($connect, $userQuery);

// Check if the query was successful
if (!$resultUser) {
    die("Query failed: " . mysqli_error($connect) . "<br>Query: " . $userQuery);
}

// Fetch the user details
$userDetails = mysqli_fetch_assoc($resultUser);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Portal</title>
    <?php include("../pages/header.php"); ?>
    <link rel="stylesheet" href="../styles/adminDashboard.css">
</head>

<body>
    <div>

    
        <?php

        include('ssidebar.php'); 
        ?>

    </div>
</body>

</html>
