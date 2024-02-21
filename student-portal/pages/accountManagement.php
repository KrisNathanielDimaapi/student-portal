<?php
include("../phpFiles/dbConnect.php");

$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

$recordPerPage = 13;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$startPage = ($page - 1) * $recordPerPage;

// Modify the SQL query to use the "account_view" view
$sql = "SELECT name, email, role FROM account_view";

// Search if search not empty
if (!empty($searchKeyword)) {
    $sql .= " WHERE name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%' OR role LIKE '%$searchKeyword%'";
}

$sql .= " LIMIT $startPage, $recordPerPage;";

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
    <?php include("../pages/header.php"); ?>
    <link rel="stylesheet" href="../styles/reviews.css">
</head>
<body>
    <div class="container">
        <?php include('adminSidebar.php'); ?>
        <main>
            <h1>Account Management</h1>
            <div class="main-content">
                <div class="contain">
                    <div class="button">
                        <a href="addAccount.php"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="search">
                        <input type="text" name="searchKeyword" value="<?php echo $searchKeyword; ?>" placeholder="  Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>
                <?php
                echo "<table>";
                echo "<tr><th>Name</th><th>Email</th><th>Role</th>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";

                        echo "</td>";

                    }
                    echo "</div>";
                    echo "</table><br>";
                } else {
                    echo "<tr><td colspan='5' id='noRes'>No Results</td></tr>";
                    echo "</table><br>";
                }
                ?>
            </div>
            <div class="paginationCont">
                <div class="paginationMain">
                    <?php
                    $query = "SELECT COUNT(*) FROM account_view";
                    $baseUrl = "accountManagement.php";
                    if (!empty($searchKeyword)) {
                        $query .= " WHERE name LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%' OR role LIKE '%$searchKeyword%'";
                        $baseUrl .= "?searchKeyword=$searchKeyword";
                    } else {
                        $baseUrl .= "?";
                    }
                    // Pass $connect to pagination.php
                    include("../pages/pagination.php");
                    ?>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
