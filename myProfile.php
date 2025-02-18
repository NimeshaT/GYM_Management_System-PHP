<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Gym Management System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    </head>

    <body>

        <!--        //////////////////////////////////////NAVIGATION BAR///////////////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark">
            <nav class="navbar navbar-expand-lg bg-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="150" alt="gym logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link text-info" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="workout.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item ">
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
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="myProfile.php">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////profile section///////////////////////////////////////////////////////////////////////-->
        <div class="d-flex justify-content-center">
        <div class="card border-info mb-3 mt-5" style="max-width: 50rem;">
            <div class="card-header bg-dark text-primary border-info d-flex">
                <img src="images/sad.png" width="50px">
                <span><h6>Oops !</h6></span>
            </div>
            <div class="card-body text-secondary">
                <h5 class="card-title">Please log into the system</h5>
                <p class="card-text">Please log into the system before viewing your profile.</p>
            </div>
            <div class="card-footer bg-transparent border-info">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-warning">Register</a>
            </div>
        </div>
        </div>
        
        
        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>


