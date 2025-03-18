<?php
// Include database connection
include('function.php');

$db= dbConn();
// Fetch bookings data
$bookingsQuery = "SELECT COUNT(*) as count, DATE(bookingDate) as date FROM tbl_bookings GROUP BY DATE(bookingDate)";
$bookingsResult = mysqli_query($db, $bookingsQuery);

$bookingsData = [];
while ($row = mysqli_fetch_assoc($bookingsResult)) {
    $bookingsData[] = $row;
}

// Fetch enrollments data
$enrollmentsQuery = "SELECT COUNT(*) as count, DATE(enrollmentDay) as date FROM tbl_class_enrollment GROUP BY DATE(enrollmentDay)";
$enrollmentsResult = mysqli_query($db, $enrollmentsQuery);

$enrollmentsData = [];
while ($row = mysqli_fetch_assoc($enrollmentsResult)) {
    $enrollmentsData[] = $row;
}

// Send JSON response
echo json_encode([
    'bookings' => $bookingsData,
    'enrollments' => $enrollmentsData
]);
?>

