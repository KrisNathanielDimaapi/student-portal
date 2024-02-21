<?php
include("../phpFiles/dbConnect.php");

$full_name = "";
$address = "";
$contact = "";
$email = "";
$id = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['studentID'])) {
        header("location: student.php");
        exit;
    }

    $id = $_GET['studentID'];

    $sql = "SELECT * FROM students WHERE studentID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Error executing query: " . $stmt->error);
    }

    $row = $result->fetch_assoc();
    if (!$row) {
        header('location: student.php');
        exit;
    }

    $full_name = $row["full_name"];
    $address = $row["address"];
    $contact = $row["contact"];
    $email = $row["email"];
    $sex = $row["gender"];
    $level_section = $row["level_section"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['studentID']) ? $_POST['studentID'] : (isset($_POST['id']) ? $_POST['id'] : '');

    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $sex = isset($_POST['gender']) ? $_POST['gender'] : '';
    $level_section = isset($_POST['level_section']) ? $_POST['level_section'] : '';

    // Validate and sanitize input data
    // Add your validation logic here

    if (empty($full_name) || empty($address) || empty($contact) || empty($email)) {
        echo "<script>alert('All fields cannot be empty');</script>";
        die();
    }

    $sql = "UPDATE students SET full_name = ?, address = ?, contact = ?, email = ?, gender = ?, level_section = ? WHERE studentID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssss", $full_name, $address, $contact, $email, $sex, $level_section, $id);    
    $stmt->execute();

    if ($stmt->affected_rows === -1) {
        echo "<script>alert('Edit Not Success!');</script>";
        die();
    }

    // Redirect back to student.php with pagination information
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
        header("location: student.php?page=$page");
    } else {
        header("location: student.php");
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
                <h1>Edit Student Information</h1>
            </div>
            <a href="student.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editStudent.php" autocomplete="off" method="post" id="timeServiceForm">
                <input type="hidden" name="studentID" value="<?php echo $id; ?>">

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
                    <div class="am-col-6">
                        <p>Email:</p>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Sex:</p>
                        <input type="text" name="gender" id="gender" value="<?php echo $sex ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Address:</p>
                        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
                    </div>
                    <div class="am-col-6">
                        <p>Section:</p>
                        <select name="level_section" id="level_section" class="level_section" required>
                            <option></option>
                            <?php 
                            $classes = $connect->query("SELECT * FROM classes order by level asc, section asc ");
                            while($row = $classes->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['level'] . $row['section']; ?>">
                                    <?php echo ucwords($row['level'] . ' - ' . $row['section']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
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
