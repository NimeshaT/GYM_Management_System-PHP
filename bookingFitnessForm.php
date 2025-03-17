<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
date_default_timezone_set('Asia/Colombo');
include 'system/function.php';
$db = dbConn();
extract($_POST);
//$workoutId = $_GET["workoutId"];
$fitnessId;
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Gym Management System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="system/plugins/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/luxon@2.3.1/build/global/luxon.min.js"></script>
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
                        <li class="nav-item active">
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
                        <li class="nav-item">
                            <a class="nav-link text-info" href="myProfile2.php">My Profile</a>
                        </li>
                    </ul>
                </div>
<!--                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Login  </button></a>-->
                <a href="index.php"> <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">  Logout  </button></a>
            </nav>
        </div>


        <!--        ///////////////////////////////////////////////////workout section///////////////////////////////////////////////////////////////////////-->
        <div class="container mt-3 mb-3">
            <?php
            //Insert data
            extract($_POST);

            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {

                $message = array();

                if (empty($bookingDate)) {
                    $message['bookingDate'] = "Booking Date should not be empty..!";
                }

                if (empty($slotId)) {
                    $message['slotId'] = "Slot should not be empty..!";
                }

                //================check date and time===================
//                    $isBooked = false;
//                    if (empty($message)) {
//                        $db = dbConn();
//                        $sql = "SELECT * FROM tbl_appointments WHERE ServiceId='$ServiceId' AND AppointmentDate='$AppointmentDate' AND ((StartTime BETWEEN '$StartTime' AND '$EndTime') OR (EndTime BETWEEN '$StartTime' AND '$EndTime')); ";
//                        $result = $db->query($sql);
//                        if ($result->num_rows > 0) {
//                            while ($row = $result->fetch_assoc()) {
//                                $isBooked = true;
//                                
                ?>
                <!--                                <h5 class="text-danger">Already Booked.Please select different date or time</h5>-->
                <?php
//                            }
//                        }
//                    }

                if (empty($message)) {
                    $db = dbConn();
                    $sql = "INSERT INTO tbl_bookings("
                            . "bookingApplyDate,"
                            . "appointmentTypeId,"
                            . "memberId,"
                            . "slotId,"
                            . "fitnessId,"
                            . "fitnessCharge,"
                            . "bookingDate,"
                            . "statusId)VALUES("
                            . "CURDATE(),"
                            . "'2',"
                            . "'$memberId',"
                            . "'$slotId',"
                            . "'$fitnessId',"
                            . "'$fitnessCharge',"
                            . "'$bookingDate',"
                            . "'4')";
                    $db->query($sql);
                    $BId = $db->insert_id;
                    
                    $sql1="UPDATE tbl_members SET height='$height',weight='$weight', bmi='$BMI' WHERE memberId='$memberId'";
                    $db->query($sql1);
                    ?>
                    <div class="card mb-3" style="background-color: #0066b2">
                        <div class="card-header text-center">
                            <h3 class="text-center text-dark">Booking successfully..!<i class="far fa-thumbs-up"></i></h3>
                            <h5 class="card-title text-center">Your Booking No: <?php echo $BId ?></h5>
                            <a class="btn btn-info btn-sm" href="myAppointments.php" role="button">View Appointments</a>
                        </div>
                    </div>
                    <?php
                }
            }
            
            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                $appointmentDate="";
                $slotId="";
                $height="";
                $weight="";
                $BMI="";
            }
            ?>
            <div class="row">
                <div class="col-9">
            <div class="card mx-auto" style="width: 80%">
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
                        
                        <!--FieldSet 02-->
                        <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_fitness WHERE fitnessId = '$fitnessId'";
                        $result = $db->query($sql);
                        ?>
                        <fieldset class="border border-2 p-2 bg-light">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Fitness Information</h5></legend>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="mb-3 ms-2">
                                        <label class="fitnessId" style="display: none">fitness ID</label>
                                        <input type="hidden" class="form-control" id="fitnessId" name="fitnessId" value="<?php echo $row['fitnessId']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2">
                                        <label class="fitnessName">Fitness Name:</label>
                                        <input type="text" class="form-control" id="fitnessName" name="fitnessName" value="<?php echo $row['fitnessName']; ?>" readonly>
                                    </div>
                                    <div class="mb-3 ms-2 mt-0">
                                                <label class="fitnessCharge">Fitness Charge:</label>
                                                <input type="text" class="form-control" id="fitnessCharge" name="fitnessCharge" value="<?php echo $row['fitnessCharge']; ?>" readonly>
                                            </div>
                                    
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        <!--Fieldset 03-->
                                <fieldset class="border border-2 p-2 bg-light">
                                    <legend  class="float-none w-auto p-2 mb-0"><h5>Select Date and Time</h5></legend>
                                    <div class="mb-3 ms-2">
                                        <label for="bookingDate" class="form-label">Select Booking Date</label>
                                        <input type="date" class="form-control" id="bookingDate" name="bookingDate" value="<?php echo @$bookingDate ?>" min="<?= date('Y-m-d'); ?>" onchange="loadSlots(this.value)">
                                        <div class="text-danger"><?php echo @$message['bookingDate']; ?></div>
                                    </div>

                                    <div class="form-group ms-2 mb-3">
                                        <label class="form-label">Slots</label>
                                        <div id="slot_list">
                                            <select class="form-control form-select"  name="slotId" id="slotId">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger"><?php echo @$message['slotId']; ?></div>
                                    <div class="text-danger"><?php echo "if do not show any slots, please select another date"  ?></div>
                                </fieldset>
                        
                        <!--Fieldset 04-->
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
                        <button type="submit" class="btn btn-primary" name="action" value="save">Book Now</button>
                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                    </div>
                </form>
            </div>
                    </div>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Time Slots
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            $sql = "SELECT * FROM tbl_time_slots";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <li class="list-group-item"><?php echo $row['slotName']; ?> | <?php echo $row['slotStartTime']; ?> - <?php echo $row['slotEndTime']; ?></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                </div>
        </div>

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0 "> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>
        <script>
                                                        //============================Check Poya days=====================
<?php

//$db = dbConn();
$sql = "SELECT * FROM tbl_poya_days";
$result = $db->query($sql);

$days = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //separate year month and date
        $parts = explode("-", $row["poyaDay"]);
        $days[] = array((int) $parts[0], (int) $parts[1], (int) $parts[2]);
    }
}

//php to js view
echo "const poyaDays = " . json_encode($days) . ";";
?>

                                            $("#bookingDate").on("change keyup", e => {
                                                //check date in an array
                                                const parts = e.target.value.split("-");
                                                const year = parseInt(parts[0]);
                                                const month = parseInt(parts[1]);
                                                const day = parseInt(parts[2]);

                                                let isPoya = false;

                                                for (const i of poyaDays) {
                                                    if (i[0] == year && i[1] == month && i[2] == day) {
                                                        isPoya = true;
                                                        break;
                                                    }
                                                }

                                                if (isPoya) {
                                                    window.alert("Selected day is a poya day. Please select a different date.");
                                                    //event target value - enter date
                                                    e.target.value = "";
                                                } else {
                                                    checkForFreeSlots(e.target.value);
                                                }
                                            });


                                            //============================Calculate BMI=====================
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
        
        <script src="system/plugins/jquery/jquery.min.js" type="text/javascript"></script>
        <script>
                                                    function loadSlots(bookingDate) {
                                                        var d = "bookingDate=" + bookingDate + "&";
                                                        $.ajax({
                                                            type: 'POST',
                                                            data: d,
                                                            url: 'load_fitness_slot.php',
                                                            success: function (response) {
        //                                                   alert(response);
                                                                $("#slot_list").html(response)
                                                            },
                                                            error: function (request, status, error) {
                                                                alert(error);
                                                            }
                                                        });

                                                    }
        </script>
    </body>
</html>
