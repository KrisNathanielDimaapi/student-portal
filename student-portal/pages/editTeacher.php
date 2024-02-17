<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}

$firstname = "";
$middlename = "";
$lastname = "";
$address = "";
$contact = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header("location: teacher.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM teachers WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
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

    $id = $row["id"];
    $firstname = $row["firstname"];
    $middlename = $row["middlename"];
    $lastname = $row["lastname"];
    $address = $row["address"];
    $contact = $row["contact"];
    $email = $row["email"];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if (empty($firstname) || empty($middlename) || empty($lastname) || empty($address) || empty($contact) || empty($email)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE teachers SET firstname = ?, middlename = ?, lastname = ?, address = ?, contact = ?, email = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssssi", $firstname, $middlename, $lastname, $address, $contact,$email, $id);
    $stmt->execute();

    if ($stmt->affected_rows === -1) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    header("location: teacher.php");
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
            <a href="student.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editTeacher.php" autocomplete="off" method="post" id="timeServiceForm">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="am-row">
                    <div class="am-col-6">
                        <p>First Name:</p>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Middle Name:</p>
                        <input type="text" name="middlename" id="middlename" value="<?php echo $middlename; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Last Name:</p>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required>
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
