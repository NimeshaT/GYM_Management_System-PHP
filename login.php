
<?php
//start session
ob_start();
session_start();
//$memberRegistrationNo;
//if (isset($_SESSION['memberRegistrationNo'])) {
//    header("Location:login.php");
//}
//$memberRegistrationNo = $_SESSION['memberRegistrationNo'];
//echo $memberRegistrationNo;
if (isset($_SESSION['memberRegistrationNo'])) {
    $memberRegistrationNo = $_SESSION['memberRegistrationNo'];
} else {
    $memberRegistrationNo = null; // or assign a default value
}
?>

<html>
    <head>
        <title>login form</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="system/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <!--        //////////////////////////////////////////NAVIGATION BAR//////////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid" style="background-color: black;">
            <nav class="navbar navbar-expand-lg " >
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" width="150" alt="gym logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" >
                    <ul class="navbar-nav" >
                        <li class="nav-item ">
                            <a class="nav-link text-primary" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="workout.php">Personal Workouts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="fitness.php">Fitness</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="classes.php">Classes</a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="nav-link text-primary" href="packages.php">Packages</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="instructor.php">Our Instructors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="#">My Profile</a>
                        </li>
                    </ul>
                </div>
                <a href="register.php"><button class="btn btn-outline-primary btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button></a>
                <a href="login.php"> <button class="btn btn-outline-primary btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>

        <!--        ////////////////////////////////////////////////////////////////////////LOGIN SECTION///////////////////////////////////////////////////////////////////////-->
        <div class="login-box mx-auto mt-5" >
            <div class="card card-outline card-primary">
                <div class="card-header bg-black"> 
<!--                    <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                        <h1 class="mb-0"> <b>Everest</b><i><span style="color: #00008B!important;">Fitness</span></i></h1>
                    </a> -->
                    <div class="row">
                           <div class="col-5 border-right">
                                <img src="images/logo.png" alt="logo" width="120" height="100" >
                           </div>
                           <div class="col-7 text-center">
                                <h2>Welcome</h2>
                                <h2 style="color: #00008B!important;">Login !</h2>
                           </div>
                    </div>
<!--                    <div class="container justify-content-center">
                        <img src="images/logo.png" alt="logo" width="150" height="100" ><span style="color: #00008B!important;"><h2>Login Form</h2></span>
                    </div> -->
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Conquer Your Limits, Rise Like Everest!</p>
                    
                    <?php
                    include 'system/function.php';
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "login") {
                        $userName = dataClean($userName);
                        $message = array();
                        if (empty($userName)) {
                            $message['userName'] = "User Name should not be empty..!";
                        }
                        if (empty($password)) {
                            $message['password'] = "Password should not be empty..!";
                        }
                        if (empty($message)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_members WHERE userName='$userName' AND password='" . sha1($password) . "'";
                            $result = $db->query($sql);
                            if ($result->num_rows == 1) {
                                while ($row = $result->fetch_assoc()) {
                                    $_SESSION['MEMBERID'] = $row['memberId'];
                                    $_SESSION['FIRSTNAME'] = $row['firstName'];
                                    $_SESSION['LASTNAME'] = $row['lastName'];
                                }
                                $current = $_GET['current'];
                                if (isset($_GET['current']) && !empty($_GET['current'])) {
                                    header("Location:$current");
                                } else {
                                    header("Location:index2.php");
                                }
                            } else {
                                $message['password'] = "User Name or Password Invalid..!";
                            }
                        }
                    }
                    
                    //cancel button
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                        $userName = "";
                        $password = "";
                    }
                    
                    $current = "";
                    if (isset($_GET['current'])) {
                        $current = $_GET['current'];
                    }
                    ?>
                    
                    <!--start form-->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?current=<?php echo $current ?>" method="post">
                        
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="User Name" id="userName" name="userName">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['userName']; ?></div>
                        
                        <div class="input-group mt-3">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['password']; ?></div>
                        
                        <div class="row mt-3 mb-3">
                            <div class="col-8">
                                <button type="submit" class="btn btn-danger " name="action" value="cancel">Cancel</button>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" name="action" value="login">Sign In</button>
                            </div>
                        </div>
                    </form>
                    
                   
                    <p class="mb-0"> <a href="register.php" class="text-center">
                            Register a new membership
                        </a> 
                    </p>
                </div>
            </div>
        </div>
<!--        ////////////////////////////Footer////////////////////////////-->
<footer class="p-0 m-0 mt-5"> 
    <p class="text-center bg-black  p-2 mb-0" style="color: #0dcaf0!important;">All Rights Reserved-Everest Fitness Center</p>
</footer>

        <script src="js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    </body>
</html>


