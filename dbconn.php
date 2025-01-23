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

//$sql="SELECT * FROM tbl_registers";
//$result=$conn->query($sql);
//while ($row=$result->fetch_assoc()){
//    echo $row['FirstName'];
//}

