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
                        <li class="nav-item ">
                            <a class="nav-link text-info" href="classes.php">Classes</a>
                        </li>
<!--                        <li class="nav-item ">
                            <a class="nav-link text-info" href="packages.php">Packages</a>
                        </li>-->
                        <li class="nav-item active">
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
        <div class="container mb-5">
            <h1 class="mt-3 text-center">Our Instructors</h1>
            <h3 class="text-center">Strong minds, strong bodies - our instructors guide you to both!</h3>
            <br>
            <?php
            include 'system/function.php';
            $db= dbConn();
            $sql="SELECT * FROM tbl_instructors LIMIT 5";
            $result=$db->query($sql);
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                if($result->num_rows>0){
                while ($row=$result->fetch_assoc()){
                ?>

                <div class="col-3">
                    <div class="card " style="width: 18rem;">
                        <img src="system/uploads/<?php echo $row['profilePhoto']; ?>" class="card-img-top" alt="instructorImage" style="height: 300px;object-fit: cover;width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></h5>
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
