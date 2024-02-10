<?php
    $host = "localhost";
    $username  = "root";
    $password = "";
    $db = "student_portal";
    
    $connect = new mysqli($host, $username, $password, $db);
    if ($connect->connect_error) {
        die("Error Connect to DB" . $connect->connect_error);
    }

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["accountID"])) {
    $accountID = $_GET["accountID"];

    if ($connect->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete account
    $deleteSql = "DELETE FROM accounts WHERE accountID = $accountID";

    if ($connect->query($deleteSql) === TRUE) {
        echo "Account deleted successfully";
    } else {
        echo "Error deleting account: " . $connect->error;
    }

    $connect->close();
} else {
    echo "Invalid request";
}
header('location: ./accountManagement.php');
?>