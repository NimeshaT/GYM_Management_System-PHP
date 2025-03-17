<?php
ob_start();
//A session is a way to store information (in variables) to be used across multiple pages.Not a computer
session_start();
//include 'system/plugins/mail.php';
// Set default value for $current
$current = isset($_GET['current']) ? $_GET['current'] : '';

// Form action URL
$formAction = htmlspecialchars($_SERVER['PHP_SELF']);
if (!empty($current)) {
    $formAction .= "?current=" . urlencode($current);
}
?>
<html>
    <head>
        <title>Register Page</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <!--        //////////////////////////////////////NAVIGATION BAR///////////////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark">
            <nav class="navbar navbar-expand-lg bg-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="150" alt="gym logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="index.php">Home</a>
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
<!--                        <li class="nav-item">
                            <a class="nav-link text-info" href="packages.php">Packages</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-info" href="instructor.php">Our Instructors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="myProfile.php">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>

        <!--        =================================Member/Student Registration Form Section=======================================-->
        <div class="container mt-3 mb-3">
            <div class="card mx-auto" style="width: 60%">
                <?php
                include 'system/function.php';
                //$db= dbConn();
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
//                    if (empty($PhoneNumber2)) {
//                        $message['PhoneNumber2'] = "PhoneNumber2 should not be empty..!";
//                    }
                    if (empty($userName)) {
                        $message['userName'] = "UserName should not be empty..!";
                    }
                    if (empty($password)) {
                        $message['password'] = "Password should not be empty..!";
                    }
                    if (empty($confirmPassword)) {
                        $message['confirmPassword'] = "Confirm Password should not be empty..!";
                    }
                    if (empty($message)) {
                        $target_dir = "uploads2/";
                        //return file name from a path(basename)
                        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
                        $uploadOk = 1;
                        //converts a strings to lowercase(strtolower),returns a file path information(pathinfo),return only extension(PATHINFO_EXTENSION)
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
                        if ($check !== false) {//Multi-purpose Internet Mail Extensions 
                            $uploadOk = 1;
                        } else {
                            $message['profileImage'] = "File is not an image.";
                            $uploadOk = 0;
                        }
                        if (file_exists($target_file)) {// Check if file already exists
                            $message['profileImage'] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        if ($_FILES["profileImage"]["size"] > 5000000) {// Check file size-5mb
                            $message['profileImage'] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $message['profileImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0; // Allow certain file formats
                        }
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
                                $Photo = htmlspecialchars(basename($_FILES["profileImage"]["name"]));
                            } else {
                                $message['profileImage'] = "Sorry, there was an error uploading your file.";
                            }
                        }
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
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_members WHERE nic='$nic'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['nic'] = ' Nic number already exist';
                            }
                        }
                    }

                    if (!empty($email)) {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $message['email'] = 'invalid email';
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_members WHERE email='$email'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['email'] = ' Email already exist';
                            }
                        }
                    }

                    if (!empty($userName)) {
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_members WHERE userName='$userName'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $message['userName'] = ' User Name already exist';
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

                    if (!empty($password)) {
                        if (strlen($password) < 8) {
                            $message['password'] = "Password too short!";
                        }
                    }
                    if (!empty($password)) {
                        if (!preg_match("#[0-9]+#", $password)) {
                            $message['password'] = "Password must include at least one number!";
                        }
                    }
                    if (!empty($password)) {
                        if (!preg_match("#[a-zA-Z]+#", $password)) {
                            $message['password'] = "Password must include at least one letter!";
                        }
                    }

                    if (!empty($password)) {
                        if ($password != $confirmPassword) {
                            $message['confirmPassword'] = "Password not match";
                        }
                    }
                    
                    //======================Start Insert Records==========================

                    if (empty($message)) {
                        $db = dbConn();
                        $sql = "INSERT INTO tbl_members("
                                . "firstName,"
                                . "lastName,"
                                . "addressLine1,"
                                . "addressLine2,"
                                . "addressLine3,"
                                . "addressLine4,"
                                . "city,"
                                . "districtId,"
                                . "nic,"
                                . "email,"
                                . "phoneNumber1,"
                                . "phoneNumber2,"
                                . "profileImage,"
                                . "userName,"
                                . "password,statusId)VALUES("
                                . "'$firstName',"
                                . "'$lastName',"
                                . "'$addressLine1',"
                                . "'$addressLine2',"
                                . "'$addressLine3',"
                                . "'$addressLine4',"
                                . "'$city',"
                                . "'$districtId',"
                                . "'$nic',"
                                . "'$email',"
                                . "'$phoneNumber1',"
                                . "'$phoneNumber2',"
                                . "'$Photo',"
                                . "'$userName',"
                                . "'" . sha1($password) . "','1')";
                        $db->query($sql);

                        //return the id(auto increment generated) from last query
                        $id = $db->insert_id;
                        $memberRegistrationNo = 'R' . date('Y') . date('m') . date('d') . $id;
                        //R202502202
                        $sql = "UPDATE tbl_members SET memberRegistrationNo='$memberRegistrationNo' WHERE memberId='$id'";
                        $db->query($sql);

                        $_SESSION['memberRegistrationNo'] = $memberRegistrationNo;

                        //Get current page link
                        //$current = $_GET['current'];
                        //$current = isset($_GET['current']) ? $_GET['current'] : '';
                        
                        // Form action URL
//                        $formAction = htmlspecialchars($_SERVER['PHP_SELF']);
//                        if (!empty($current)) {
//                            $formAction .= "?current=" . urlencode($current);
//                        }

                        //Email sending to mail.php
                        //send_email($Email, $Email, "Registration completed", "Visit this page to login to the system:http://localhost/sms/login.php?current=$current <br> Your Registration No: $custRegNo",);

//                        if (empty($current)) {
//                            header("Location:registerSuccess.php");
//                        } else {
//                            header("Location:registerSuccess.php?current=" . $current);
//                        }
                        // Redirect after successful registration
    if (empty($current)) {
        header("Location: registerSuccess.php");
    } else {
        header("Location: registerSuccess.php?current=" . urlencode($current));
    }
    exit();
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
                    $photo = "";
                    $userName = "";
                    $password = "";
                    $confirmPassword = "";
                }
                ?>
                <div class="card-header bg-info">
                    Member Registration Form
                </div>

                <?php
//                if (!isset($_GET["current"])) {
//                    //current location
//                    $_GET["current"] = "./";
//                }
                ?>

                <form action="<?php echo $formAction; ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Personal Information</h5></legend>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" value="<?php echo @$firstName; ?>">
                                        <div class="text-danger"><?php echo @$message['firstName']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php echo @$lastName; ?>">
                                        <div class="text-danger"><?php echo @$message['lastName']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="addressLine1">AddressLine1</label>
                                        <textarea class="form-control" id="addressLine1" name="addressLine1" placeholder="Enter AddressLine1"><?php echo @$addressLine1; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine1']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="addressLine2">AddressLine2</label>
                                        <textarea class="form-control" id="addressLine2" name="addressLine2" placeholder="Enter AddressLine2"><?php echo @$addressLine2; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine2']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="addressLine3">AddressLine3</label>
                                        <textarea class="form-control" id="addressLine3" name="addressLine3" placeholder="Enter AddressLine3"><?php echo @$addressLine3; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['addressLine3']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="addressLine4">AddressLine4</label>
                                        <textarea class="form-control" id="addressLine4" name="addressLine4" placeholder="Enter AddressLine4"><?php echo @$addressLine4; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo @$city; ?>">
                                        <div class="text-danger"><?php echo @$message['city']; ?></div>
                                    </div>
                                    <div class="col">
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_districts";
                                        $result = $db->query($sql);
                                        ?>
                                        <label for="districtId" class="form-label">District</label>
                                        <select class="form-control form-select" name="districtId" id="districtId">
                                            <option value="">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['districtId']; ?>" <?php if (@$districtId == $row['districtId']) { ?> selected <?php } ?>><?php echo $row['districtName']; ?></option>
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
                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC Number" value="<?php echo @$nic; ?>">
                                <div class="text-danger"><?php echo @$message['nic']; ?></div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label class="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo @$email; ?>">
                                <div class="text-danger"><?php echo @$message['email']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="phoneNumber1" class="form-label">PhoneNumber1</label>
                                        <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" placeholder="Enter Phone Number1" value="<?php echo @$phoneNumber1; ?>">
                                        <div class="text-danger"><?php echo @$message['phoneNumber1']; ?></div>
                                        <div class="text-primary">eg: +94774563214</div>
                                    </div>
                                    <div class="col">
                                        <label for="phoneNumber2" class="form-label">PhoneNumber2</label>
                                        <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" placeholder="Enter Phone Number2" value="<?php echo @$phoneNumber2; ?>">
<!--                                        <div class="text-danger"><?php echo @$message['phoneNumber2']; ?></div>-->
                                        <div class="text-primary">eg: +94774563214</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label for="profileImage" class="form-label">Profile Image</label>
                                <input class="form-control" type="file" id="profileImage" name="profileImage">
                                <div class="text-danger"><?php echo @$message['profileImage']; ?></div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Account Information</h5></legend>
                            <div class="mb-3 ms-2">
                                <label class="userName">UserName</label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter User Name" value="<?php echo @$userName; ?>">
                                <div class="text-danger"><?php echo @$message['userName']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo @$password; ?>">
                                        <div class="text-danger"><?php echo @$message['password']; ?></div>
                                        <div class="text-primary">Password must include at least one letter, one number with 8 characters or more</div>
                                    </div>
                                    <div class="col">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" >
                                        <div class="text-danger"><?php echo @$message['confirmPassword']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!--       =======================Footer Section========================-->
        <footer class="p-0 m-0"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-primary">All Rights Reserved-Everest Fitness Center</p>
        </footer>
        <script src="js/bootstrap.bundle.min.js "></script>
    </body>
</html>
<?php
ob_end_flush();
?>


