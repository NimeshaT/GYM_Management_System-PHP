<?php
include 'function.php';
$db= dbConn();

// Query to fetch data
//UNOIN ALL-combine select queries
//class invoice-label
$sql = "SELECT 'pending job cards' AS category, COUNT(fitnessJobCardId) AS total FROM tbl_fitness_job_card WHERE statusId='8'
        UNION ALL
        SELECT 'ongoing job cards' AS category, COUNT(fitnessJobCardId) AS total FROM tbl_fitness_job_card WHERE statusId='9'
        UNION ALL
        SELECT 'completed job cards' AS category, COUNT(fitnessJobCardId) AS total FROM tbl_fitness_job_card WHERE statusId='10'";

$result = $db->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON data
echo json_encode($data);

?>


