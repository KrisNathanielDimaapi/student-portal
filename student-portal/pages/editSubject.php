<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}

$subject_code = "";
$subject = "";
$description = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header("location: subject.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM subjects WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
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

    $subject_code = $row['subject_code'];
    $subject = $row['subject'];
    $description = $row['description'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $subject_code = isset($_POST['subject_code']) ? $_POST['subject_code'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($subject_code) || empty($subject) || empty($description)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE subjects SET subject_code = ?, subject = ?, description = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssi", $subject_code, $subject, $description, $id);
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
                <h1>Classes</h1>
            </div>
            <a href="subject.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editSubject.php" autocomplete="off" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="am-row">
                    <div class="am-col-12">
                        <p>Subject Code:</p>
                        <input type="text" name="subject_code" id="subject_code" value="<?php echo $subject_code; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Subject:</p>
                        <input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" required>
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
