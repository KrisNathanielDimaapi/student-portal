<?php
include("../phpFiles/dbConnect.php");
   
$student_code = "";
$full_name = "";
$email = "";
$password = "";
$gender = "";
$contact = "";
$address = "";
$level_section = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_code = $_POST['studentCode'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $level_section = $_POST['level_section'];

    $selected_level = substr($level_section, 0, -1);
$selected_section = substr($level_section, -1);

    if($student_code == "" || $full_name == "" ||  $email == "" || $password == '' || $gender == '' || $contact == '' || $address == '' || $level_section == ''){
        echo "
            <script>
                alert('All Field Can Not Empty');
            </script>
        ";
    }

    // Get the classID based on the selected level and section
    $class_query = $connect->query("SELECT classID FROM classes WHERE level = '$selected_level' AND section = '$selected_section'");

    if ($class_query) {
        // Check if the query was successful
        $class_row = $class_query->fetch_assoc();

        if ($class_row) {
            // Check if a result was returned
            $class_id = $class_row['classID'];

            $sql = "INSERT INTO students (classID, studentCode, full_name, email, password, gender, contact, address, level_section) 
                    VALUES ('$class_id', '$student_code', '$full_name', '$email', '$password', '$gender', '$contact', '$address', '$level_section')";
            $result = $connect->query($sql);
            if (!$result) {
                die("Error Add Data: " . $connect->error);
            }

            header('location: student.php');
            exit;
        } else {
            echo "
                <script>
                    alert('Class not found. Please select a valid class.');
                </script>
            ";
        }
    } else {
        echo "Error in class query: " . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/forms.css" />
    <?php include("../pages/header.php");?>
</head>
<body>
    <div class="am-container">
        <div class="am-body">
            <div class="am-head">
                <h1>Add Student</h1>
            </div>
            <a href="student.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="addStudent.php" autocomplete="off" method="post" id="timeServiceForm">
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Student Code:</p>
                        <input type="text" name="studentCode" id="studentCode" required>
                    </div>
                    <div class="am-col-6">
                        <p>Full Name:</p>
                        <input type="text" name="full_name" id="full_name" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Email:</p>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="am-col-6">
                        <p>Password:</p>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Gender:</p>
                        <input type="text" name="gender" id="gender" required>
                    </div>
                    <div class="am-col-6">
                        <p>Class:</p>
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
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Contact:</p>
                        <input type="text" name="contact" id="contact" required>
                    </div>
                    <div class="am-col-6">
                        <p>Address:</p>
                        <input type="text" name="address" id="address" required>
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
