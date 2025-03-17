<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
include 'system/function.php';
$db = dbConn();
extract($_POST);
$classId;
$instructorId;
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
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {

            $message = array();

            //======================Start Insert Records==========================

            if (empty($message)) {
                $db = dbConn();
                $sql = "INSERT INTO tbl_class_enrollment("
                . "memberId,"
                . "classId,"
                . "instructorId,"
                . "enrollmentDay,statusId)VALUES("
                . "'$memberId',"
                . "'$classId',"
                . "'$instructorId',"
                . "CURDATE(),'4')";
                $db->query($sql);

                //return the id(auto increment generated) from last query
                $id = $db->insert_id;
                $enrollmentNo = 'E' . date('Y') . date('m') . date('d') . $id;
                //R202502202
                $sql = "UPDATE tbl_class_enrollment SET enrollmentNo='$enrollmentNo' WHERE classEnrollmentId='$id'";
                $db->query($sql);

                $sql1 = "UPDATE tbl_members SET height='$height',weight='$weight', bmi='$BMI' WHERE memberId='$memberId'";
                $db->query($sql1);
                ?>
                <div class="card mb-3" style="background-color: #0066b2">
                    <div class="card-header text-center">
                        <h3 class="text-center text-dark">Enrollment successfully..!<i class="far fa-thumbs-up"></i></h3>
                        <h5 class="card-title text-center">Your Enrollment No: <?php echo $enrollmentNo ?></h5>
                        <a class="btn btn-info btn-sm" href="myClasses.php" role="button">View Classes</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="container mt-3 mb-3">
            <div class="card mx-auto" style="width: 60%">
                <div class="card-header bg-info">
                    Book Your Fitness
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

                        <!----------Instructor Fieldset-------->
                        <?php
                        $sql = "SELECT * FROM tbl_instructors WHERE instructorId = '$instructorId'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Instructor Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="instructorId" style="display: none">Instructor ID</label>
                                        <input type="hidden" class="form-control" id="instructorId" name="instructorId" value="<?php echo $row['instructorId']; ?>" readonly>
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

                                    <?php
                                }
                            }
                            ?>
                        </fieldset>

                        <!--FieldSet 02-->
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_classes WHERE classId = '$classId'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Class Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="classId" style="display: none">class ID</label>
                                        <input type="hidden" class="form-control" id="classId" name="classId" value="<?php echo $row['classId']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="className">Class Name:</label>
                                        <input type="text" class="form-control" id="className" name="className" value="<?php echo $row['className']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="classFees">Class Fees: (Monthly)</label>
                                        <input type="text" class="form-control" id="classFees" name="classFees" value="<?php echo $row['classFees']; ?>" readonly>
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
                                        <input type="text" class="form-control" id="weight" name="weight" oninput="calculateBMI()">
                                    </div>
                                    <div class="col">
                                        <label for="height" class="form-label">Enter Height (M.)</label>
                                        <input type="text" class="form-control" id="height" name="height" oninput="calculateBMI()">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="BMI" class="form-label">Your BMI</label>
                                        <input type="text" class="form-control" id="BMI" name="BMI" readonly>
                                        <!--                                                  <button type="button" class="btn btn-success">Calculate BMI</button>-->
                                    </div>
                                    <div class="col mt-4">
                                        <!--                                                <button type="button" class="btn btn-success">Success</button>-->
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="save">Enroll Now</button>
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
        <script>
            function calculateBMI() {
                let weight = parseFloat(document.getElementById("weight").value);
                let height = parseFloat(document.getElementById("height").value);

                if (weight > 0 && height > 0) {
                    let bmi = weight / (height * height);
                    document.getElementById("BMI").value = bmi.toFixed(2);
                } else {
                    document.getElementById("BMI").value = "Invalid input";
                }
            }
        </script>
    </body>
</html>

