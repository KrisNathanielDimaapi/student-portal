<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$levelsection = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['studentID'];
    $studName = ""; // Initialize $studName to an empty string

    // Retrieve the student's name from the database based on the selected studentID
    $studentNameQuery = "SELECT full_name FROM students WHERE studentID = '$student_id'";
    $studentNameResult = $connect->query($studentNameQuery);

    if ($studentNameResult->num_rows > 0) {
        $student = $studentNameResult->fetch_assoc();
        $studName = $student['full_name'];
    } else {
        // Handle the case where the student with the given ID is not found
        echo "<script>alert('Error: Selected student not found');</script>";
        exit;
    }

    $subject_id = $_POST['subjectID'];
    $subject_name = ""; // Initialize $subject_name to an empty string

    $subjectNameQuery = "SELECT subject_name FROM subjects WHERE subjectID = '$subject_id'";
    $subjectNameResult = $connect->query($subjectNameQuery);

    if ($subjectNameResult->num_rows > 0) {
        $subject = $subjectNameResult->fetch_assoc();
        $subject_name = $subject['subject_name'];
    } else {
        // Handle the case where the subject with the given ID is not found
        echo "<script>alert('Error: Selected subject not found');</script>";
        exit;
    }

    $marks = $_POST['marks'];

    if (empty($student_id) || empty($subject_id) || empty($marks)) {
        echo "<script>alert('All Fields Cannot Be Empty');</script>";
    } else {
        // Get teacherID from the session
        $teacher_id = $_SESSION['teacherID'] ?? '';

        // Check if the teacherID is valid before inserting
        $checkTeacherQuery = "SELECT teacherID FROM teachers WHERE teacherID = '$teacher_id'";
        $checkTeacherResult = $connect->query($checkTeacherQuery);

        if ($checkTeacherResult->num_rows == 0) {
            die("Error: Invalid teacherID");
        }

        $sql = "INSERT INTO grades (studentID, teacherID, subjectID, studName, subject, grade) VALUES ('$student_id', '$teacher_id', '$subject_id', '$studName', '$subject_name', '$marks')";

        $result = $connect->query($sql);

        if (!$result) {
            die("Error Adding Data: " . $connect->error);
        }

        header('location: result.php');
        exit;
    }
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
            <a href="result.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
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
                        <select name="subjectID" id="subject" required>
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
                        <input type="number" name="marks" id="marks" required>
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
