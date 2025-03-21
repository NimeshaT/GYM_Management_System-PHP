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
                        <li class="nav-item ">
                            <a class="nav-link text-info" href="fitnessLogin.php">Fitness</a>
                        </li>
                        <li class="nav-item active">
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
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////classes section///////////////////////////////////////////////////////////////////////-->
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
                                 <li><?php echo $row['classDuration']; ?> hours</li>
                             </ul>
<!--                                     <a href="joiningClassForm.php" class="btn btn-success btn-sm">Join Now</a>-->
                                     <div class="text-center mt-2 d-flex">
                                <form action="joiningClassForm.php" method="post" >
                                    <input type="hidden" name="classId" value="<?php echo $row['classId']; ?>">
                                     <input type="hidden" name="instructorId" value="<?php echo $row['instructorId']; ?>">
                                    <button type="submit" class="btn btn-success btn-block">Join Now</button>
                                </form>
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

        <footer class="p-0 m-0 "> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
