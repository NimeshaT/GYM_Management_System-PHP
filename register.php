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
                    <img src="images/logo.png" width="100" height="100" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-info" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="#">Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="#">About</a>
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
                extract($_POST);

                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                    $FirstName = dataClean($FirstName);
                    $LastName = dataClean($LastName);
                    $AddressLine1 = dataClean($AddressLine1);
                    $AddressLine2 = dataClean($AddressLine2);
                    $AddressLine3 = dataClean($AddressLine3);
                    $AddressLine4 = dataClean($AddressLine4);
                    $City = dataClean($City);
                    $NicNumber = dataClean($NicNumber);
                    $Email = dataClean($Email);
                    $PhoneNumber1 = dataClean($PhoneNumber1);
                    $PhoneNumber2 = dataClean($PhoneNumber2);
                    $UserName = dataClean($UserName);

                    //========================Start Validation====================
                    $message = array();
                    if (empty($FirstName)) {
                        $message['FirstName'] = "First Name should not be empty..!";
                    }
                    if (empty($LastName)) {
                        $message['LastName'] = "Last Name should not be empty..!";
                    }
                    if (empty($AddressLine1)) {
                        $message['AddressLine1'] = "AddressLine1 should not be empty..!";
                    }
                    if (empty($AddressLine2)) {
                        $message['AddressLine2'] = "AddressLine2 should not be empty..!";
                    }
                    if (empty($AddressLine3)) {
                        $message['AddressLine3'] = "AddressLine3 should not be empty..!";
                    }
                    if (empty($City)) {
                        $message['City'] = "City should not be empty..!";
                    }
                    if (empty($DistrictId)) {
                        $message['DistrictId'] = "Destrict should not be empty..!";
                    }
                    if (empty($NicNumber)) {
                        $message['NicNumber'] = "NicNumber should not be empty..!";
                    }
                    if (empty($Email)) {
                        $message['Email'] = "Email should not be empty..!";
                    }
                    if (empty($PhoneNumber1)) {
                        $message['PhoneNumber1'] = "PhoneNumber1 should not be empty..!";
                    }
                    if (empty($PhoneNumber2)) {
                        $message['PhoneNumber2'] = "PhoneNumber2 should not be empty..!";
                    }
                    if (empty($UserName)) {
                        $message['UserName'] = "UserName should not be empty..!";
                    }
                    if (empty($Password)) {
                        $message['Password'] = "Password should not be empty..!";
                    }
                    if (empty($ConfirmPassword)) {
                        $message['ConfirmPassword'] = "Confirm Password should not be empty..!";
                    }
                    if (empty($message)) {
                        $target_dir = "uploads2/";
                        //return file name from a path(basename)
                        $target_file = $target_dir . basename($_FILES["ProfileImage"]["name"]);
                        $uploadOk = 1;
                        //converts a strings to lowercase(strtolower)
                        //returns a file path information(pathinfo)
                        //return only extension(PATHINFO_EXTENSION)
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["ProfileImage"]["tmp_name"]);
                        if ($check !== false) {
                            //Multi-purpose Internet Mail Extensions                       
                            $uploadOk = 1;
                        } else {
                            $message['ProfileImage'] = "File is not an image.";
                            $uploadOk = 0;
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $message['ProfileImage'] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        //5mb
                        if ($_FILES["ProfileImage"]["size"] > 5000000) {
                            $message['ProfileImage'] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $message['ProfileImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $target_file)) {
                                $Photo = htmlspecialchars(basename($_FILES["ProfileImage"]["name"]));
                            } else {
                                $message['ProfileImage'] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }

                    if (!empty($FirstName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($FirstName, 0, 1))) {
                            $message['FirstName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($LastName)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($LastName, 0, 1))) {
                            $message['LastName'] = 'First Letter should be in uppercase';
                        }
                    }
                    if (!empty($City)) {
                        if (!preg_match("/^[A-Z ]*$/", substr($City, 0, 1))) {
                            $message['City'] = 'First Letter should be in uppercase';
                        }
                    }

                    if (!empty($NicNumber)) {
                        $test1 = strlen($NicNumber);
                        $test2 = substr($NicNumber, -1, 1);
                        if (!(($test1 == 10 && $test2 == "V") || $test1 == 12)) {
                            $message['NicNumber'] = 'Invalid Nic number';
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE NicNumber='$NicNumber'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['NicNumber'] = ' Nic number already exist';
                            }
                        }
                    }

                    if (!empty($Email)) {
                        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                            $message['Email'] = 'invalid email';
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE Email='$Email'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                $message['Email'] = ' Email already exist';
                            }
                        }
                    }

                    if (!empty($UserName)) {
                        $db = dbConn();
                        $sql = "SELECT * FROM tbl_customers WHERE UserName='$UserName'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $message['UserName'] = ' User Name already exist';
                        }
                    }

                    if (!empty($PhoneNumber1)) {
                        $test1 = substr($PhoneNumber1, 0, 3);
                        $test2 = strlen($PhoneNumber1);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['PhoneNumber1'] = 'invalid phone number';
                        }
                    }
                    if (!empty($PhoneNumber2)) {
                        $test1 = substr($PhoneNumber2, 0, 3);
                        $test2 = strlen($PhoneNumber2);
                        if (!(($test1 == "+94") && $test2 == 12)) {
                            $message['PhoneNumber2'] = 'invalid phone number';
                        }
                    }

                    if (!empty($Password)) {
                        if (strlen($Password) < 8) {
                            $message['Password'] = "Password too short!";
                        }
                    }
                    if (!empty($Password)) {
                        if (!preg_match("#[0-9]+#", $Password)) {
                            $message['Password'] = "Password must include at least one number!";
                        }
                    }
                    if (!empty($Password)) {
                        if (!preg_match("#[a-zA-Z]+#", $Password)) {
                            $message['Password'] = "Password must include at least one letter!";
                        }
                    }

                    if (!empty($Password)) {
                        if ($Password != $ConfirmPassword) {
                            $message['ConfirmPassword'] = "Password not match";
                        }
                    }
                    //======================Start Insert Records==========================

                    if (empty($message)) {
                        $db = dbConn();
                        $sql = "INSERT INTO tbl_customers("
                                . "FirstName,"
                                . "LastName,"
                                . "AddressLine1,"
                                . "AddressLine2,"
                                . "AddressLine3,"
                                . "AddressLine4,"
                                . "City,"
                                . "DistrictId,"
                                . "NicNumber,"
                                . "Email,"
                                . "PhoneNumber1,"
                                . "PhoneNumber2,"
                                . "ProfileImage,"
                                . "UserName,"
                                . "Password,StatusId)VALUES("
                                . "'$FirstName',"
                                . "'$LastName',"
                                . "'$AddressLine1',"
                                . "'$AddressLine2',"
                                . "'$AddressLine3',"
                                . "'$AddressLine4',"
                                . "'$City',"
                                . "'$DistrictId',"
                                . "'$NicNumber',"
                                . "'$Email',"
                                . "'$PhoneNumber1',"
                                . "'$PhoneNumber2',"
                                . "'$Photo',"
                                . "'$UserName',"
                                . "'" . sha1($Password) . "','1')";
                        $db->query($sql);

                        //return the id(auto increment generated) from last query
                        $id = $db->insert_id;
                        $custRegNo = 'R' . date('Y') . date('m') . date('d') . $id;
                        //R202203129
                        $sql = "UPDATE tbl_customers SET RegNo='$custRegNo' WHERE CustomerId='$id'";
                        $db->query($sql);

                        $_SESSION['CustRegNo'] = $custRegNo;

                        //Get current page link
                        $current = $_GET['current'];

                        //Email sending to mail.php
                        send_email($Email, $Email, "Registration completed", "Visit this page to login to the system:http://localhost/sms/login.php?current=$current <br> Your Registration No: $custRegNo",);

                        if (empty($current)) {
                            header("Location:customer_registration_success.php");
                        } else {
                            header("Location:customer_registration_success.php?current=" . $current);
                        }
                    }
                }

                //============cancel form details====================
                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                    $FirstName = "";
                    $LastName = "";
                    $AddressLine1 = "";
                    $AddressLine2 = "";
                    $AddressLine3 = "";
                    $AddressLine4 = "";
                    $City = "";
                    $DistrictId = "";
                    $NicNumber = "";
                    $Email = "";
                    $PhoneNumber1 = "";
                    $PhoneNumber2 = "";
                    $Photo = "";
                    $UserName = "";
                    $Password = "";
                    $ConfirmPassword = "";
                }
                ?>
                <div class="card-header bg-info">
                    Registration Form
                </div>

                <?php
                if (!isset($_GET["current"])) {
                    //current location
                    $_GET["current"] = "./";
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?current=<?php echo $_GET["current"] ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Customer Information</h5></legend>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="FirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name" value="<?php echo @$FirstName; ?>">
                                        <div class="text-danger"><?php echo @$message['FirstName']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="LastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name" value="<?php echo @$LastName; ?>">
                                        <div class="text-danger"><?php echo @$message['LastName']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="AddressLine1">AddressLine1</label>
                                        <textarea class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Enter AddressLine1"><?php echo @$AddressLine1; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['AddressLine1']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="AddressLine2">AddressLine2</label>
                                        <textarea class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Enter AddressLine2"><?php echo @$AddressLine2; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['AddressLine2']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="AddressLine3">AddressLine3</label>
                                        <textarea class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Enter AddressLine3"><?php echo @$AddressLine3; ?></textarea>
                                        <div class="text-danger"><?php echo @$message['AddressLine3']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="AddressLine4">AddressLine4</label>
                                        <textarea class="form-control" id="AddressLine4" name="AddressLine4" placeholder="Enter AddressLine4"><?php echo @$AddressLine4; ?></textarea>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="City" class="form-label">City</label>
                                        <input type="text" class="form-control" id="City" name="City" placeholder="Enter City" value="<?php echo @$City; ?>">
                                        <div class="text-danger"><?php echo @$message['City']; ?></div>
                                    </div>
                                    <div class="col">
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM tbl_districts";
                                        $result = $db->query($sql);
                                        ?>
                                        <label for="DistrictId" class="form-label">District</label>
                                        <select class="form-control form-select" name="DistrictId" id="DistrictId">
                                            <option value="">--</option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['DistrictId']; ?>" <?php if (@$DistrictId == $row['DistrictId']) { ?> selected <?php } ?>><?php echo $row['DistrictName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="text-danger"><?php echo @$message['DistrictId']; ?></div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="mb-3 ms-2">
                                <label class="NicNumber">NicNumber</label>
                                <input type="text" class="form-control" id="NicNumber" name="NicNumber" placeholder="Enter NIC Number" value="<?php echo @$NicNumber; ?>">
                                <div class="text-danger"><?php echo @$message['NicNumber']; ?></div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label class="Email">Email</label>
                                <input type="text" class="form-control" id="Email" name="Email" placeholder="Enter Email" value="<?php echo @$Email; ?>">
                                <div class="text-danger"><?php echo @$message['Email']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="PhoneNumber1" class="form-label">PhoneNumber1</label>
                                        <input type="text" class="form-control" id="PhoneNumber1" name="PhoneNumber1" placeholder="Enter Phone Number1" value="<?php echo @$PhoneNumber1; ?>">
                                        <div class="text-danger"><?php echo @$message['PhoneNumber1']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="PhoneNumber2" class="form-label">PhoneNumber2</label>
                                        <input type="text" class="form-control" id="PhoneNumber2" name="PhoneNumber2" placeholder="Enter Phone Number2" value="<?php echo @$PhoneNumber2; ?>">
                                        <div class="text-danger"><?php echo @$message['PhoneNumber2']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 ms-2">
                                <label for="ProfileImage" class="form-label">Profile Image</label>
                                <input class="form-control" type="file" id="ProfileImage" name="ProfileImage">
                                <div class="text-danger"><?php echo @$message['ProfileImage']; ?></div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-2 p-2">
                            <legend  class="float-none w-auto p-2 mb-0"><h5>Customer Account Information</h5></legend>
                            <div class="mb-3 ms-2">
                                <label class="UserName">UserName</label>
                                <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter User Name" value="<?php echo @$UserName; ?>">
                                <div class="text-danger"><?php echo @$message['UserName']; ?></div>
                            </div>
                            <div class="mb-3 ms-2 mt-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="Password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Password" value="<?php echo @$Password; ?>">
                                        <div class="text-danger"><?php echo @$message['Password']; ?></div>
                                    </div>
                                    <div class="col">
                                        <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password" >
                                        <div class="text-danger"><?php echo @$message['ConfirmPassword']; ?></div>
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
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>
        <script src="js/bootstrap.bundle.min.js "></script>
    </body>
</html>


