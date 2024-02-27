<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");

$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

$recordPerPage = 10;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;


$sql = "SELECT * FROM classes";

if (!empty($searchKeyword)) {
    $sql .= " WHERE classID LIKE '%$searchKeyword%' OR level LIKE '%$searchKeyword%' OR section LIKE '%$searchKeyword%'";
}

$sql .= " ORDER BY classID ASC, section ASC LIMIT $startPage, $recordPerPage;";

$result = $connect->query($sql);
$totalRecords = mysqli_num_rows($result);
if (!$result) {
    die("Error in SQL query: " . $connect->error);
}
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
          <h1>Classes</h1>

          <div class="main-content">
            <div class="contain">

              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>Level</th><th>Section</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["classID"];
                    echo "<tr>";
                    echo "<td>" . $row["classID"] . "</td>";
                    echo "<td>" . $row["level"] . "</td>";
                    echo "<td>" . $row["section"] . "</td>";
                   
  
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
                            $query = "SELECT COUNT(*) FROM classes";
                            $baseUrl = "studentClasses.php";
                            
                            if (!empty($searchKeyword)) {
                                $query .= " WHERE classID LIKE '%$searchKeyword%' OR level LIKE '%$searchKeyword%' OR section LIKE '%$searchKeyword%'";
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