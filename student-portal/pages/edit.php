<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}

$levelsection = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header("location: classes.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM classes WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
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

    $levelsection = $row['levelsection'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $levelsection = $_POST['levelsection'];

    if (empty($levelsection)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE classes SET levelsection = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("si", $levelsection, $id);
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
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="am-row">
                    <div class="am-col-12">
                        <p>Level & Section:</p>
                        <input type="text" name="levelsection" id="levelsection" value="<?php echo $levelsection; ?>" required>
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
