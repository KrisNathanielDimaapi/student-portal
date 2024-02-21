<?php
include("../phpFiles/dbConnect.php");

$full_name = "";
$address = "";
$contact = "";
$email = "";
$id = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['lastname'];  // Use 'lastname' instead of 'full_name'
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($full_name == '' || $gender == '' || $address == '' || $contact == '' || $email == '') {
        echo "<script>alert('All Fields Cannot be Empty');</script>";
        die();
    }

    $sql = "INSERT INTO teachers (full_name, gender, address, contact, email, password) VALUES ('$full_name', '$gender', '$address', '$contact', '$email', '$password')";
    $result = $connect->query($sql);

    if (!$result) {
        die("Error Adding Data: " . $connect->error);
    }

    header('location: teacher.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/forms.css" />
    <?php include("../pages/header.php"); ?>
</head>

<body>
    <div class="am-container">
        <div class="am-body">
            <div class="am-head">
                <h1>Add Teacher Information</h1>
            </div>
            <a href="teacher.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="addTeacher.php" autocomplete="off" method="post" id="timeServiceForm">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="am-row">
                    <div class="am-col-6">
                        <p>Name:</p>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $full_name; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Contact:</p>
                        <input type="text" name="contact" id="contact" value="<?php echo $contact; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Sex:</p>
                        <input type="text" name="gender" id="gender" required>
                    </div>
                    <div class="am-col-6">
                        <p>Email:</p>
                        <input type="text" name="email" id="email" required>
                    </div>
                </div>
                <div class="am-row">
                <div class="am-col-6">
                        <p>Password:</p>
                        <input type="password" name="password" id="password" value="<?php echo $password; ?>" required>
                    </div>
                    <div class="am-col-6">
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
