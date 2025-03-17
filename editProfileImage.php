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


        <!--        ///////////////////////////////////////////////////edit profile section///////////////////////////////////////////////////////////////////////-->
     <div class="container mt-3 mb-5">
            <?php
                extract($_POST);
                $hasErrors = 0;
                
                if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                    $message=array();
                        
                    if(!isset($_FILES["profileImage"])){
                        $message["profileImage"]="Profile Image should not be empty...!";
                    }
                    
                    if (empty($message) AND !empty($_FILES["profileImage"]["name"])) {
                        $target_dir = "uploads2/";
                        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
                        if ($check !== false) {
                        //Multi-purpose Internet Mail Extensions                       
                            $uploadOk = 1;
                        } else {
                            $message['profileImage'] = "File is not an image.";
                            $uploadOk = 0;
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $message['profileImage'] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["profileImage"]["size"] > 5000000) {
                            $message['profileImage'] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $message['profileImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
                                $Photo = htmlspecialchars(basename($_FILES["profileImage"]["name"]));
                            } else {
                                $message['profileImage'] = "Sorry, there was an error uploading your file.";
                            }
                        }
                    } else {
                        $Photo = $PreviousProfileImage;
                    }
                
                    
                   if(empty($Photo) && empty($message["profileImage"])){
                        $message["profileImage"]="Profile Image should not be empty...!"; 
                   }                    
                    
                    
//                   ================Start Update Records==================\
                   
                   $updated = false;
                   
                    if(empty($message) && !empty($Photo)){
                    $db = dbConn();
                    $sql = "UPDATE tbl_members SET "
                    . "profileImage='$Photo'"
                    . "WHERE memberId='{$_SESSION['MEMBERID']}'";
                    $db->query($sql);
                    
                    $updated = true;
                    }
                     if ($updated) {
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
                
                
                If($_SERVER ['REQUEST_METHOD']== "POST" && @$action == "cancel"){
                    $Photo="";
                }
                ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="text-center">--My Profile--</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_members WHERE memberId = '{$_SESSION['MEMBERID']}'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="card ms-3" style="width: 15rem;">
                                        <img class="img-fluid " width="300" src="uploads2/<?php echo $row['profileImage']; ?>">
                                        <ul class="list-group list-group-flush ">
                                            <li class="list-group-item text-center"><?php echo $row['memberRegistrationNo']; ?></li>
                                            <li class="list-group-item text-center"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    Update your profile image
                                </div>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-3 mt-2 ms-3">
                                        <label for="profileImage" class="form-label">Profile Image</label>
                                        <input class="form-control" type="file" id="profileImage" name="profileImage">
                                         <div class="text-danger"><?php echo @$message['profileImage']; ?></div>
                                        <input type="hidden" name="PreviousProfileImage" value="<?php echo @$profileImage; ?>">
                                       
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="action"  value="save">Save</button>
                                        <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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


