<?php
include("../phpFiles/dbConnect.php"); // Include your database connection file

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

<head>
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
            <a href="reviews.php">
                <i class="fa-solid fa-file-medical"></i>
                <span>Review of Teaching Subjects</span>
            </a>
        </li>
        <li>
            <a href="classes.php">
                <i class="fa-solid fa-people-roof"></i>
                <span>Classes</span>
            </a>
        </li>
        <li>
            <a href="subject.php">
                <i class="fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>
        </li>
        <li>
            <a href="student.php">
                <i class="fas fa-clipboard"></i>
                <span>Student Record</span>
            </a>
        </li>
        <li>
            <a href="result.php">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Add Grades</span>
            </a>
        </li>

        <li class="logout">
            <a href="">
                <i class="fa-solid fa-user"></i>
                <span>
                    <?php
                    if ($teacherDetails !== null) {
                        echo "<p>" . $teacherDetails["full_name"] . "</p>";
                    } else {
                        echo "<p>Error: Teacher details not found.</p>";
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