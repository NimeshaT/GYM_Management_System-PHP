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
                        <li class="nav-item active">
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


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <?php
        include 'system/function.php';
        $db = dbConn();
        extract($_POST);
        //echo $fitnessId;
        ?>
        <div class="container mb-5 mt-3">
            <h1 class="">Fitness</h1>
            <h4 class="">Unlock your potential with guided workouts tailored for all fitness levels!</h4>
            <div class="row mt-5">
                <?php
                $sql="SELECT * FROM tbl_fitness INNER JOIN tbl_personal_workouts ON tbl_fitness.workoutId=tbl_personal_workouts.workoutId WHERE tbl_fitness.fitnessId='$fitnessId'";
                $result=$db->query($sql);
                if($result->num_rows>0){
                    while ($row=$result->fetch_assoc()){
                ?>
                <div class="col-3 mb-3">
                    <div class="card" style="width: 16rem;">
                        <img src="system/uploads/<?php echo $row['fitnessImage']; ?>" class="card-img-top" alt="fitnessImage">
                        <div class="card-body text-center">
<!--                            <h5 class="card-title">Bench Press</h5>-->
                            <a href="login.php" class="btn btn-success btn-sm d-block">Login</a>
                            <br>
                            <a href="register.php" class="btn btn-primary btn-sm d-block">Register</a>
                        </div>
                    </div>

                </div>
                <div class="col-9">
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current="true"><h4><?php echo $row['fitnessName']; ?></h4></li>
                        <li class="list-group-item"><?php echo $row['workoutName']; ?></li>
                        <li class="list-group-item"><?php echo $row['fitnessDesc']; ?></li>
<!--                        <li class="list-group-item"><?php echo $row['fitnessMuscleGroup']; ?></li>-->
                    </ul>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>


        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

      

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>


