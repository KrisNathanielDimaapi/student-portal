<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../phpFiles/dbConnect.php"); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION["loggedIn"]) || ($_SESSION["accRole"] !== "student" && $_SESSION["accRole"] !== "teacher")) {
    header("Location: login.php");
    exit();
}

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


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Portal</title>
    <?php include("../pages/header.php"); ?>
    <link rel="stylesheet" href="../styles/adminDashboard.css">
    <link rel="stylesheet" type="text/css" href="../styles/sidebar.css" />
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentLocation = window.location.href;

            var menuLinks = document.querySelectorAll('.menu a');

            menuLinks.forEach(function(link) {
                if (link.href === currentLocation) {
                    link.parentElement.classList.add('active');
                }
            });
        });
    </script>
</head>

<nav>
    <div class="logo">
        <img src="../images/bths_logo.ico">
        <span class="nav-item">Bauan Technical High School<br>Student Portal</span>
    </div>
    
    <ul class="menu">
        <li>
            <a href="../pages/studentClasses.php">
                <i class="fa-solid fa-people-roof"></i>
                <span>Classes</span>
            </a>
        </li>
        <li>
            <a href="../pages/studentSubject.php">
                <i class="fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>
        </li>
        <li>
            <a href="../pages/viewGrades.php">
                 <i class="fa-solid fa-book-open-reader"></i>
                <span>View Grades</span>
            </a>
        </li>
        <li>
            <a href="../pages/studentReviews.php">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Review</span>
            </a>
        </li>
        <li>
            <a href="../pages/requestForm.php">
                <i class="fas fa-clipboard"></i>
                <span>Request Form</span>
            </a>
        </li>
        <li>
            <a href="../pages/teacherContact.php">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Teacher Information</span>
            </a>
        </li>
        <li class="logout">
            <a href="">
                <i class="fa-solid fa-user"></i>
                <span>
                <?php
                if ($userDetails !== null) {
                    echo "<p>" . $userDetails["full_name"] ."</p>";
                } else {
                    echo "<p>Error: User details not found.</p>";
                }
                ?>
                </span>
            </a>
            <a href="../pages/logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>


    