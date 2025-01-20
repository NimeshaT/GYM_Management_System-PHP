<html>
    <head>
        <title>login form</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <!--        //////////////////////////////////////////NAVIGATION BAR//////////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid bg-dark ">
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
                <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit" style="margin-right: 15px">  Register Now  </button>
                <a href="login.php"> <button class="btn btn-outline-info btn-sm my-2 my-sm-0" type="submit">  Login  </button></a>
            </nav>
        </div>

        <!--        ////////////////////////////////////////////////////////////////////////LOGIN SECTION///////////////////////////////////////////////////////////////////////-->
        <div class="login-box mx-auto mt-5" >
            <div class="card card-outline card-primary">
                <div class="card-header bg-info"> <a href="../index2.html" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                        <h1 class="mb-0"> <b>Everest</b>Fitness
                        </h1>
                    </a> </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="../index3.html" method="post">
                        <div class="input-group mb-1">
                            <div class="form-floating"> <input id="loginEmail" type="email" class="form-control" value="" placeholder=""> <label for="loginEmail">UserName</label> </div>
                            <div class="input-group-text"> <span class="bi bi-person-fill"></span> </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="form-floating"> <input id="loginPassword" type="password" class="form-control" placeholder=""> <label for="loginPassword">Password</label> </div>
                            <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                        </div> <!--begin::Row-->
                        <div class="row">
                            <div class="col-8 d-inline-flex align-items-center">
                                <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                        Remember Me
                                    </label> </div>
                            </div> <!-- /.col -->
                            <div class="col-4">
                                <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                            </div> <!-- /.col -->
                        </div> <!--end::Row-->
                    </form>
                    <p class="mb-1"> <a href="forgot-password.html">I forgot my password</a> </p>
                    <p class="mb-0"> <a href="register.html" class="text-center">
                            Register a new membership
                        </a> </p>
                </div> <!-- /.login-card-body -->
            </div>
        </div> 
        
<!--        ////////////////////////////Footer////////////////////////////-->
        <footer class="p-0 m-0 fixed-bottom"> 
            <p class="text-center bg-dark  p-2 mb-0 ms-0 text-info">Copyright 1990-2020 by Data. All Rights Reserved.</p>
        </footer>

        <script src="js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    </body>
</html>


