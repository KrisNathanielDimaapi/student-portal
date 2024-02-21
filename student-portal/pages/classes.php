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
    $sql = "SELECT * FROM classes WHERE classID LIKE '%$searchKeyword%' OR level LIKE '%$searchKeyword%' OR section LIKE '%$searchKeyword%'";
} else {
    // Default query without search
    $sql = "SELECT * FROM classes";
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
            include('../components/tsidebar.php'); 
        ?>  
        <main>
          <h1>Classes</h1>

          <div class="main-content">
            <div class="contain">
            <div class="button">
                        <a href="addClasses.php"><i class="fa-solid fa-plus"></i></a>
                    </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </form>
            </div>
            <?php
              echo "<table>";
              echo "<tr><th>#</th><th>Level</th><th>Section</th><th>Action</th></tr>";
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id = $row["classID"];
                    echo "<tr>";
                    echo "<td>" . $row["classID"] . "</td>";
                    echo "<td>" . $row["level"] . "</td>";
                    echo "<td>" . $row["section"] . "</td>";
                    echo "<td><button class='edit'><a href='./edit.php?classID=$row[classID]'><i class='fas fa-edit'></i></a></button><button class='delete'><a href='./deleteClass.php?classID=$row[classID]'><i class='fas fa-trash'></i></a></button></td>";
  
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
                            $baseUrl = "classes.php";
                            
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