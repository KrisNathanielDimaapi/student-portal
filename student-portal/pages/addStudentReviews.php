<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$subject_name = "";
$studentName = "";
$teacherName = "";
$evaluation = "";

// Check if the user is logged in and get student details from the session
if (isset($_SESSION['studentID'])) {
    $studentID = $_SESSION['studentID'];

    // Fetch student details from the database based on the session studentID
    $studentDetailsQuery = $connect->query("SELECT * FROM students WHERE studentID = '$studentID'");
    $studentDetails = $studentDetailsQuery->fetch_assoc();

    // Set the studentName based on fetched details
    $studentName = $studentDetails['full_name'];
}

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
        // Retrieve subject ID
        $subjectQuery = $connect->query("SELECT subjectID FROM subjects WHERE subject_name = '$subject_name'");
        $subjectResult = $subjectQuery->fetch_assoc();

        // Retrieve student ID
        $studentQuery = $connect->query("SELECT studentID FROM students WHERE full_name = '$studentName'");
        $studentResult = $studentQuery->fetch_assoc();

        // Retrieve teacher ID
        $teacherQuery = $connect->query("SELECT teacherID FROM teachers WHERE full_name = '$teacherName'");
        $teacherResult = $teacherQuery->fetch_assoc();

        // Check if teacherID exists
        if ($teacherResult && isset($teacherResult['teacherID'])) {
            $teacherID = $teacherResult['teacherID'];

            // Check if subjectID and studentID exist
            if ($subjectResult && isset($subjectResult['subjectID']) && $studentResult && isset($studentResult['studentID'])) {
                $subjectID = $subjectResult['subjectID'];
                $studentID = $studentResult['studentID'];

                // Modify the SQL query to include foreign keys
                $sql = "INSERT INTO reviews (subjectID, studentID, teacherID, subject_name, studentName, teacherName, evaluation) 
                        VALUES ('$subjectID', '$studentID', '$teacherID', '$subject_name', '$studentName', '$teacherName', '$evaluation')";

                $result = mysqli_query($connect, $sql);

                if (!$result) {
                    die("Error: " . mysqli_error($connect));
                } else {
                    header('location: reviews.php');
                    exit;
                }
            } else {
                // Handle the case where subjectID or studentID is not found
                echo "
                    <script>
                        alert('Invalid subject or student selected');
                    </script>
                ";
            }
        } else {
            // Handle the case where teacherID is not found
            echo "
                <script>
                    alert('Invalid teacher selected');
                </script>
            ";
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
      <style>
        nav {
            display: none;
        }

        #teacherName[readonly] {
            background-color: #f2f2f2;
        }
    </style>
    </head>
    <body>
        <div class="am-container">
        <?php
        include('../components/ssidebar.php');
        ?>
            <div class="am-body">
               <div class="am-head">
                <h1>Add Review of Teaching Subject</h1>
               </div>
               <a href="studentReviews.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addStudentReviews.php" autocomplete="off" method = "post"  id = "timeServiceForm">
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
                            <input type="text" name="studentName" id="studentName" required value="<?php echo isset($studentDetails) ? $studentDetails['full_name'] : ''; ?>" readonly>
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