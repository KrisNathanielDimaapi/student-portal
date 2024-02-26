<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$gradeID = "";
$studentID = "";
$subjectID = "";
$marks = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['gradeID'])) {
        header("location: result.php");
        exit;
    }

    $gradeID = $_GET['gradeID'];

    $sql = "SELECT * FROM grades WHERE gradeID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $gradeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error executing query: " . $stmt->error);
    }

    $row = $result->fetch_assoc();
    if (!$row) {
        header('location: result.php');
        exit;
    }
    $studentID = $row['studentID'];
    $subjectID = $row['subjectID'];
    $marks = $row['grade'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gradeID = isset($_POST['gradeID']) ? $_POST['gradeID'] : '';
    $studentID = isset($_POST['studentID']) ? $_POST['studentID'] : '';
    $subjectID = isset($_POST['subjectID']) ? $_POST['subjectID'] : '';
    $marks = isset($_POST['marks']) ? $_POST['marks'] : '';

    if (empty($studentID) || empty($subjectID) || empty($marks)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE grades SET studentID = ?, subjectID = ?, grade = ? WHERE gradeID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("iiii", $studentID, $subjectID, $marks, $gradeID);
    $stmt->execute();

    if ($stmt->affected_rows === -1) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    header("location: result.php");
    exit;
}
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
                <h1>Edit Grades</h1>
            </div>
            <a href="result.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editGrade.php" autocomplete="off" method="post" id="timeServiceForm">
                <input type="hidden" name="gradeID" value="<?php echo $gradeID; ?>">
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Select Student:</p>
                        <select name="studentID" required>
                            <option value="">Select student</option>
                            <?php
                            $students = $connect->query("SELECT studentID, full_name FROM students order by studentID asc");
                            while ($student = $students->fetch_array()) {
                                $selected = ($student['studentID'] == $studentID) ? 'selected' : '';
                                echo "<option value='{$student['studentID']}' $selected>{$student['full_name']}</option>";
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
                            $subjects = $connect->query("SELECT subjectID, subject_name FROM subjects order by subjectID asc");
                            while ($subject = $subjects->fetch_array()) {
                                $selected = ($subject['subjectID'] == $subjectID) ? 'selected' : '';
                                echo "<option value='{$subject['subjectID']}' $selected>{$subject['subject_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Marks:</p>
                        <input type="number" name="marks" id="marks" value="<?php echo $marks; ?>" required>
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
