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
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="index2.php">Home</a>
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
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Login  </button></a>
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>

        <!--////////////////////////////////////////////////CAROUSAL SECTION////////////////////////////////////////////////////////////////////////////-->
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner"  >
                <div class="carousel-item active" style="height: 550px">
                    <img src="images/carousal1.jpg" class="d-block w-100" alt="carousalImage1" >
                    <div class="carousel-caption d-none d-md-block">
                        <h1>WORKOUTS</h1>
                        <p>Unlock your potential with guided workouts tailored for all fitness levels</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 550px">
                    <img src="images/carousal4.jpg" class="d-block w-100" alt="carousalImage2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Classes</h1>
                        <p>Welcome to Your Fitness Journey</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 550px">
                    <img src="images/carousal3.png" class="d-block w-100" alt="carousalImage3">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Packages</h1>
                        <p>Track progress and celebrate every milestone via Packages</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!--        ////////////////////////////////////////////////////OUR SERVICES/////////////////////////////////////////////////////////////////////////////////-->
        <div class="container mt-5 mb-5">
            <h1 class="text-center">| Our Services |</h1>
            <h4 class="text-center">Personal Workouts | Fitness | Classes</h4>
            <?php
            include 'system/function.php';
            $db = dbConn();
            $sql = "SELECT * FROM tbl_service_type WHERE serviceTypeId !=4 LIMIT 10";
            $result = $db->query($sql);
            //extract($POST);
            ?>
            <div class="row mt-5">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //$serviceTypeId;
                        ?>
                        <div class="col-4">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img class="img-fluid" src="system/uploads/<?php echo $row['serviceTypeImage']; ?>" style="width: 100%;height: 250px;object-fit: cover;">                            
                                    </div>

                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['serviceTypeName']; ?></h5>
                                            <p class="card-text"><?php echo $row['serviceTypeDesc']; ?></p>
                                            <?php
                                            if ($row['serviceTypeId'] == 1) {
                                                ?>
                                                <a href="workout.php" class="btn btn-primary btn-sm">View more...</a>
                                                <?php
                                            } elseif ($row['serviceTypeId'] == 2) {
                                                ?>
                                                <a href="fitness.php" class="btn btn-primary btn-sm">View more...</a>
                                                <?php
                                            } elseif ($row['serviceTypeId'] == 3) {
                                                ?>
                                                <a href="classes.php" class="btn btn-primary btn-sm">View more...</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="index.php" class="btn btn-primary btn-sm">View more...</a>
                                                <?php
                                            }
                                            ?>
                                            <!--                                    <a href="workout.php" class="btn btn-primary btn-sm">View more...</a>-->
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

        <!--        ///////////////////////////////////////////////////OUR PACKAGES///////////////////////////////////////////////////////////////////////-->
        <div class="container mb-5">
            <h1 class="text-center">| Our Packages |</h1>
            <h4 class="text-center">We have basic three packages</h4>
            <?php
            //include 'system/function.php';
            //$db = dbConn();
            $sql = "SELECT * FROM tbl_gym_packages";
            $result = $db->query($sql);
            //extract($POST);
            ?>
            <div class="row mt-5">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <img class="img-fluid" src="system/uploads/<?php echo $row['gymPackageImage']; ?>">                            
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $row['gymPackageName']; ?></h5>
                                    <a href="packages.php" class="btn btn-primary btn-sm">View more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////Our Instructors///////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark pb-3">
            <div class="container pt-5">
                <h1 class="text-center text-white">Our Instructors</h1>
                <h4 class="text-center text-white">Certified Professionals | Diverse Expertise | Passionate & Friendly</h4>
            </div>

            <div class="container">
                <?php
                $sql = "SELECT * FROM tbl_instructors LIMIT 5";
                $result = $db->query($sql);
                ?>
                <div class="row mt-5">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-3 mb-5 text-center">
                                <img src="system/uploads/<?php echo $row['profilePhoto']; ?>" class="rounded-circle" width="200px" height="200px">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-white"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></h5>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="container  d-flex justify-content-center">
                <a href="instructor.php" class="btn btn-primary">Visit Instructor Page...</a>
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////MEMBER REVIEWS///////////////////////////////////////////////////////////////////////-->
        <div class="container mt-5">
            <h1 class="text-center">| Member Reviews |</h1>
            <h4 class="text-center">Success stories from our gym members</h4>
            <div class="container mt-5 mb-5">
                <?php
                $sql = "SELECT * FROM tbl_reviews LIMIT 3";
                $result = $db->query($sql);
                ?>
                <div class="row g-2">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-md-4">
                                <div class="card p-3 text-center px-4">
                                    <div class="user-image">
                                        <img src="https://i.imgur.com/PKHvlRS.jpg" class="rounded-circle" width="80">
                                    </div>
                                    <div class="user-content">
                                        <h5 class="mb-0">Bruce Hardy</h5>
                                        <span>Software Developer</span>
                                        <p><?php echo $row['review']; ?></p>
                                    </div>
                                    <div class="ratings">
                                        <i class="bi bi-star-fill" style="color: blue"></i>
                                        <i class="bi bi-star-fill" style="color: blue"></i>
                                        <i class="bi bi-star-fill" style="color: blue"></i>
                                        <i class="bi bi-star-fill" style="color: blue"></i>
                                        <i class="bi bi-star-fill" style="color: blue"></i>

                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--        ///////////////////////////////////////////////////BODY TRANSFORMATIONS///////////////////////////////////////////////////////////////////////-->
        <!--        <div class="container">
                    <h1 class="text-center">Body Transformations</h1>
                </div>-->

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->
        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
