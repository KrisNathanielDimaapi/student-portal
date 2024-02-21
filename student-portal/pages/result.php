<?php
session_start(); // Start the session

$host = "localhost";
$username = "root";
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
    $sql = "SELECT * FROM student_results_view WHERE result_id LIKE '%$searchKeyword%'";
} else {
    // Default query without search
    $sql = "SELECT * FROM student_results_view";
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
            } else {
                include('sidebar.php'); 
            } 
        ?>  
        <main>
          <h1>Grades</h1>

          <div class="main-content">
            <div class="contain">
            <div class="button">
                        <a href="addGrades.php"><i class="fa-solid fa-plus"></i></a>
                    </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>Name</th><th>Subject</th><th>Marks</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["result_id"];
                    echo "<tr>";
                    echo "<td>" . $row["result_id"] . "</td>";
                    echo "<td>" . $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["marks"] . "</td>";
                    echo "<td><button class='edit'><a href='./editSubject.php?id=$row[result_id]'><i class='fas fa-edit'></i></a></button><button class='delete'><a href='./deleteSubject.php?id=$row[result_id]'><i class='fas fa-trash'></i></a></button></td>";
                  }
                  echo "</div>";
                } else {
                    echo "<tr><td colspan='7' id='noRes'>No Results</td></tr>";
                }
                echo "</table><br>";
            ?>
            <div class="paginationCont">
                <div class="paginationMain">
                    <?php
                        $query = "SELECT COUNT(*) FROM student_results_view";
                        $baseUrl = "your_page_name.php";
                        
                        if (!empty($searchKeyword)) {
                            $query .= " WHERE result_id LIKE '%$searchKeyword%'";
                            $baseUrl .= "?searchKeyword=$searchKeyword";
                        } else {
                            $baseUrl .= "?";
                        }
                        include("../pages/pagination.php");
                    ?>    
                </div>
            </div>
        </main> 
    </div>
    <script src ="../scripts/confirmAppointment.js"></script>
</body>
</html>
