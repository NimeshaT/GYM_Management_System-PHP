<?php
include 'function.php';
$db= dbConn();

// Query to fetch data
//UNOIN ALL-combine select queries
//class invoice-label
$sql = "SELECT 'Class Invoice' AS category, SUM(total) AS total FROM tbl_class_invoice
        UNION ALL
        SELECT 'Workout Invoice' AS category, SUM(totalAmount) AS total FROM tbl_workouts_invoice
        UNION ALL
        SELECT 'Fitness Invoice' AS category, SUM(total) AS total FROM tbl_fitness_invoice";

$result = $db->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON data
echo json_encode($data);

?>


