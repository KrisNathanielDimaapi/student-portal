<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
include("../phpFiles/dbConnect.php");


$recordPerPage = 13;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;

$searchKeyword = "";

if (isset($_GET["searchKeyword"])) {
    $searchKeyword = $_GET["searchKeyword"];
    $sql = "SELECT * FROM teachers WHERE teacherID LIKE '%$searchKeyword%' OR full_name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%'";
} else {
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
                include('../components/ssidebar.php');  
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
                echo "<tr><th>#</th><th>Name</th><th>Sex</th><th>Address</th><th>Contact</th><th>Email</th></tr>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["teacherID"];
                        echo "<tr>";
                        echo "<td>" . $row["teacherID"] . "</td>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["contact"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        // echo "<td><button class='edit'><a href='./editTeacher.php?teacherID=$row[teacherID]&page=$page'><i class='fas fa-edit'></i></a></button><button class='delete'><a href='./deleteTeacher.php?teacherID=$row[teacherID]&page=$page'><i class='fas fa-trash'></i></a></button></td>";


                    }
                    echo "</div>";
                } else {
                    echo "<tr><td colspan='12' id='noRes'>No Results</td></tr>";
                }
                echo "</table><br>";
                ?>
                <div class="paginationCont">
                    <div class="paginationMain">
                        <?php
                        $query = "SELECT COUNT(*) FROM teachers";
                        $baseUrl = "teacher.php";

                        if (!empty($searchKeyword)) {
                            $query .= " WHERE teacherID LIKE '%$searchKeyword%' OR full_name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%'";
                            $baseUrl .= "?searchKeyword=$searchKeyword";
                        } else {
                            $baseUrl .= "?";
                        }
                        include("../pages/pagination.php");
                        ?>    
                    </div>
                </div>
            </div>
        </main> 
    </div>

    <script src="../scripts/confirmAppointment.js"></script>
</body>
</html>
