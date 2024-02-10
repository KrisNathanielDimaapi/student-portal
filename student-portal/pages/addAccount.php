<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }

$message = ""; // Variable to store the success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accFirstName = $_POST["accFirstName"];
    $accLastName = $_POST["accLastName"];
    $accEmail = $_POST["accEmail"];
    $accPassword = $_POST["accPassword"];
    $accRole = $_POST["s-select"]; // Assuming the select element has the name "s-select"

    if ($connect->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email, first name, and last name already exist
    $checkSql = "SELECT * FROM accounts WHERE accEmail = '$accEmail'";
    $result = $connect->query($checkSql);

    if ($result->num_rows > 0) {
        $message = "Email is already exists. Cannot add another account.";
    } else {
        // Insert new account
        $insertSql = "INSERT INTO accounts (accFirstName, accLastName, accEmail, accPassword, accRole) 
                      VALUES ('$accFirstName', '$accLastName', '$accEmail', '$accPassword', '$accRole')";

        if ($connect->query($insertSql) === TRUE) {
            $message = "Account added successfully";
            header("location: ./accountManagement.php");
        } else {
            $message = "Error adding account: " . $connect->error;
        }
    }

    $connect->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Student Portal</title>
    <?php include("../pages/header.php");?>
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
    <div class="am-container">
        <div class="am-body">
            <div class="am-head">
                <h1>Account Management</h1>
            </div>

            <form class="am-body-box" method="post" action="addAccount.php">
                <a href="accountManagement.php"><i class="fas fa-arrow-alt-circle-left"></i></a>

                <?php if (!empty($message)): ?>
                    <div class="error-message <?php echo (strpos($message, 'Error') !== false) ? 'error-message' : ''; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="am-row">
                    <div class="am-col-6">
                        <p>First Name: </p>
                        <input type="text" name="accFirstName" id="accFirstName" placeholder="Enter First Name" required>
                    </div>
                    <div class="am-col-6">
                        <p>Last Name: </p>
                        <input type="text" name="accLastName" id="accLastName" placeholder="Enter Last Name"required>
                    </div>
                </div>
                <div class="am-row">
                    <div class="am-col-6">
                        <p>Email: </p>
                        <input type="text" name="accEmail" id="accEmail" placeholder="Enter Email"required>
                    </div>
                    <div class="am-col-6">
                        <p>Password: </p>
                        <input type="text" name="accPassword" id="accPassword" placeholder="Enter Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?_&])[A-Za-z\d@$!%*?_&]{8,}$"
                        title="Password must be at least 8 characters with a mix of uppercase and lowercase letters, numbers, and special characters."
                        placeholder="Password" onchange="confirmPassword()"  required> 
                    </div>

                </div>

                <div class="am-row">
                    <div class="am-col-6">
                            <p>Select Role: </p>
                            <select name="s-select">
                                <option value="Admin">Admin</option>
                                <option value="Employee">Employee</option>
                            </select>
                    </div>
                </div>
                

                <div class="buttonCont">
                    <div class="am-col-3">
                        <button type="submit" name = 'finalSubmitOld'  id = 'finalSubmit' onclick = "return confirm('Are you sure you want to add this account?');"> ADD ACCOUNT</button>
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