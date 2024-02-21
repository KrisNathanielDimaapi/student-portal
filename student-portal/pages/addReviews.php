<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$subject_name = "";
$studentName = "";
$teacherName = "";
$evaluation = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject_name = $_POST['subject_name'];
    $studentName = $_POST['studentName'];
    $teacherName = $_POST['teacherName'];
    $evaluation = $_POST['evaluation'];

    if ( $subject_name == "" || $studentName == "" ||  $teacherName == "" || $evaluation == "") {

        echo "
            <script>
                alert('All Field Can Not Be Empty');
            </script>
        ";
    } else {
        $sql = "INSERT INTO reviews ( subject_name, studentName, teacherName, evaluation) VALUES ('$subject_name', '$studentName', '$teacherName', '$evaluation')";

        $result = mysqli_query($connect, $sql);

        if (!$result) {
            die("Error: " . mysqli_error($connect));
        } else {
            header('location: reviews.php');
            exit;
        }
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
                <h1>Add Review of Teaching Subject</h1>
               </div>
               <a href="reviews.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addReviews.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                <div class="am-row">
                        <div class="am-col-12">
                            <p>Subject:</p>
                            <select name="subject_name" id="subject_name" class="subject_name" required>
                            <option></option>
                            <?php 
                            $classes = $connect->query("SELECT * FROM subjects order by subject_name asc ");
                            while($row = $classes->fetch_array()):
                                ?>
                                <option value="<?php echo $row['subject_name'] ?>" <?php echo isset($subject_name) && $subject_name== $row['subject_name'] ? "selected" : '' ?>>
                                    <?php echo ucwords($row['subject_name']) ?>
                                </option>
                            <?php endwhile; ?>
                            </select>
                        </div>                   
                    </div>
                    <div class="am-row">
                        <div class="am-col-6">
                            <p>Student Name:</p>
                            <input type="text" name="studentName" id="studentName" required>
                        </div>
                        <div class="am-col-6">
                        <p>Teacher Name:</p>
                            <select name="teacherName" id="teacherName" class="teacherName" required>
                                <option></option>
                                <?php 
                                $classes = $connect->query("SELECT * FROM teachers order by full_name asc ");
                                while($row = $classes->fetch_array()):
                                    ?>
                                    <option value="<?php echo $row['full_name'] ?>" <?php echo isset($full_name) && $full_name== $row['full_name'] ? "selected" : '' ?>>
                                        <?php echo ucwords($row['full_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                                </select>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Evaluation:</p>
                            <textarea name="evaluation" id="evaluation" cols="3" rows="10" require></textarea>
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