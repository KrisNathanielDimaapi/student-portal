<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
   
    $subject_code = "";
    $subject = "";
    $description = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $subject_code = $_POST['subject_code'];
        $subject = $_POST['subject'];
        $description = $_POST['description'];


        if($subject_code == "" || $subject == "" ||  $description == ""){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO subjects (subject_code, subject, description) VALUES ('$subject_code', '$subject', ' $description')";
        $result = $connect->query($sql);
        if (!$result) {
            die("Error Add Data");
        }

        header('location: subject.php');
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
               <a href="subject.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addSubject.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                <div class="am-row">
                        <div class="am-col-12">
                            <p>Subject Code:</p>
                            <input type="text" name="subject_code" id="subject_code" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Subject:</p>
                            <input type="text" name="subject" id="subject" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Description:</p>
                            <input type="text" name="description" id="description" required>
                        </div>
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