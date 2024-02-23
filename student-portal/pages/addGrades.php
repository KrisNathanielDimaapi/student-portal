<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$levelsection = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['studentID'];
    $studName = $_POST['full_name'];
    $subject = $_POST['subject'];
    $marks = $_POST['grade'];

    if (empty($student_id) || empty($subject) || empty($marks)) {
        echo "<script>alert('All Fields Cannot Be Empty');</script>";
    }

    $sql = "INSERT INTO grades (studentID, studName, subject, grade) VALUES ('$student_id', '$studName', '$subject', '$marks')";

    $result = $connect->query($sql);

    if (!$result) {
        die("Error Adding Data");
    }

    header('location: results.php');
    exit;
}

$studentQuery = "SELECT studentID, full_name FROM students";
$studentsResult = $connect->query($studentQuery);
$subjectQuery = "SELECT subjectID, subject_name FROM subjects";
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
                        <select name="studentID" required>
                            <option value="">Select student</option>
                            <?php
                            while ($student = $studentsResult->fetch_assoc()) {
                                echo "<option value='{$student['studentID']}'>{$student['full_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Subject:</p>
                        <select name="subject" id="subject" required>
                            <option value="">Select subject</option>
                            <?php
                            while ($subject = $subjectsResult->fetch_assoc()) {
                                echo "<option value='{$subject['subjectID']}'>{$subject['subject_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Marks:</p>
                        <input type="int" name="marks" id="marks" required>
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