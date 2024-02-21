<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include("../phpFiles/dbConnect.php");
    
    
    $teacherID = "";
    $subjectCode = "";
    $subject_name = "";
    $description = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $teacherID = $_POST['teacherID'];
        $subjectCode = $_POST['subjectCode'];
        $subject_name = $_POST['subject_name'];
        $description = $_POST['description'];


        if($teacherID == "" || $subjectCode == "" ||  $subject_name == "" || $description == ""){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO subjects (teacherID, subjectCode, subject_name, description) VALUES ('$teacherID', '$subjectCode','$subject_name', ' $description')";
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
                <h1>Add Subject</h1>
               </div>
               <a href="subject.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addSubject.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                <div class="am-row">
                        <div class="am-col-6">
                            <p>Teacher ID:</p>
                            <select name="teacherID" id="teacherID" class="teacherID" required>
                                <option></option>
                                <?php 
                                $classes = $connect->query("SELECT * FROM teachers order by teacherID asc ");
                                while($row = $classes->fetch_array()):
                                    ?>
                                    <option value="<?php echo $row['teacherID'] ?>" <?php echo isset($teacherID) && $teacherID== $row['teacherID'] ? "selected" : '' ?>>
                                        <?php echo ucwords($row['teacherID']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="am-col-6">
                            <p>Subject Code:</p>
                            <input type="text" name="subjectCode" id="subjectCode" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Subject Name:</p>
                            <input type="text" name="subject_name" id="subject_name" required>
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