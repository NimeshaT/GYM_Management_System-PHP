<?php

session_start();

if(isset($_SESSION['first_name'])){
    echo $_SESSION['first_name'];
} else {
    echo 'No';
}

if(isset($_SESSION['last_name'])){
    echo $_SESSION['last_name'];
} else {
    echo 'No';
}

