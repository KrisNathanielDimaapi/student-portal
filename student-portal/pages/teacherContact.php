<?php
session_start(); // Start the session

$host = "localhost";
$username  = "root";
$password = "";
$db = "student_portal";

$connect = new mysqli($host, $username, $password, $db);
if ($connect->connect_error) {
    die("Error Connect to DB" . $connect->connect_error);
}

$recordPerPage = 13;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;

// Initialize search keyword
$searchKeyword = "";

// Check if a search keyword is provided
if (isset($_GET["searchKeyword"])) {
    $searchKeyword = $_GET["searchKeyword"];
    // Modify the SQL query to include the search condition
    $sql = "SELECT * FROM teachers WHERE id LIKE '%$searchKeyword%' OR firstname LIKE '%$searchKeyword%' OR middlename LIKE '%$searchKeyword%' OR lastname LIKE '%$searchKeyword%' OR gender LIKE '%$searchKeyword%' OR address LIKE '%$searchKeyword%' OR contact LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%'";
} else {
    // Default query without search
    $sql = "SELECT * FROM teachers";
}

$result = $connect->query($sql);
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bauan Technical High School - Student Portal</title>
    <link rel="stylesheet" href="../styles/reviews.css">
    <?php include('header.php'); ?>
</head>
<body>
    <div class="container">
        <?php 
            if($_SESSION["accRole"] == "Teacher"){
                include('adminSidebar.php'); 
            }else{
                include('sidebar.php'); 
            } 
        ?>  
        <main>
          <h1>Teacher Information</h1>

          <div class="main-content">
            <div class="contain">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Address</th><th>Contact</th><th>Email</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["middlename"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["contact"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    
                  }
                  echo "</div>";
                //   echo "</table><br>";
                  
                } else {
                    echo "<tr><td colspan = '12' id = 'noRes'>No Results</td></tr>";
                }
                echo "</table><br>";
            ?>

        </main> 
        
  </div>
    
  <script src ="../scripts/confirmAppointment.js"></script>
</body>
</html>