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


        <!--        ///////////////////////////////////////////////////change password section///////////////////////////////////////////////////////////////////////-->
        <div class="container mt-3 mb-5">
            <?php
            extract($_POST);

            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "save") {
                $message = array();

                if (empty($password)) {
                    $message['password'] = "Existing Password should not be empty..!";
                }
                if (empty($NewPassword)) {
                    $message['NewPassword'] = "New Password should not be empty..!";
                }
                if (empty($ConfirmPassword)) {
                    $message['ConfirmPassword'] = "Confirm Password should not be empty..!";
                }

//                =======================start validation===================
                if (!empty($password)) {
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_members WHERE password=sha1('$password')";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
//                        $message['Password'] = ' Password already exist';
                    } else {
                        $message['Password'] = ' Password not match';
                    }
                }

                if (!empty($NewPassword)) {
                    if ($NewPassword != $ConfirmPassword) {
                        $message['ConfirmPassword'] = "Confirm Password not match";
                    }
                }
//                  if  ================Start Update Records==================
                if (empty($message)) {
                    $db = dbConn();
                    $sql = "UPDATE tbl_members SET "
                            . "password='" . sha1($NewPassword) . "'"
                            . "WHERE memberId='{$_SESSION['MEMBERID']}'";
                    $db->query($sql);
                    ?>

                    <div class="card mx-auto bg-primary">
                        <div class="card-header text-center">
                            <h3 class="text-center text-dark">Update successfully <i class="far fa-thumbs-up"></i></h3>
                            <a class="btn btn-info btn-sm" href="myProfile2.php" role="button">View Profile</a>
                        </div>
                    </div>

                    <?php
                }
            }

            IF ($_SERVER ['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                $password = "";
                $NewPassword = "";
                $ConfirmPassword = "";
            }
            ?>
            <div class="card mx-auto" style="width: 60%">
                <div class="card-header bg-info">
                    <h5 class="">Change password form</h5>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="card" >
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="password" class="form-label">Existing password</label>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Enter existing password" value="<?php echo @$Password ?>">
                                    <div class="text-danger"><?php echo @$message['password']; ?></div>
                                </div>
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="NewPassword" class="form-label">New password</label>
                                    <input class="form-control" type="password" id="NewPassword" name="NewPassword" placeholder="Enter new password" value="<?php echo @$NewPassword ?>">
                                    <div class="text-danger"><?php echo @$message['NewPassword']; ?></div>
                                </div>
                                <div class="mb-3 mt-2 ms-3">
                                    <label for="ConfirmPassword" class="form-label">Confirm password</label>
                                    <input class="form-control" type="password" id="ConfirmPassword" name="ConfirmPassword" placeholder="Re enter your new password" value="<?php echo @$ConfirmPassword ?>">
                                    <div class="text-danger"><?php echo @$message['ConfirmPassword']; ?></div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="action"  value="save">Update</button>
                                    <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                </div>
                            </form>
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


