<?php

//start a session to read already assigned session
session_start();

//destroy already created all sessions 
session_destroy();

header("Location:login.php");

