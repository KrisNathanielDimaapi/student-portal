
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
$middlename= "";
$lastname= "";
$address= "";
$class_id= "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(!isset($_GET['id'])){
        header("location: student.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM students WHERE id = '$id'";

    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        die("Error Get Data ");
        header('location: student.php');
    }

    $id = $row["id"];
    $firstname = $row["firstname"];
    $middlename = $row["middlename"];
    $lastname = $row["lastname"];
    $address = $row["address"];
    $class_id = $row["class_id"];

}else{

    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $class_id = $_POST["class_id"];

    if($firstname == "" || $middlename =="" || $lastname == "" || $address == "" || $class_id == ""){

        echo "
            <script>
                alert('All Field Can Not Empty');
            </script>
        ";
        die();
    }

    $sql = "UPDATE students SET firstname = ?, middlename = ?, lastname = ?, address = ?, class_id = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssi", $firstname, $middlename, $lastname, $address, $class_id, $id);
    $stmt->execute();
    
    if (!$stmt) {
        echo  " <script>
            alert('Edit Not Success !');
        </script> ";
        die();
    }
    header("location: student.php");
        die();
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
                <h1>Students</h1>
            </div>
            <a href="student.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="editStudent.php" autocomplete="off" method="post" id="timeServiceForm">
                <div class="am-row">
                    <div class="am-col-12">
                        <p>First Name:</p>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Middle Name:</p>
                        <input type="text" name="middlename" id="middlename" value="<?php echo $middlename; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Last Name:</p>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required>
                    </div>
                </div>

                <div class="am-row">
                    <div class="am-col-12">
                        <p>Address:</p>
                        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-12">
                        <p>Class:</p>
                        <select name="class_id" id="class_id" class="class_id" required>
                            <option></option>
                            <?php 
                            $classes = $connect->query("SELECT * FROM classes order by levelsection asc ");
                            while($row = $classes->fetch_array()):
                                ?>
                                <option value="<?php echo $row['levelsection'] ?>" <?php echo isset($class_id) && $class_id == $row['levelsection'] ? "selected" : ''; ?>>
                                    <?php echo ucwords($row['levelsection']) ?>
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
