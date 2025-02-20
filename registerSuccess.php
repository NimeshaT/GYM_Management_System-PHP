<?php
session_start();
//$current=$_GET['current'];
//echo $current;
//
// Validate and sanitize the `current` parameter
$current = isset($_GET['current']) ? htmlspecialchars($_GET['current']) : '';

// Check if the member registration number is set in the session
if (!isset($_SESSION['memberRegistrationNo'])) {
    // Redirect to the registration page if the session variable is not set
    header("Location: register.php");
    exit();
}

$memberRegistrationNo = $_SESSION['memberRegistrationNo'];
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
<!--        <link href="css/style2.css" rel="stylesheet" type="text/css"/>-->
        <title>Gym Management System</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
    </head>
    <body style="background-image: url('images/registerImg.jpg');background-repeat: no-repeat;background-size: cover">

        <!--       ==============================Navbar Section==================================-->
        <div class="container-fluid bg-dark">
            <nav class="navbar navbar-expand-lg bg-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="150" alt="gym logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="workout.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="fitness.php">Fitness</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="classes.php">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="packages.php">Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="instructor.php">Our Instructors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="myProfile.php">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>
        

        <!--        =======================Div section=============================-->
        <div class="container">
            <div class="card mx-auto mt-5" style="width: 60%">
                <div class="card-header bg-primary" >
                    <h2 class="text-center text-dark">Registered successfully <i class="far fa-thumbs-up"></i></h2>
<!--                    email eka hariyatama giyada nedda balanne kohomada-->
<!--                    <h6 class="text-center text-dark">Your registered details sent via email</h6>-->
                    <h6 class="text-center text-dark">Your registered details can be seen on My Profile Page.</h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Your Registration No: <?php echo $memberRegistrationNo; ?></h5>
                    <h6 class="card-text text-center">Welcome to Everest Fitness Center!!</h6>
                    <div class="text-center">
                        <?php
                    
                    ?>
                        <a href="login.php?current=<?php echo urldecode($current);?>" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>

        <!--       ====================Footer Section====================-->
        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-primary">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    </body>
</html>




