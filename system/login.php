<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Everest Fitness</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
<!--        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>

    <!--Login Form-->
    <body class="hold-transition login-page" style="background-image: url('../images/bg1.jpg');background-repeat: no-repeat;background-size: cover">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h1 class="h1" style=""><b class="text-primary">Everest</b>Fitness</h1>
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

<?php
include 'function.php';
extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'login') {
    //Start Validation
    $UserName = dataClean($UserName);

    $message = array();

    if (empty($UserName)) {
        $message['UserName'] = "User Name should not be empty..!";
    }
    if (empty($Password)) {
        $message['Password'] = "Password should not be empty..!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "SELECT * FROM tbl_instructors WHERE userName='$UserName' and password='" . sha1($Password) . "' and status='1'";
        $result = $db->query($sql);
        if ($result->num_rows == 1) {

            //create session variables
            while ($row = $result->fetch_assoc()) {
                $_SESSION['INSTRUCTORID'] = $row['instructorId'];
                $_SESSION['FIRSTNAME'] = $row['firstName'];
                $_SESSION['LASTNAME'] = $row['lastName'];
                $_SESSION['ROLE'] = $row['roleCode'];
            }

            header("Location:index.php");
        } else {
            $message['Password'] = "Username or Password invalid..";
        }
    }
}
?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="Username" id="UserName" name="UserName">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['UserName']; ?></div>
                        <div class="input-group mt-3 mb-2">
                            <input type="password" class="form-control" placeholder="Password" id="Password" name="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-danger"><?php echo @$message['Password']; ?></div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" name="action" value="login">Sign In</button>
                            </div>
                        </div>
                    </form>

<!--      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
                </div>
            </div>
        </div>

        <!-- jQuery -->
<!--        <script src="plugins/jquery/jquery.min.js"></script>-->
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
    </body>
</html>
