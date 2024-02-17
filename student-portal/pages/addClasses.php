<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
   
    $levelsection= "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $levelsection = $_POST['levelsection'];



        if($levelsection == ""){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO classes (levelsection) VALUES ('$levelsection')";
        $result = $connect->query($sql);
        if (!$result) {
            die("Error Add Data");
        }

        header('location: classes.php');
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
                <h1>Add Classes</h1>
               </div>
               <a href="classes.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addClasses.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Level & Section:</p>
                            <input type="text" name="levelsection" id="levelsection" required>
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