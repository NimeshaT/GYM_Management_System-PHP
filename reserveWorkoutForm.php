<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
include 'system/function.php';
$db = dbConn();
extract($_POST);
//$workoutId = $_GET["workoutId"];
$workoutId;
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
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="workout2.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item">
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
                        <li class="nav-item">
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
            <div class="card mx-auto" style="width: 60%">
                <div class="card-header bg-info">
                    Reserve Your Workout
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="card-body">
                        <!--FieldSet 01-->
                        <?php
                        
                        $sql = "SELECT * FROM tbl_members WHERE memberId = '{$_SESSION['MEMBERID']}'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Member Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="memberId" style="display: none">Member ID</label>
                                        <input type="hidden" class="form-control" id="memberId" name="memberId" value="<?php echo $row['memberId']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="memberRegistrationNo">Member Registration No:</label>
                                        <input type="text" class="form-control" id="memberRegistrationNo" name="memberRegistrationNo" value="<?php echo $row['memberRegistrationNo']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['firstName']; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['lastName']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="nic">NIC</label>
                                        <input type="text" class="form-control" id="nic" name="nic" value="<?php echo $row['nic']; ?>" readonly>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        
                        <!--FieldSet 02-->
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_personal_workouts WHERE workoutId = '$workoutId'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Workout Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="workoutId" style="display: none">Member ID</label>
                                        <input type="hidden" class="form-control" id="workoutId" name="workoutId" value="<?php echo $row['workoutId']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="workoutName">Workout Name:</label>
                                        <input type="text" class="form-control" id="workoutName" name="workoutName" value="<?php echo $row['workoutName']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2 mt-0">
                                        
                                    </div>
                                    
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        
                        <!--Fieldset 03-->
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Calculate BMI</h5></legend>
                                    
                                    <div class="mb-3 ms-2 mt-0">
                                        <div class="row">
                                            <div class="col">
                                                <label for="weight" class="form-label">Enter Weight (Kg.)</label>
                                                <input type="text" class="form-control" id="weight" name="weight" value="">
                                            </div>
                                            <div class="col">
                                                <label for="height" class="form-label">Enter Height (M.)</label>
                                                <input type="text" class="form-control" id="height" name="height" value="">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
<!--                                                <label for="BMI" class="form-label">BMI</label>-->
                                                <input type="text" class="form-control" id="BMI" name="BMI" value="" readonly>
                                                  <button type="button" class="btn btn-success">Calculate BMI</button>
                                            </div>
                                            <div class="col mt-4">
<!--                                                <button type="button" class="btn btn-success">Success</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    
                        </fieldset>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="save">Reserve Now</button>
                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 "> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>


        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>
