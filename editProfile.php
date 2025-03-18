<?php
session_start();
if (!isset($_SESSION['MEMBERID'])) {
    header("Location:login.php");
}
//include 'system/function.php';
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

            <div class="container-fluid p-3 m-0 pb-0">
                <span class="navbar-text mt-3">
                    <h6 class="text-primary text-center">Welcome <?php echo $_SESSION['FIRSTNAME']; ?> <?php echo $_SESSION['LASTNAME']; ?> !</h6>
                </span>
            </div>
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


        <!--        ///////////////////////////////////////////////////edit profile section///////////////////////////////////////////////////////////////////////-->
     <div class="container mt-3 mb-5">
            <div class="card mx-auto" style="width: 60%">
                <?php
                include 'system/function.php';
                extract($_POST);

                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                    
                    $firstName = dataClean($firstName);
                    $lastName = dataClean($lastName);
                    $addressLine1 = dataClean($addressLine1);
                    $addressLine2 = dataClean($addressLine2);
                    $addressLine3 = dataClean($addressLine3);
                    $addressLine4 = dataClean($addressLine4);
                    $city = dataClean($city);
                    $nic = dataClean($nic);
                    $email = dataClean($email);
                    $phoneNumber1 = dataClean($phoneNumber1);
                    $phoneNumber2 = dataClean($phoneNumber2);
                    $userName = dataClean($userName);

                    //========================Start Validation====================
                    $message = array();
                    if (empty($firstName)) {
                        $message['firstName'] = "First Name should not be empty..!";
                    }
                    if (empty($lastName)) {
                        $message['lastName'] = "Last Name should not be empty..!";
                    }
                    if (empty($addressLine1)) {
                        $message['addressLine1'] = "AddressLine1 should not be empty..!";
                    }
                    if (empty($addressLine2)) {
                        $message['addressLine2'] = "AddressLine2 should not be empty..!";
                    }
                    if (empty($addressLine3)) {
                        $message['addressLine3'] = "AddressLine3 should not be empty..!";
                    }
                    if (empty($city)) {
                        $message['city'] = "City should not be empty..!";
                    }
                    if (empty($districtId)) {
                        $message['districtId'] = "Destrict should not be empty..!";
                    }
                    if (empty($nic)) {
                        $message['nic'] = "NicNumber should not be empty..!";
                    }
                    if (empty($email)) {
                        $message['email'] = "Email should not be empty..!";
                    }
                    if (empty($phoneNumber1)) {
                        $message['phoneNumber1'] = "PhoneNumber1 should not be empty..!";
                    }
                    if (empty($userName)) {
                        $message['userName'] = "UserName should not be empty..!";
                    }

                    if (!empty($firstName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($firstName, 0, 1))) {
                            $message['firstName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($lastName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($lastName, 0, 1))) {
                            $message['lastName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($city)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($city, 0, 1))) {
                            $message['city'] = 'First Letter should be in uppercase';
                        }
                    }

                    if (!empty($nic)) {
                        $test1 = strlen($nic);
                        $test2 = substr($nic, -1, 1);
                        if (!(($test1 == 10 && $test2 == "V") || $test1 == 12)) {
                            $message['nic'] = 'Invalid Nic number';
                        }
                    }

                    if (!empty($email)) {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $message['email'] = 'invalid email';
                        }
                    }

                    if (!empty($phoneNumber1)) {
                        $test1 = substr($phoneNumber1, 0, 3);
                        $test2 = strlen($phoneNumber1);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['phoneNumber1'] = 'invalid phone number';
                        }
                    }
                    if (!empty($phoneNumber2)) {
                        $test1 = substr($phoneNumber2, 0, 3);
                        $test2 = strlen($phoneNumber2);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['phoneNumber2'] = 'invalid phone number';
                        }
                    }
                    
                    //======================Start Insert Records==========================

                    if (empty($message)) {

                        $db = dbConn();
                        $sql = "UPDATE tbl_members SET "
                                . "firstName='$firstName',"
                                . "lastName='$lastName',"
                                . "addressLine1='$addressLine1',"
                                . "addressLine2='$addressLine2',"
                                . "addressLine3='$addressLine3',"
                                . "addressLine4='$addressLine4',"
                                . "city='$city',"
                                . "districtId='$districtId',"
                                . "nic='$nic',"
                                . "email='$email',"
                                . "phoneNumber1='$phoneNumber1',"
                                . "phoneNumber2='$phoneNumber2',"
                                . "userName='$userName'"
                                . "WHERE memberId='{$_SESSION['MEMBERID']}'";
                        $db->query($sql);
                        ?>

                        <div class="card bg-primary">
                            <div class="card-header text-center">
                                <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                                <a class="btn btn-info btn-sm" href="myProfile2.php" role="button">View Profile</a>
                            </div>
                        </div>

                        <?php
                    }
                }

                //============cancel form details====================
                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                    $firstName = "";
                    $lastName = "";
                    $addressLine1 = "";
                    $addressLine2 = "";
                    $addressLine3 = "";
                    $addressLine4 = "";
                    $city = "";
                    $districtId = "";
                    $nic = "";
                    $email = "";
                    $phoneNumber1 = "";
                    $phoneNumber2 = "";
                    $userName = "";
                }
                ?>
                <div class="card-header bg-info">
                    Member Profile Update
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="card-body">
                         <?php
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_members WHERE memberId = '{$_SESSION['MEMBERID']}'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Personal Information</h5></legend>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" value="<?php echo $row['firstName']; ?>">
                                        <div class="text-danger"><?php echo @$message['firstName']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php echo $row['lastName']; ?>">
                                        <div class="text-danger"><?php echo @$message['lastName']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="addressLine1">AddressLine1</label>
                                        <textarea class="form-control" id="addressLine1" name="addressLine1" placeholder="Enter AddressLine1"><?php echo $row['addressLine1']; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine1']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="addressLine2">AddressLine2</label>
                                        <textarea class="form-control" id="addressLine2" name="addressLine2" placeholder="Enter AddressLine2"><?php echo $row['addressLine2']; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine2']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="addressLine3">AddressLine3</label>
                                        <textarea class="form-control" id="addressLine3" name="addressLine3" placeholder="Enter AddressLine3"><?php echo $row['addressLine3']; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine3']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="addressLine4">AddressLine4</label>
                                        <textarea class="form-control" id="addressLine4" name="addressLine4" placeholder="Enter AddressLine4"><?php echo $row['addressLine4']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo $row['city']; ?>">
                                        <div class="text-danger"><?php echo @$message['city']; ?></div>
                                    </div>
                                    <div class="col">
                                        <?php
                                                $db = dbConn();
                                                $sql1 = "SELECT * FROM tbl_districts";
                                                $result1 = $db->query($sql1);
                                                ?>
                                                <label for="districtId" class="form-label">District</label>
                                                <select class="form-control form-select" name="districtId" id="districtId">
                                                    <option value="">--</option>
                                                    <?php
                                                    if ($result1->num_rows > 0) {
                                                        while ($row1 = $result1->fetch_assoc()) {
                                                            echo $districtId;
                                                            ?>
                                                            <option value="<?php echo $row1['districtId']; ?>" <?php if (@$row['districtId'] == $row1['districtId']) { ?> selected <?php } ?>><?php echo $row1['districtName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="text-danger"><?php echo @$message['districtId']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label class="nic">NicNumber</label>
                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC Number" value="<?php echo $row['nic']; ?>">
                                <div class="text-danger"><?php echo @$message['nic']; ?></div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label class="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $row['email']; ?>">
                                <div class="text-danger"><?php echo @$message['email']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="phoneNumber1" class="form-label">PhoneNumber1</label>
                                        <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" placeholder="Enter Phone Number1" value="<?php echo $row['phoneNumber1']; ?>">
                                        <div class="text-danger"><?php echo @$message['phoneNumber1']; ?></div>
                                        <div class="text-primary">eg: +94774563214</div>
                                    </div>
                                    <div class="col">
                                        <label for="phoneNumber2" class="form-label">PhoneNumber2</label>
                                        <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" placeholder="Enter Phone Number2" value="<?php echo $row['phoneNumber2']; ?>">
                                        <div class="text-primary">eg: +94774563214</div>
                                    </div>
                                </div>
                            </div>
                           
                        </fieldset>
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Account Information</h5></legend>
                            <div class="mb-3 ms-2">
                                <label class="userName">UserName</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter User Name" value="<?php echo $row['userName']; ?>">
                                <div class="text-danger"><?php echo @$message['userName']; ?></div>
                            </div>
                          
                        </fieldset>
                                <?php
                            }
                        }
                        ?>

                    </div>
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                    </div>
                </form>
               
            </div>
        </div>

        <!--        ///////////////////////////////////////////////////FOOTER///////////////////////////////////////////////////////////////////////-->

        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">All Rights Reserved-Everest Fitness Center</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>

    </body>
</html>


