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
                        <li class="nav-item">
                            <a class="nav-link text-info" href="packagesLogin.php">Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="instructor2.php">Our Instructors</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="myProfile2.php">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Login  </button></a>
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
         <div class="container mt-3 mb-3">
            <div class="card">
                <div class="card-header" style="background-color: #0071c5">
                    <h5 class="text-center">--My Profile--</h5>
                </div>
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_members INNER JOIN  tbl_districts ON tbl_members.districtId =tbl_districts.districtId WHERE "
                        . "memberId = '{$_SESSION['MEMBERID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card ms-3" style="width: 15rem;">
                                        <img class="img-fluid " width="300" src="uploads2/<?php echo $row['profileImage']; ?>">
                                        <ul class="list-group list-group-flush ">
                                            <li class="list-group-item text-center bg-secondary"><?php echo $row['memberRegistrationNo']; ?></li>
                                            <li class="list-group-item text-center bg-light"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            Personal Information
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Address: <?php echo $row['addressLine1']; ?> <?php echo $row['addressLine2']; ?> <?php echo $row['addressLine3']; ?> <?php echo $row['addressLine4']; ?></li>
                                                <li class="list-group-item">City: <?php echo $row['city']; ?></li>
                                                <li class="list-group-item">District: <?php echo $row['districtName']; ?></li>
                                                <li class="list-group-item">Nic: <?php echo $row['nic']; ?></li>
                                                <li class="list-group-item">City: <?php echo $row['email']; ?></li>
                                                <li class="list-group-item">Contact No: <?php echo $row['phoneNumber1']; ?>/ <?php echo $row['phoneNumber2']; ?> </li>
                                                <li class="list-group-item">User Name: <?php echo $row['userName']; ?></li>
                                            </ul>
                                        </div>
<!--                                        <div class="card-footer">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="edit_profile_image.php" class="btn btn-warning" >Edit Profile Image</a>
                                                <a href="edit_profile.php" class="btn btn-primary" >Edit Profile</a>
                                                <a href="change_password.php" class="btn btn-success" >Change Password</a>
                                            </div><br><br>
                                            
                                        </div>-->
                                    </div>

                                </div>
                                <div class="col-3 bg-light">
                                    <a href="viewAppointments.php" class="btn btn-outline-primary " >Edit Profile Image</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >Edit Profile</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >Change Password</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >My Personal Workouts</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >My Fitnesses</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >My Classes</a><br><br>
                                        <a href="viewAppointments.php" class="btn btn-outline-primary " >My Packages</a><br><br>
                                        <a href="myAppointments.php" class="btn btn-outline-primary " >My Appointments</a>
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
