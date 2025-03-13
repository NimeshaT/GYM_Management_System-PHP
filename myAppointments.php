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

                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <?php
        //change status-cancel
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "change") {
            $Stid = $_POST['Stid']; 
            $appointmentId = $_POST['appointmentId'];

            $db = dbConn();
            $Stid = $Stid == '4' ? '6' : '4';
            $sql = "UPDATE tbl_appointments SET statusId='$Stid' WHERE appointmentId='$appointmentId'";
            $db->query($sql);
        }
        
        ?>
        <div class="container mt-3 mb-3">
            <div class="card">
                <div class="card-header" style="background-color: #0071c5">
                    <h5 class="text-center">--My Appointments--</h5>
                </div>
                <div class="card-body">
                    <?php
        $sql = "SELECT 
            a.appointmentId, 
            a.statusId, 
            s.statusName, 
            atype.appointmentName, 
            w.workoutName, 
            t.slotName, 
            t.slotStartTime, 
            t.slotEndTime 
        FROM tbl_appointments a
        LEFT JOIN tbl_status s ON a.statusId = s.statusId 
        LEFT JOIN tbl_appointment_type atype ON a.appointmentTypeId = atype.appointmentTypeId 
        LEFT JOIN tbl_personal_workouts w ON a.workoutId = w.workoutId 
        LEFT JOIN tbl_time_slots t ON a.slotId = t.slotId 
        WHERE a.memberId = '" . $_SESSION['MEMBERID'] . "'";

//                    $sql = "SELECT * FROM tbl_appointments INNER JOIN tbl_status ON tbl_appointments.statusId=tbl_status.statusId INNER JOIN tbl_appointment_type ON tbl_appointments.appointmentTypeId=tbl_appointment_type.appointmentTypeId INNER JOIN tbl_personal_workouts ON tbl_appointments.workoutId=tbl_personal_workouts.workoutId INNER JOIN tbl_time_slots ON tbl_appointments.slotId=tbl_time_slots.slotId WHERE memberId='" . $_SESSION['MEMBERID'] . "'";
                    $db = dbConn();
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //echo $stid=$row['statusId'];
                            //echo $row['appointment_status']; // From tbl_appointments
                            //echo $row['status_table_status']; // From tbl_status
                            ?>
                            <div class="jumbotron jumbotron-fluid bg-light mb-3">
                                <div class="container">
                                    <h5><?php echo $row['appointmentId']; ?> | <?php echo $row['appointmentName']; ?> | <?php echo $row['workoutName']; ?> | <?php echo $row['slotName']; ?> | <?php echo $row['slotStartTime']; ?> -  | <?php echo $row['slotEndTime']; ?></h5>
                                    <button type="button" class="btn btn-primary"><?php echo $row['statusName']; ?></button>
                                    
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<!--                                        <input type="hidden" name="Mid" value="<?php echo $row['memberId'] ?>">-->
                                        <input type="hidden" name="appointmentId" value="<?php echo $row['appointmentId'] ?>">
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


