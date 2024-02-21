<?php
include("../phpFiles/dbConnect.php");

$full_name = "";
$address = "";
$contact = "";
$email = "";
$id = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['teacherID'])) {
        header("location: teacher.php");
        exit;
    }

    $id = $_GET['teacherID'];

    $sql = "SELECT * FROM teachers WHERE teacherID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error executing query: " . $stmt->error);
    }

    $row = $result->fetch_assoc();
    if (!$row) {
        header('location: teacher.php');
        exit;
    }

    $full_name = $row["full_name"];
    $address = $row["address"];
    $contact = $row["contact"];
    $email = $row["email"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['teacherID']) ? $_POST['teacherID'] : (isset($_POST['id']) ? $_POST['id'] : '');

    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Validate and sanitize input data
    // Add your validation logic here

    if (empty($full_name) || empty($address) || empty($contact) || empty($email)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE teachers SET full_name = ?, address = ?, contact = ?, email = ? WHERE teacherID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $address, $contact, $email, $id);
    $stmt->execute();

    if ($stmt->affected_rows === -1) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    // Redirect back to teacher.php with pagination information
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
        header("location: teacher.php?page=$page");
    } else {
        header("location: teacher.php");
    }
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
                <h1>Edit Teacher Information</h1>
            </div>
            <a href="teacher.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editTeacher.php" autocomplete="off" method="post" id="timeServiceForm">
            <input type="hidden" name="teacherID" value="<?php echo $id; ?>">


                <!-- Add hidden input for the page information -->
                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : ''; ?>">

                <div class="am-row">
                    <div class="am-col-6">
                        <p>Name:</p>
                        <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Contact:</p>
                        <input type="text" name="contact" id="contact" value="<?php echo $contact; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Email:</p>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Address:</p>
                        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
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
