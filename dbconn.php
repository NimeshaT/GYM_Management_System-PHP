<?php

$server="localhost";
$user="root";
$password="";
$db="gym";

$conn=new mysqli($server,$user,$password,$db);

if($conn->connect_error){
    die("Database connection error".$conn->connect_error);
} else {
    echo 'Database Connected';
}

