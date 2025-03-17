<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
include 'system/function.php';
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
                        <li class="nav-item">
                            <a class="nav-link text-info" href="classesLogin.php">Classes</a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="nav-link text-info" href="packagesLogin.php">Packages</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-info" href="instructor2.php">Our Instructors</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="myProfile2.php">My Profile</a>
                        </li>
                    </ul>
                </div>

                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <?php
        //change status-appointment
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "change") {
            $Stid = $_POST['Stid']; 
            $classEnrollmentId = $_POST['classEnrollmentId'];

            $db = dbConn();
            $Stid = $Stid == '4' ? '6' : '4';
            $sql = "UPDATE tbl_class_enrollment SET statusId='$Stid' WHERE classEnrollmentId='$classEnrollmentId'";
            $db->query($sql);
        }
        
        ?>
        <div class="container mt-3 mb-3">
            <div class="card">
                <div class="card-header" style="background-color: #0071c5">
                    <h5 class="text-center">--My Classes--</h5>
                </div>
                <div class="card-body">
                    <?php

//                    $sql = "SELECT * FROM tbl_class_enrollment INNER JOIN tbl_status ON tbl_class_enrollment.statusId=tbl_status.statusId INNER JOIN tbl_classes ON tbl_class_enrollment.classId=tbl_classes.classId INNER JOIN tbl_instructors ON tbl_class_enrollment.instructorId=tbl_instructors.instructorId WHERE memberId='" . $_SESSION['MEMBERID'] . "'";
                    $sql="SELECT 
    tbl_class_enrollment.classEnrollmentId, 
    tbl_class_enrollment.enrollmentNo, 
    tbl_class_enrollment.classId, 
    tbl_class_enrollment.instructorId, 
    tbl_class_enrollment.statusId, 
    tbl_status.statusName, 
    tbl_classes.className, 
    tbl_classes.classDay, 
    tbl_instructors.firstName, 
    tbl_instructors.lastName 
FROM tbl_class_enrollment 
INNER JOIN tbl_status ON tbl_class_enrollment.statusId = tbl_status.statusId 
INNER JOIN tbl_classes ON tbl_class_enrollment.classId = tbl_classes.classId 
INNER JOIN tbl_instructors ON tbl_class_enrollment.instructorId = tbl_instructors.instructorId 
WHERE tbl_class_enrollment.memberId = '" . $_SESSION['MEMBERID'] . "'";
                    $db = dbConn();
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                            ?>
                            <div class="jumbotron jumbotron-fluid bg-light mb-3">
                                <div class="container">
                                    <h5><?php echo $row['classEnrollmentId']; ?> | <?php echo $row['enrollmentNo']; ?> | <?php echo $row['className']; ?> | <?php echo $row['classDay']; ?> | <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></h5>
                                    <button type="button" class="btn btn-primary"><?php echo $row['statusName']; ?></button>
                                    
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<!--                                        <input type="hidden" name="Mid" value="<?php echo $row['memberId'] ?>">-->
                                        <input type="hidden" name="classEnrollmentId" value="<?php echo $row['classEnrollmentId'] ?>">
                                        <input type="hidden" name="Stid" value="<?php echo $row['statusId'] ?>">
                                        <button type="submit" class="btn btn-danger" name="action" value="change">Cancel</button>
                                    </form>
                                </div>
                            </div>
        <?php
    }
}
?>
                </div>
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>


