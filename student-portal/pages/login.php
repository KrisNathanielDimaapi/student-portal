<?php
include("../phpFiles/dbConnect.php"); // Adjust the path accordingly

session_start();
$errorPrompt = array();

if (isset($_POST["login"])) {
    $emailLog = $_POST["emailLogin"];
    $passLog = $_POST["passwordLogin"];

    // Check in the admin table
    $checkAdmin = "SELECT * FROM admin WHERE user = '$emailLog'";
    $resultAdmin = mysqli_query($connect, $checkAdmin);

    // Check in the teachers table
    $checkTeacher = "SELECT * FROM teachers WHERE email = '$emailLog'";
    $resultTeacher = mysqli_query($connect, $checkTeacher);

    // Check in the students table
    $checkStudent = "SELECT * FROM students WHERE email = '$emailLog'";
    $resultStudent = mysqli_query($connect, $checkStudent);

    if (mysqli_num_rows($resultAdmin) > 0) {
        $row = mysqli_fetch_assoc($resultAdmin);
        $dbRole = "admin";
    } elseif (mysqli_num_rows($resultTeacher) > 0) {
        $row = mysqli_fetch_assoc($resultTeacher);
        $dbRole = "teacher";
        $_SESSION["teacherID"] = $row["teacherID"];
    } elseif (mysqli_num_rows($resultStudent) > 0) {
        $row = mysqli_fetch_assoc($resultStudent);
        $dbRole = "student";
        $_SESSION["studentID"] = $row["studentID"];
        $_SESSION["full_name"] = $studentName;
    } else {
        echo "<script>alert('Incorrect Email or Password. Please try again.');</script>";
        exit();
    }

    $dbEmail = $row["email"];
    $dbPass = $row["password"];
    if ($dbPass != $passLog) {
        echo "<script>alert('Incorrect Password. Please try again.');</script>";
    } else {
        $_SESSION["activeUser"] = $row["email"]; // Update to store the email
        $_SESSION["accRole"] = $dbRole;
        $_SESSION['loggedIn'] = true;
    
        // Redirect based on user role
        switch ($dbRole) {
            case "admin":
                header("Location: adminDashboard.php");
                break;
            case "teacher":
                header("Location: ../components/teacherDashboard.php");
                break;
            case "student":
                header("Location: ../components/studentDashboard.php");
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <?php include("../pages/header.php");?>
    <link rel="stylesheet" href = "../styles/loginReg.css">
    <script type="text/javascript" src ="../scripts/loginLoad.js"></script>
</head>

<body>
    <div class="center">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="txt_field">
                <input type="text" name="emailLogin" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="passwordLogin" required>
                <span></span>
                <label>Password</label>
            </div>

            <input type="submit" id="submitBtn" class="mainBtn" name="login" value="LOG IN">
        </form>
    </div>
</body>

</html>
