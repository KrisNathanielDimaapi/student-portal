<?php
$host = "localhost";
$username  = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}

$levelsection = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $levelsection = $_POST['levelsection'];

    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    if ($levelsection == "") {
        echo "<script>alert('All Field Can Not Empty');</script>";
    }

    $sql = "INSERT INTO students_results_view (student_id, firstname, middlename, lastname, subject, marks) VALUES ('$student_id', '$firstname', '$middlename', '$lastname', '$subject', '$marks')";
    $result = $connect->query($sql);

    if (!$result) {
        die("Error Add Data");
    }

    header('location: results.php');
    exit;
}

$studentQuery = "SELECT id, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname FROM students";
$studentsResult = $connect->query($studentQuery);
$subjectQuery = "SELECT subject_code, subject FROM subjects";
$subjectsResult = $connect->query($subjectQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/forms.css" />
    <?php include("../pages/header.php"); ?>
</head>

<body>
    <div class="am-container">
        <div class="am-body">
            <div class="am-head">
                <h1>Grades</h1>
            </div>
            <a href="classes.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="addGrades.php" autocomplete="off" method="post" id="timeServiceForm">
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Select Student:</p>
                        <select name="student_id" required>
                            <?php
                            while ($student = $studentsResult->fetch_assoc()) {
                                echo "<option value='{$student['id']}'>{$student['fullname']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Subject:</p>
                        <select name="subject" id="subject" required>
                            <?php
                            while ($subject = $subjectsResult->fetch_assoc()) {
                                echo "<option value='{$subject['subject_code']}'>{$subject['subject']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Marks:</p>
                        <input type="text" name="marks" id="marks" required>
                    </div>
                </div>
                <div class="buttonCont">
                    <div class="am-col-3">
                        <input type="submit" name="finalSubmitOld" id="finalSubmit" value="SUBMIT">
                    </div>
                </div>
            </form>
            <div class="am-footer">
                <p>Bauan Technical High School - Student Portal</p>
            </div>
        </div>
    </div>
</body>

</html>