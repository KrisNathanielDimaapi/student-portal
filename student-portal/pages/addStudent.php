<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
   
    $student_code = "";
    $firstname = "";
    $middlename= "";
    $lastname= "";
    $gender= "";
    $address= "";
    $class_id= "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $student_code = $_POST['student_code'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $class_id = $_POST['class_id'];


        if($student_code == "" || $firstname == "" ||  $middlename == "" || $lastname == '' || $gender == '' || $address == '' || $class_id == ''){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO students (student_code, firstname, middlename, lastname, gender, address, class_id) VALUES ('$student_code', '$firstname', '$middlename', '$lastname', '$gender', '$address', '$class_id')";
        $result = $connect->query($sql);
        if (!$result) {
            die("Error Add Data");
        }

        header('location: student.php');
        exit;
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
                <h1>Classes</h1>
               </div>
               <a href="student.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addStudent.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                <div class="am-row">
                        <div class="am-col-6">
                            <p>Student Code:</p>
                            <input type="text" name="student_code" id="student_code" required>
                        </div>
                        <div class="am-col-6">
                            <p>First Name:</p>
                            <input type="text" name="firstname" id="firstname" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-6">
                            <p>Middle Name:</p>
                            <input type="text" name="middlename" id="middlename" required>
                        </div>
                        <div class="am-col-6">
                            <p>Last Name:</p>
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-6">
                            <p>Sex:</p>
                            <input type="text" name="gender" id="gender" required>
                        </div>
                        <div class="am-col-6">
                            <p>Class:</p>
                        <select name="class_id" id="class_id" class="class_id" required>
                            <option></option>
                            <?php 
                            $classes = $connect->query("SELECT * FROM classes order by levelsection asc ");
                            while($row = $classes->fetch_array()):
                                ?>
                                <option value="<?php echo $row['levelsection'] ?>" <?php echo isset($levelsection) && $levelsection== $row['levelsection'] ? "selected" : '' ?>>
                                    <?php echo ucwords($row['levelsection']) ?>
                                </option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Address:</p>
                            <input type="text" name="address" id="address" required>
                        </div>
                    </div> 
                    <div class="am-row">
                    
                    </div>

                    <div class="buttonCont">
                        <div class="am-col-3">
                                <input type ='submit' name = 'finalSubmitOld'  id = 'finalSubmit' value = 'SUBMIT'>
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