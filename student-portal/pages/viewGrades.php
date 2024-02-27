<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

$recordPerPage = 13;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;


$loggedInStudentID = $_SESSION["studentID"];
$sql = "SELECT * FROM grades WHERE studentID = $loggedInStudentID";

if (!empty($searchKeyword)) {
    $sql .= " WHERE gradeID LIKE '%$searchKeyword%' OR studName LIKE '%$searchKeyword%' OR subject LIKE '%$searchKeyword%' OR grade LIKE '%$searchKeyword%'";
}

$sql .= " ORDER BY gradeID ASC, studName ASC LIMIT $startPage, $recordPerPage;";

$result = $connect->query($sql);
$totalRecords = mysqli_num_rows($result);
if (!$result) {
    die("Error in SQL query: " . $connect->error);
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
                include('../components/ssidebar.php'); 
        ?>  
        <main>
          <h1>Grades</h1>

          <div class="main-content">
            <div class="contain">

              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>Student Name</th><th>Subject</th><th>Marks</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["gradeID"];
                    echo "<tr>";
                    echo "<td>" . $row["gradeID"] . "</td>";
                    echo "<td>" . $row["studName"] .  "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["grade"] . "</td>";
                    // echo "<td><button class='edit'><a href='./editGrade.php?gradeID=$row[gradeID]'><i class='fas fa-edit'></i></a></button><button class='delete'><a href='./deleteGrade.php?gradeID=$row[gradeID]'><i class='fas fa-trash'></i></a></button></td>";
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
                        $query = "SELECT COUNT(*) FROM grades";
                        $baseUrl = "viewGrades.php";
                        
                        if (!empty($searchKeyword)) {
                            $query .= " WHERE gradeID LIKE '%$searchKeyword%' OR studName LIKE '%$searchKeyword%' OR subject LIKE '%$searchKeyword%' OR grade LIKE '%$searchKeyword%'";
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
