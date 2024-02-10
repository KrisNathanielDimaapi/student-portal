
<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }
    
    session_start();
    $errorPrompt = array();
    
    if(isset($_POST["login"])){
        $emailLog = $_POST["emailLogin"];
        $passLog= $_POST["passwordLogin"];
        
        $checkExistence = "SELECT * FROM accounts WHERE accEmail = '$emailLog'";
        try{
            $resultExist = mysqli_query($connect, $checkExistence);
        }catch(mysqli_sql_exception){
            echo "<script>alert('Incorrect Password. Please try again.');</script>";
	        exit();

        }

        if(mysqli_num_rows($resultExist) > 0){
            $row = mysqli_fetch_assoc($resultExist);
            $dbAccountRole = $row["accRole"];
            $dbEmail = $row["accEmail"];
            $dbPass = $row["accPassword"];

            if($dbPass != $passLog){
                echo "<script>alert('Incorrect Password. Please try again.');</script>";
            }else{
                $_SESSION["activeUser"] = $row["accFirstName"] . " ". $row["accLastName"];
                $_SESSION["accRole"] = $dbAccountRole;
                $_SESSION['loggedIn'] = true;
                header("Location: adminDashboard.php");
            }
        }else{
            echo "<script>alert('Incorrect Email or Password. Please try again.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Student Portal</title>
    <?php include("../pages/header.php");?>
    <link rel="stylesheet" href = "../styles/loginReg.css">
    <script type="text/javascript" src ="../scripts/loginLoad.js"></script>
</head>
    <body>
    <div class="center">
      <h1>STUDENT PORTAL</h1>
      <form action="login.php" method="post">
        <div class="txt_field">
          <input type="text" name="emailLogin" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="passwordLogin" required>
          <span></span>
          <label>Password</label>
        </div>
        
        <div class="pass">Forgot Password?</div>
        <input type = "submit" id ="submitBtn" class = "mainBtn" name = "login" value = "LOG IN" onclick= "e.preventDefault()">
      </form>
    </div>
        
    </body>
</html>
