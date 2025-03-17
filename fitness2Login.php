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
                        <li class="nav-item ">
                            <a class="nav-link text-info" href="workout2.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="fitnessLogin.php">Fitness</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="classesLogin.php">Classes</a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="nav-link text-info" href="packagesLogin.php">Packages</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-info" href="instructor2.php">Our Instructors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="myProfile2.php">My Profile</a>
                        </li>
                    </ul>
                </div>
<!--                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Login  </button></a>-->
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
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
<!--            <p class="text-danger">Don't Worry! If you intend to apply multiple fitnesses, We provide facilities through the Booking Form.</p>-->
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
<!--                            <a href="bookingFitnessForm.php" class="btn btn-success btn-sm d-block">Book Now</a>-->
                            <div class="text-center mt-2 btn-sm">
                                <form action="bookingFitnessForm.php" method="post" >
                                    <input type="hidden" name="fitnessId" value="<?php echo $row['fitnessId']; ?>">
                                    <button type="submit" class="btn btn-success">Book Now</button>
                                </form>
                            </div>
<!--                            <br>
                            <a href="register.php" class="btn btn-primary btn-sm d-block">Register</a>-->
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

        <footer class="p-0 m-0 "> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
