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


        <!--        ///////////////////////////////////////////////////fitness exercises section///////////////////////////////////////////////////////////////////////-->
        <?php
        echo '<div class="container mb-5 mt-3">';
        echo '<h1 class="text-center">Fitness Exercises</h1>';
        echo '<h4 class="text-center">Guiding you every step of the way to success!</h4>';

        include 'system/function.php';
        $db = dbConn();
        $sql = "SELECT * FROM tbl_personal_workouts";
        $result = $db->query($sql);
        echo '<div class="row mt-3">';
        while ($row = $result->fetch_assoc()) {
            $workoutId = $row['workoutId'];
            $workoutName = $row['workoutName'];

            echo '<h3 class="text-primary bg-dark font-weight-bold mt-2">' . $workoutName . '</h3>';
//            echo '<div class="row">';

            $sql1 = "SELECT * FROM tbl_fitness INNER JOIN tbl_personal_workouts ON tbl_fitness.workoutId=tbl_personal_workouts.workoutId WHERE tbl_fitness.workoutId='$workoutId'";
            $result1 = $db->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $fitnessId=$row1['fitnessId'];
                    $fitnessImage = $row1['fitnessImage'];
                    $fitnessName = $row1['fitnessName'];
//                    echo '<div class="col-3 mb-3">';
//                    echo '<div class="card" style="width: 15rem;">';
//                    echo '<img src="system/uploads/' . $fitnessImage . '" class="card-img-top" ';
//                    echo '<div class="card-body text-center">';
//                    echo '<h5 class="card-title">' . $fitnessName . '</h5>';
//                    echo '<a href="workout3.php" class="btn btn-primary btn-sm">View More</a>';
//                    echo '</div>';
//                    echo '</div>';
//                    echo '</div>';
                    echo '<div class="col-sm-6 col-md-3 mb-3 mt-3">';
            echo '<div class="card h-100" style="width: 15rem;">';
                echo '<img src="system/uploads/' . $fitnessImage . '" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Workout Name">';
                echo '<div class="card-body text-center">';
                    echo '<h5 class="card-title">'.$fitnessName.'</h5>';
                    //echo '<a href="fitness2.php" class="btn btn-primary btn-sm">View More</a>';
                    echo '                <form action="fitness2.php" method="post" >';
                    echo '                    <input type="hidden" name="fitnessId" value="' . $fitnessId . '">';
                    echo '                    <button type="submit" class="btn btn-primary btn-sm">View More</button>';
                    echo '                </form>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
                }
            }
        }
        echo '</div>';
//            }
        echo '</div>';
        ?>

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>


        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
