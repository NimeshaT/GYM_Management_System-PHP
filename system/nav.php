<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo SITE_URL; ?>index.php" class="nav-link">Home</a>
        </li>
        <!--      <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <!-- Messages Dropdown Menu -->
        <!--      <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                     Message Start 
                    <div class="media">
                      <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                     Message End 
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                     Message Start 
                    <div class="media">
                      <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          John Pierce
                          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                     Message End 
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                     Message Start 
                    <div class="media">
                      <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Nora Silvester
                          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                     Message End 
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li>-->

        <!--        get notification of appointments-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <!--//receptionist appointment count-->
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.appointmentId NOT IN (SELECT appointmentId FROM tbl_job_card)";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $pending_appointments = $row["pending_count"];
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
<!--                    <span class="badge badge-danger navbar-badge"><?php echo $row["pending_count"]; ?></span>-->
                <?php } ?>
                    
                <!--//receptionist class count-->
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count3 FROM `tbl_class_enrollment` WHERE statusId='4'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $pending_class = $row["pending_count3"];
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
<!--                    <span class="badge badge-danger navbar-badge"><?php echo $row["pending_count"]; ?></span>-->
                <?php } ?>
                    
                <!--//receptionist fitness booking count-->
                <?php
                //$db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count1 FROM `tbl_bookings` AS b WHERE b.bookingId NOT IN (SELECT bookingId FROM tbl_fitness_job_card)";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $pending_bookings = $row["pending_count1"];
                $total_notifications = $pending_appointments + $pending_bookings + $pending_class;
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <span class="badge badge-danger navbar-badge"><?php echo $total_notifications; ?></span>
                <?php } ?>
                    
                <!--//instructor workout job card count-->
                    <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count3 FROM `tbl_job_card` WHERE statusId='7' AND instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $pending_f_appointments = $row["pending_count3"];
                ?>
                <?php if ($_SESSION["ROLE"] == "instructor") { ?>
<!--                    <span class="badge badge-danger navbar-badge"><?php echo $row["pending_count"]; ?></span>-->
                <?php } ?>
                    
                    <!--//instructor fitness job card count-->
                    <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count4 FROM `tbl_fitness_job_card` WHERE statusId='7' AND instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                $pending_f_bookings = $row["pending_count4"];
                $tot_notifications = $pending_f_appointments + $pending_f_bookings;
                ?>
                <?php if ($_SESSION["ROLE"] == "instructor") { ?>
                    <span class="badge badge-danger navbar-badge"><?php echo $tot_notifications; ?></span>
                <?php } ?>
                    
                
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
               
                <span class="dropdown-item dropdown-header">Notifications</span>
                <!--//receptionist appointment count-->
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.appointmentId NOT IN (SELECT appointmentId FROM tbl_job_card) AND apt.appointmentTypeId='1'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <a href="http://localhost/gms/system/reservations/workoutReservation.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?php echo $row["pending_count"]; ?> New Workout Appointments
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                
                <!--//instructor job card count-->
                <?php
                //$db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_job_card` WHERE statusId='7' AND instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "instructor") { ?>
                    <a href="http://localhost/gms/system/jobCard/acceptJobCard.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?php echo $row["pending_count"]; ?> New Workout Job Cards
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                
                <!--//receptionist bookings count-->
                <?php
                $db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_bookings` AS b WHERE b.bookingId NOT IN (SELECT bookingId FROM tbl_fitness_job_card) AND b.appointmentTypeId='2'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <a href="http://localhost/gms/system/reservations/fitnessBooking.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?php echo $row["pending_count"]; ?> New fitness Bookings
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                
                <!--//instructor Fitness job card count-->
                <?php
                //$db = dbConn();
                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_fitness_job_card` WHERE statusId='7' AND instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "instructor") { ?>
                    <a href="http://localhost/gms/system/jobCard/acceptFitnessJobCard.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?php echo $row["pending_count"]; ?> New Fitness Job Cards
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                
                <!--//receptionist class count-->
                <?php
//                $db = dbConn();
//                $sql = "SELECT COUNT(*) as pending_count FROM `tbl_appointments` AS apt WHERE apt.appointmentId NOT IN (SELECT appointmentId FROM tbl_job_card) AND apt.appointmentTypeId='1'";
//                $result = $db->query($sql);
//                $row = $result->fetch_assoc();
                ?>
                <?php if ($_SESSION["ROLE"] == "receptionist") { ?>
                    <a href="http://localhost/gms/system/reservations/viewClassEnrollment.php" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?php echo @$pending_class; ?> New Class Enrollment
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link btn btn-danger text-light" href="<?php echo SITE_URL; ?>logout.php" role="button">
                Logout
            </a>
        </li>
    </ul>
</nav>
<!--Start Aside-->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="d-flex flex-column align-items-center text-center">
        <a href="http://localhost/gms/system/index.php" class="brand-link d-flex flex-column align-items-center text-center">
            <span class="brand-text font-weight-light text-primary" style="font-family: 'Yellowtail', cursive;">Everest Fitness</span>
        </a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center ">
            <div class="image text-center" >
                <?php
//              include './function.php';
                $role = $_SESSION['ROLE'];
                $db = dbConn();
                $sql = "SELECT * FROM tbl_instructors INNER JOIN tbl_user_roles ON tbl_instructors.roleCode=tbl_user_roles.roleCode WHERE tbl_instructors.instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <img class="img-fluid" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['profilePhoto']; ?>">
                        <a href="#" class="d-block text-primary mt-2"><?php echo $row['roleName']; ?></a>
                        <?php
                    }
                }
                ?>
                <a href="#" class="d-block text-primary"><?php echo $_SESSION['FIRSTNAME']; ?> <?php echo $_SESSION['LASTNAME']; ?></a>
            </div>

        </div>

        <!-- SidebarSearch Form -->
        <!--      <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>-->

        <!-- /////////////////////////////////////Sidebar Menu////////////////////////////////////////////////////// -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php
                //menu_admin.php
                $menu = "menu_" . $_SESSION['ROLE'] . ".php";
                include $menu;
                ?>

            </ul>
        </nav>
    </div>
</aside>