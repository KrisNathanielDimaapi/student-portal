<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../phpFiles/dbConnect.php");


$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

$recordPerPage = 8;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;


$sql = "SELECT * FROM reviews";

if (!empty($searchKeyword)) {
    $sql .= " WHERE reviewID LIKE '%$searchKeyword%' OR subject_name LIKE '%$searchKeyword%' OR studentName LIKE '%$searchKeyword%' OR teacherName LIKE '%$searchKeyword%' OR evaluation LIKE '%$searchKeyword%'";
}

$sql .= " ORDER BY reviewID ASC, studentName ASC LIMIT $startPage, $recordPerPage;";

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
    <title>Review of Teaching Subjects</title>
    <link rel="stylesheet" href="../styles/reviews.css">
    <?php include('header.php'); ?>
</head>

<body>
    <div class="container">
        <?php
        include('../components/ssidebar.php');
        ?>
        <main>
            <h1>Review of Teaching Subjects</h1>

            <div class="main-content">
                <div class="contain">
                    <div class="button">
                        <a href="addStudentReviews.php"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search" id="upd-form">
                        <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
                <?php
                echo "<table>";
                echo "<tr><th>#</th><th>Subject Name</th><th>Student Name</th><th>Teacher Name</th><th>Evaluation</th></tr>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $reviewID = $row["reviewID"];
                        echo "<tr>";
                        echo "<td>" . $row["reviewID"] . "</td>";
                        echo "<td>" . $row["subject_name"] . "</td>";
                        echo "<td>" . $row["studentName"] . "</td>";
                        echo "<td>" . $row["teacherName"] . "</td>";
                        echo "<td>" . $row["evaluation"] . "</td>";
                    }
                    echo "</div>";
                    //   echo "</table><br>";

                } else {
                    echo "<tr><td colspan = '12' id = 'noRes'>No Results</td></tr>";
                }
                echo "</table><br>";
                ?>
                <div class="paginationCont">
                    <div class="paginationMain">
                        <?php
                        $query = "SELECT COUNT(*) FROM reviews";
                        $baseUrl = "studentReviews.php";
                        if (!empty($searchKeyword)) {
                            $query .= " WHERE reviewID LIKE '%$searchKeyword%' OR subject_name LIKE '%$searchKeyword%' OR studentName LIKE '%$searchKeyword%' OR teacherName LIKE '%$searchKeyword%' OR evaluation LIKE '%$searchKeyword%'";
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

    <script src="../scripts/confirmAppointment.js"></script>
</body>

</html>