<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Gym Management System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--        <link href="css/app.css" rel="stylesheet">-->
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
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="workout.php">Workouts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="classes.php">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="packages.php">Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="#">Our Instructors</a>
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

        <!--////////////////////////////////////////////////CAROUSAL SECTION////////////////////////////////////////////////////////////////////////////-->

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner"  >
                <div class="carousel-item active" style="height: 550px">
                    <img src="images/carousal1.jpg" class="d-block w-100" alt="..." >
                    <div class="carousel-caption d-none d-md-block">
                        <h1>WORKOUTS</h1>
                        <p>Unlock your potential with guided workouts tailored for all fitness levels</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 550px">
                    <img src="images/carousal2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Classes</h1>
                        <p>Welcome to Your Fitness Journey</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 550px">
                    <img src="images/carousal3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Packages</h1>
                        <p>Track progress and celebrate every milestone</p>
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
            <h1 class="text-center">Our Services</h1>
            <h4 class="text-center">Workouts | Fitness Classes | Personal Training</h4>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/service2.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Workout</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    <a href="workout.php" class="btn btn-primary btn-sm">View more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/service2.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Fitness</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    <a href="classes.php" class="btn btn-primary btn-sm">View more...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////OUR PACKAGES///////////////////////////////////////////////////////////////////////-->
        <div class="container mb-5">
            <h1 class="text-center">Our Packages</h1>
            <h4 class="text-center">- We have basic three packages -</h4>
            <div class="row mt-5">
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="images/package1.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">One-to-One Training</h5>
                            <a href="#" class="btn btn-primary btn-sm">View more</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="images/package2.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Package Base Training</h5>
                            <a href="#" class="btn btn-primary btn-sm">View more</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="images/package3.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Normal Training</h5>
                            <a href="#" class="btn btn-primary btn-sm">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        ///////////////////////////////////////////////////Our Instructors///////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark">
            <h1 class="text-center text-white">Our Instructors</h1>
            <h4 class="text-center text-white">Certified Professionals | Diverse Expertise | Passionate & Friendly</h4>
            <div class="container">
                <div class="row mt-5">
                <div class="col-3 mb-3 text-center">
                        <img src="images/user.png" class="rounded-circle" width="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Instructor Name</h5>
                        </div>
                </div>
                <div class="col-3 mb-3 text-center">
                        <img src="images/user.png" class="rounded-circle" width="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Instructor Name</h5>
                        </div>
                </div>
                <div class="col-3 mb-3 text-center">
                        <img src="images/user.png" class="rounded-circle" width="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Instructor Name</h5>
                        </div>
                </div>
                <div class="col-3 mb-3 text-center">
                        <img src="images/user.png" class="rounded-circle" width="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Instructor Name</h5>
                        </div>
                </div>
                <div class="col-3 mb-3 text-center">
                        <img src="images/user.png" class="rounded-circle" width="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white">Instructor Name</h5>
                        </div>
                </div>
            </div>
            </div>
            
        </div>
        <!--        ///////////////////////////////////////////////////CUSTOMER REVIEWS///////////////////////////////////////////////////////////////////////-->
        <div class="container mt-5">
            <h1 class="text-center">Customer Reviews</h1>
            <h4 class="text-center">- customer reviews---</h4>
            <div class="container mt-5 mb-5">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="card p-3 text-center px-4">
                            <div class="user-image">
                                <img src="https://i.imgur.com/PKHvlRS.jpg" class="rounded-circle" width="80">
                            </div>
                            <div class="user-content">
                                <h5 class="mb-0">Bruce Hardy</h5>
                                <span>Software Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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

                    <div class="col-md-4">

                        <div class="card p-3 text-center px-4">

                            <div class="user-image">

                                <img src="https://i.imgur.com/w2CKRB9.jpg" class="rounded-circle" width="80">

                            </div>

                            <div class="user-content">

                                <h5 class="mb-0">Mark Smith</h5>
                                <span>Web Developer</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

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

                    <div class="col-md-4">

                        <div class="card p-3 text-center px-4">

                            <div class="user-image">

                                <img src="https://i.imgur.com/ACeArwY.jpg" class="rounded-circle" width="80" >

                            </div>

                            <div class="user-content">

                                <h5 class="mb-0">Veera  Duncan</h5>
                                <span>Software Architect</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

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


                </div>

            </div>
        </div>
        <!--        ///////////////////////////////////////////////////BODY TRANSFORMATIONS///////////////////////////////////////////////////////////////////////-->
        <div class="container">
            <h1 class="text-center">Body Transformations</h1>
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
