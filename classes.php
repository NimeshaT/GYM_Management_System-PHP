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
                        <li class="nav-item active">
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


        <!--        ///////////////////////////////////////////////////fitnessClasses section///////////////////////////////////////////////////////////////////////-->
        <div class="container mb-5 mt-3">
            <h1 class="text-center">Fitness Class</h1>
            <h2 class="text-center text-primary">General Group Class</h2>
            <h4 class="text-center">Guiding you every step of the way to success!</h4>
            <?php
            include 'system/function.php';
            $db= dbConn();
            $sql="SELECT * FROM tbl_instructors INNER JOIN tbl_classes ON tbl_instructors.instructorId=tbl_classes.instructorId INNER JOIN tbl_instructor_title ON tbl_instructors.titleId=tbl_instructor_title.titleId ORDER BY tbl_classes.classId";
            $result=$db->query($sql);
            ?>
            <div class="row mt-5">
                <?php
                if($result->num_rows>0){
                    while ($row=$result->fetch_assoc()){
                ?>
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="system/uploads/<?php echo $row['classImage']; ?>" class="card-img-top" alt="classImage">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $row['className']; ?></h5>
                            <h6 class="card-title text-center">(<?php echo $row['titleName']; ?> <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?>)</h6>
                             <p class="card-text"><?php echo $row['classDesc']; ?></p>
                             <ul>
                                 <li><?php echo $row['classDay']; ?></li>
                                <!--Convert Time-->
                                 <?php
                                 $startTime=$row['classStartTime'];
                                 $endTime=$row['classEndTime'];
                                 ?>
                                 <li><?php echo date("g:i A", strtotime($startTime)); ?> - <?php echo date("g:i A", strtotime($endTime)); ?></li>
                                 <li><?php echo $row['classDuration']; ?></li>
                             </ul>
                             <div class="row">
                                 <div class="col-3 d-flex justify-content-start">
                                     <a href="login.php" class="btn btn-success btn-sm">Login</a>
                                 </div>
                                 <div class="col-9 d-flex justify-content-start">
                                     <a href="register.php" class="btn btn-primary btn-sm">Register</a>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>


        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
