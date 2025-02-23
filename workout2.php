<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
?>
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
            
<!--            <nav class="navbar navbar-light bg-dark">-->
            <div class="container-fluid p-3 m-0 pb-0">
                <span class="navbar-text mt-3">
                    <h6 class="text-primary text-center">Welcome <?php echo $_SESSION['FIRSTNAME']; ?> <?php echo $_SESSION['LASTNAME']; ?> !</h6>
                </span>
            </div>
            <!--</nav>-->
<!--            <div class="pt-1 mb-2 bg-dark text-white text-center">.bg-primary</div>-->
            <nav class="navbar navbar-expand-lg bg-dark p-0 m-0 mt-0">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="150" alt="gym logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link text-info" href="index2.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="workout2.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="fitnessLogin.php">Fitness</a>
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
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Login  </button></a>
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <?php
        echo '<div class="container mb-5 mt-3">';
        echo '<h1 class="text-center">Personal Training Workouts</h1>';
        echo '<h2 class="text-center text-primary">Personal Training Session</h2>';
        echo '<h4 class="text-center">Every day is another chance to get stronger</h4>';
        
        include 'system/function.php';
        $db = dbConn();
        $sql="SELECT * FROM tbl_personal_workouts";
        
        echo '<div class="row mt-5">';
        
        $result=$db->query($sql);
        while ($row=$result->fetch_assoc()){
        $workoutId=$row['workoutId'];
        $workoutImage=$row['workoutImage'];
        $workoutName=$row['workoutName'];
        $workoutDescription=$row['workoutDescription'];
        
        echo '<div class="col-3 mb-3">';
        echo '<div class="card" style="width: 16rem;">';
        echo '<img class="card-img-top" src="system/uploads/' . $workoutImage . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$workoutName.'</h5>';
        echo '<p class="card-text">'.$workoutDescription.'</p>';
        echo '<ul>';
        $sql="SELECT * FROM tbl_fitness INNER JOIN tbl_personal_workouts ON tbl_fitness.workoutId=tbl_personal_workouts.workoutId WHERE tbl_fitness.workoutId='$workoutId'";
        $result1=$db->query($sql);
        if($result1->num_rows>0){
            while ($row1=$result1->fetch_assoc()){
                $fitnessName=$row1['fitnessName'];
                    echo '<li>'.$fitnessName.'</li>';
            }
        }
        echo '</ul>';
//        echo '<a href="workout2.php" class="btn btn-primary btn-sm">View workouts</a>';
//        echo '<a href="reserveWorkoutForm.php" class="btn btn-success btn-sm d-block">Reserve Workout</a>';
        echo '<div class="text-center mt-3">';
                                echo '<form action="reserveWorkoutForm.php" method="post" >';
                                    echo '<input type="hidden" name="workoutId" value="'.$workoutId.'">';
                                    echo '<button type="submit" class="btn btn-success btn-sm d-block">Reserve Workout</button>';
//                                    echo '<a href="reserveWorkoutForm.php" class="btn btn-success btn-sm d-block">Reserve Workout</a>';
                                echo '</form>';
                            echo '</div>';
        //echo '<br>';
        //echo '<a href="register.php" class="btn btn-primary btn-sm d-block">Register</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        ?>


        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 "> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <?php
//        echo 'hello';
        ?>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
