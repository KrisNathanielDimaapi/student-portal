<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

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
    $sql = "SELECT * FROM subjects WHERE subjectID LIKE '%$searchKeyword%' OR teacherID LIKE '%$searchKeyword%' OR subjectCode LIKE '%$searchKeyword%' OR subject_name LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%'";
} else {
    // Default query without search
    $sql = "SELECT * FROM subjects";
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
          <h1>Subjects</h1>

          <div class="main-content">
            <div class="contain">

              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>Teacher ID</th><th>Subject Code</th><th>Subject Name</th><th>Description</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["subjectID"];
                    echo "<tr>";
                    echo "<td>" . $row["subjectID"] . "</td>";
                    echo "<td>" . $row["teacherID"] . "</td>";
                    echo "<td>" . $row["subjectCode"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    
  
                  }
                  echo "</div>";
                //   echo "</table><br>";
                  
                } else {
                    echo "<tr><td colspan = '12' id = 'noRes'>No Results</td></tr>";
                }
                echo "</table><br>";
            ?>
            <div class = "paginationCont">
                    <div class = "paginationMain">
                        <?php
                            $query = "SELECT COUNT(*) FROM subjects";
                            $baseUrl = "studentSubject.php";
                            
                            if (!empty($searchKeyword)) {
                                $query .= " WHERE subjectID LIKE '%$searchKeyword%' OR teacherID LIKE '%$searchKeyword%' OR subjectCode LIKE '%$searchKeyword%' OR subject_name LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%'";
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