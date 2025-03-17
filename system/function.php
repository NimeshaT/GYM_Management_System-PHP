<?php

function dataClean($data = null) {
//    removes whitespace and other predefined characters from both sides of a string.
    $data = trim($data);
//    Removes backslashes
//    stripcslashes("Thank\s. Please v\isit again.");
    $data = stripcslashes($data);
//    converts some predefined characters to HTML entities.
//    < (less than) becomes &lt;
    $data = htmlspecialchars($data);

    return $data;
}

function dbConn() {
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "gym";

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Database connection error" . $conn->connect_error);
    } else {
        return $conn;
    }
}

//get month by number
function getMonthByNumber($monthName = null){
    $monthNum  = $monthName;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    return $monthName;
}

