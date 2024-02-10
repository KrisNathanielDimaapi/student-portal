<?php
session_start(); // Start the session

$host = "localhost";
$username = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/requestForm.css">
    <?php include('header.php'); ?>
</head>

<body>
        <div class="sidebar">
            <?php 
                if(isset($_SESSION["accRole"]) && $_SESSION["accRole"] == "Teacher"){
                    include('adminSidebar.php'); 
                }else{
                    include('sidebar.php'); 
                } 
            ?>  

        <div class="container">

            <h1 class="heading">Request Form</h1>

            <div class="box-container">
            <div class="box">
                    <h3>Certificate of Subject Non-Availabilty</h3>
                    <p>Certificate confirming subject unavailability for academic purposes.</p>
                    <br>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdK7LjRs310yRlBGi-tLyOqEzV4jWv3jnERt-6K0Zo4JYKicg/viewform" class="btn">Get Form</a>
                </div>
                <div class="box">
                    <h3>Certificate of English <br>Medium</h3>
                    <p>English language instruction proof for international education settings.</p>
                    <br>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScwi1q4i3a7ZpP6z3Kvv--ppmnMMpfATJ1eH5RS8ZDMnM4UsA/viewform" class="btn">Get Form</a>
                </div>
                <div class="box">
                    <h3>Certificate of Good<br> Moral</h3> 
                    <p>Affirmation of individual's good moral character for documentation.</p>
                    <br>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSeiXOWpTUuUR9UxahUWh69ncPRRXGnXijGATQiGw9bn479PgA/viewform" class="btn">Get Form</a>
                </div>
                <div class="box">
                    <h3>Certificate of <br>Graduation</h3> 
                    <p>Validates successful completion of an academic program.</p>
                    <br>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSflI3eIW4UKiTDCbnIxPFMOOt6PTrLld-KRu5shcD47_F-n1A/viewform" class="btn"> Get Form</a>
                </div>
                <div class="box">
                    <h3>Certificate of<br> Enrollment</h3>
                    <p>Confirms current enrollment in an educational institution.</p>
                    <br>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSf2pzaZgvqPz0GePHIZtRFSxgyXlFOl5lZimjMzdSttEf11_A/viewform" class="btn">Get Form</a>
                </div>
            </div>


    </div>
</body>
</html>