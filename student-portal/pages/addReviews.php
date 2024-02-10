<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
   
    $email = "";
    $subject = "";
    $instructor = "";
    $review = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $instructor = $_POST['instructor'];
        $review = $_POST['review'];

        if($email == "" || $subject == "" || $instructor == "" || $review == ""){

            echo "
                <script>
                    alert('All Field Can Not Empty');
                </script>
            ";
        }


        $sql = "INSERT INTO reviews (email, subject, instructor, review) VALUES ('$email', '$subject', '$instructor', '$review')";
        $result = $connect->query($sql);
        if (!$result) {
            die("Error Add Data");
        }

        header('location: reviews.php');
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
                <h1>Add Review of Teaching Subject</h1>
               </div>
               <a href="reviews.php"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <form class="am-body-box" action = "addReviews.php" autocomplete="off" method = "post"  id = "timeServiceForm">
                <div>
                        <div>
                            <p>Email: </p>
                            <input type="text" name="email" id="email" required>
                        </div>
                    </div>
                <div class="am-row">
                        <div class="am-col-12">
                        <p>Subject:</p>
                        <select name="subject" id="subject" class="subject" required>
                            <option></option>
                            <?php 
                            $classes = $connect->query("SELECT * FROM subjects order by subject asc ");
                            while($row = $classes->fetch_array()):
                                ?>
                                <option value="<?php echo $row['subject'] ?>" <?php echo isset($subject) && $subject== $row['subject'] ? "selected" : '' ?>>
                                    <?php echo ucwords($row['subject']) ?>
                                </option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Instructor:</p>
                            <input type="text" name="instructor" id="instructor" required>
                        </div>
                    </div>
                    <div class="am-row">
                        <div class="am-col-12">
                            <p>Review:</p>
                            <textarea name="review" id="review" cols="3" rows="10" require></textarea>
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