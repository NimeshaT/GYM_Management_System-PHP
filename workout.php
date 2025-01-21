<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Gym Management System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    </head>

    <body>

        <!--        //////////////////////////////////////NAVIGATION BAR///////////////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark">
            <nav class="navbar navbar-expand-lg bg-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="100" height="100" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-info" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="workout.php">Workouts</a>
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
                            <a class="nav-link text-info" href="#">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <div class="container mb-5">
            <h1 class="text-center">Workouts Category</h1>
            <h4 class="text-center">Every day is another chance to get stronger!</h4>
            <div class="row mt-5">
                <div class="col-3 mb-3">
                    <div class="card" style="width: 16rem;">
                        <img src="images/strengthT.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Strength Training</h5>
                             <p class="card-text">Focuses on building muscle strength and endurance</p>
                            <ul>
                                <li>Bench press</li>
                                <li>Squats</li>
                                <li>Push-ups</li>
                                <li>Pull-ups</li>
                                <li>Overhead press</li>
                            </ul>
                           
                             <a href="workout2.php" class="btn btn-primary btn-sm">View workouts</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 16rem;">
                        <img src="images/strengthT.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Cardio Training</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary btn-sm">View workouts</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 16rem;">
                        <img src="images/strengthT.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Functional Training</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary btn-sm">View workouts</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 16rem;">
                        <img src="images/strengthT.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Power Training</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary btn-sm">View workouts</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="width: 16rem;">
                        <img src="images/strengthT.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Recovery Training</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary btn-sm">View workouts</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>

        <?php
//        echo 'hello';
        ?>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
