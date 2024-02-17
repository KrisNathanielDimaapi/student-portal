<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
   
    $firstname = "";
    $middlename= "";
    $lastname= "";
    $gender= "";
    $address= "";
    $contact= "";
    $email= "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];



        if($firstname == "" ||  $middlename == "" || $lastname == '' || $gender == '' || $address == '' || $contact == ''|| $email == ''){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO teachers ( firstname, middlename, lastname, gender, address, contact, email) VALUES ('$firstname', '$middlename', '$lastname', '$gender', '$address', '$contact', '$email')";
        $result = $connect->query($sql);
        if (!$result) {
            die("Error Add Data");
        }

        header('location: teacher.php');
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
                <h1>Add Teacher Inforamtion</h1>
            </div>
            <a href="teacher.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
            <form class="am-body-box" action="addTeacher.php" autocomplete="off" method="post" id="timeServiceForm">
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
                    <div class="am-col-6">
                        <p>Sex:</p>
                        <input type="text" name="gender" id="gender"required>
                    </div>
                    <div class="am-col-6">
                        <p>Email:</p>
                        <input type="text" name="email" id="email" required>
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