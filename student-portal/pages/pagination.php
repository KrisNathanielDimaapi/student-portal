<?php

include("../phpFiles/dbConnect.php");

// Ensure $query is defined
$query = isset($query) ? $query : '';

// Add semicolon to the end of the query
$query .= ";";

// Use $connect for the query
$countRes = mysqli_query($connect, $query);

// Check if the query was successful
if (!$countRes) {
    die("Error in SQL query: " . mysqli_error($connect));
}

// Fetch the row from the result
$row = mysqli_fetch_row($countRes);

// Check if $row is not null and $row[0] is set
if ($row !== null && isset($row[0])) {
    $totalRecords = $row[0];
    $totalPages = ceil($totalRecords / $recordPerPage);
} else {
    // Handle the case where $row is null or $row[0] is not set
    $totalRecords = 0;
    $totalPages = 0;
}

$start = max(1, $page - 2);
$end = min($start + 4, $totalPages);

if ($end > $totalPages) {
    $end = $totalPages;
}

if ($totalPages - $page < 4) {
    $start = max(1, $totalPages - 4);
    $end = $totalPages;
}

if ($page >= 2) {
    echo "<a class='notActive' href='$baseUrl&page=1'> << </a>";
    echo "<a class='notActive' href='$baseUrl&page=" . ($page - 1) . "'> < </a>";
}

for ($i = $start; $i <= $end; $i++) {
    if ($i == $page) {
        $status = 'active';
    } else {
        $status = 'notActive';
    }
    echo "<a class='$status' href='$baseUrl&page=" . $i . "'><p>" . $i . "</p></a>";
}

if ($page < $totalPages) {
    echo "<a class='notActive' href='$baseUrl&page=" . ($page + 1) . "'> > </a>";
    echo "<a class='notActive' href='$baseUrl&page=$totalPages'> >> </a>";
}

?>
