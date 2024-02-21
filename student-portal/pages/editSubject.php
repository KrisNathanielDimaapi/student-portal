<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include("../phpFiles/dbConnect.php");

    $teacherID = "";
    $subjectCode = "";
    $subject_name = "";
    $description = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['subjectID'])) {
        header("location: subject.php");
        exit;
    }

    $subjectID = $_GET['subjectID'];

    $sql = "SELECT * FROM subjects WHERE subjectID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $subjectID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error executing query: " . $stmt->error);
    }

    $row = $result->fetch_assoc();
    if (!$row) {
        header('location: subject.php');
        exit;
    }
    $teacherID = $row['teacherID'];
    $subjectCode = $row['subjectCode'];
    $subject_name = $row['subject_name'];
    $description = $row['description'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $subjectID = isset($_POST['subjectID']) ? $_POST['subjectID'] : '';
    $teacherID = isset($_POST['teacherID']) ? $_POST['teacherID'] : '';
    $subjectCode = isset($_POST['subjectCode']) ? $_POST['subjectCode'] : '';
    $subject_name = isset($_POST['subject_name']) ? $_POST['subject_name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($teacherID) || empty($subjectCode) || empty($subject_name) || empty($description)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE subjects SET teacherID = ?, subjectCode = ?, subject_name = ?, description = ? WHERE subjectID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("isssi", $teacherID, $subjectCode, $subject_name, $description, $subjectID);
    $stmt->execute();

    if ($stmt->affected_rows === -1) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    header("location: subject.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/forms.css" />
    <?php include("../pages/header.php");?>
</head>

<body>

    <div class="am-container">
        <div class="am-body">
            <div class="am-head">
                <h1>Edit Subject</h1>
            </div>
            <a href="subject.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editSubject.php" autocomplete="off" method="post">
                <input type="hidden" name="subjectID" value="<?php echo $subjectID; ?>">

                <div class="am-row">
                    <div class="am-col-6">
                        <p>Teacher ID:</p>
                        <select name="teacherID" id="teacherID" class="teacherID" required>
                                <option></option>
                                <?php 
                                $classes = $connect->query("SELECT * FROM teachers order by teacherID asc ");
                                while($row = $classes->fetch_array()):
                                    ?>
                                    <option value="<?php echo $row['teacherID'] ?>" <?php echo isset($teacherID) && $teacherID== $row['teacherID'] ? "selected" : '' ?>>
                                        <?php echo ucwords($row['teacherID']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                    </div>
                    <div class="am-col-6">
                        <p>Subject Code:</p>
                        <input type="text" name="subjectCode" id="subjectCode" value="<?php echo $subjectCode; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Subject:</p>
                        <input type="text" name="subject_name" id="subject_name" value="<?php echo $subject_name; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Description:</p>
                        <input type="text" name="description" id="description" value="<?php echo $description; ?>" required>
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
