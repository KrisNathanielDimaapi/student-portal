<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$level = "";
$section = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['classID'])) {
        header("location: classes.php");
        exit;
    }

    $classID = $_GET['classID'];

    $sql = "SELECT * FROM classes WHERE classID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $classID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error executing query: " . $stmt->error);
    }

    $row = $result->fetch_assoc();
    if (!$row) {
        header('location: classes.php');
        exit;
    }

    $level = $row['level'];
    $section = $row['section'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $classID = $_POST['classID'];
    $level = $_POST['level'];
    $section = $_POST['section'];

    if (empty($level) || empty($section)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE classes SET level = ?, section = ? WHERE classID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssi", $level, $section, $classID);
    $stmt->execute();

    if (!$stmt) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    header("location: classes.php");
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
            <a href="classes.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="edit.php" autocomplete="off" method="post">
                <input type="hidden" name="classID" value="<?php echo $classID; ?>">

                <div class="am-row">
                    <div class="am-col-6">
                        <p>Level & Section:</p>
                        <input type="text" name="level" id="level" value="<?php echo $level; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Level & Section:</p>
                        <input type="text" name="section" id="section" value="<?php echo $section; ?>" required>
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
