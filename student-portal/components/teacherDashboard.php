<?php
include("../phpFiles/dbConnect.php"); // Include your database connection file
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedIn"]) || $_SESSION["accRole"] !== "teacher") {
    header("Location: login.php");
    exit();
}

// Get the email of the logged-in teacher
$loggedInTeacherEmail = $_SESSION["activeUser"];

// Query to get teacher details based on email
$teacherQuery = "SELECT * FROM teachers WHERE email = '$loggedInTeacherEmail'";
$resultTeacher = mysqli_query($connect, $teacherQuery);

// Check if the query was successful
if (!$resultTeacher) {
    die("Query failed: " . mysqli_error($connect) . "<br>Query: " . $teacherQuery);
}

// Fetch the teacher details
$teacherDetails = mysqli_fetch_assoc($resultTeacher);

// // Debugging: Display the retrieved data
// var_dump($teacherDetails);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Faculty Portal</title>
    <?php include("../pages/header.php"); ?>
    <link rel="stylesheet" href="../styles/adminDashboard.css">
</head>

<body>
    <div class="welcome-message">
    <?php

include('tsidebar.php'); 
?>
    </div>
    <!-- Other teacher-specific content here -->
</body>

</html>
