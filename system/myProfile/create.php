<?php
include '../header.php';
include '../nav.php';
//date_default_timezone_set('Asia/Colombo');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
            ?>
            <div class="row">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_instructors WHERE instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="<?php echo SITE_URL; ?>uploads/<?php echo $row['profilePhoto']; ?>"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $_SESSION['FIRSTNAME'] ?> <?php echo $_SESSION['LASTNAME'] ?></h3>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <?php
                                        $db = dbConn();
                                        $currentD = date('y-m-d');
//                                        $sql2 = "SELECT COUNT(ServicesJobCardId) AS todayappointments FROM tbl_services_job_card WHERE EmployeeId='{$_SESSION['EMPLOYEEID']}' AND AppointmentDate='$currentD'";
                                        $sql2 = "SELECT COUNT(appointmentId) AS todayappointments FROM tbl_appointments WHERE appointmentDate='$currentD'";
                                        $result2 = $db->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                <li class="list-group-item">
                                                    <b>Today's Appointments</b> <a class="float-right"><?php echo $row2['todayappointments']; ?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $sql3 = "SELECT COUNT(appointmentId) AS allappointments FROM tbl_appointments";
                                        $result3 = $db->query($sql3);
                                        if ($result3->num_rows > 0) {
                                            while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                <li class="list-group-item">
                                                    <b>Total Appointments</b> <a class="float-right"><?php echo $row3['allappointments']; ?></a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- =====================About me box=================================-->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Nic Number</strong>
                                    <p class="text-muted">
                                        <?php echo $row['nicNo'] ?>
                                    </p>
                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted"><?php echo $row['address'] ?></p>
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Contact No:</strong>
                                    <p class="text-muted"><?php echo $row['telNo'] ?></p>
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Email</strong>
                                    <p class="text-muted"><?php echo $row['email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Completed Fitness</a></li>
                                <li class="nav-item"><a class="nav-link" href="#a" data-toggle="tab">Completed Workout Services</a></li>
                                <!--                                <li class="nav-item"><a class="nav-link" href="#b" data-toggle="tab">Today--</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="#c" data-toggle="tab">All --</a></li>-->
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
<!--                                <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>-->
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!--                                ==============Completed Fitness ----=================-->
                                <div class="active tab-pane" id="activity">
                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');
                                    $sql5 = "SELECT * FROM tbl_fitness_job_card INNER JOIN tbl_bookings ON tbl_fitness_job_card.bookingId=tbl_bookings.bookingId INNER JOIN tbl_fitness ON tbl_fitness_job_card.fitnessId=tbl_fitness.fitnessId INNER JOIN tbl_members ON tbl_fitness_job_card.memberId=tbl_members.memberId LEFT JOIN tbl_instructors ON tbl_fitness_job_card.instructorId=tbl_instructors.instructorId INNER JOIN tbl_status ON tbl_fitness_job_card.statusId=tbl_status.statusId WHERE tbl_fitness_job_card.instructorId='{$_SESSION['INSTRUCTORID']}' AND tbl_fitness_job_card.statusId='10'";
                                    $result5 = $db->query($sql5);
                                    if ($result5->num_rows > 0) {
                                        while ($row = $result5->fetch_assoc()) {
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <b>Job Card Id: <?php echo $row['fitnessJobCardId']; ?></b>
                                                </div>

                                                <div class="user-block">
                                                    Booking Date: <?php echo $row['bookingDate']; ?>
                                                </div>
                                                <div class="user-block">
                                                    Fitness Id: <?php echo $row['fitnessId']; ?>
                                                    <span class="float-right">Fitness Name: <?php echo $row['fitnessName']; ?></span>
                                                </div>
                                                <div class="user-block">
                                                    Member Reg No: <?php echo $row['memberRegistrationNo']; ?>
                                                    <span class="float-right">Member Name: <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                                                </div>

                                                <?php
                                                $statusId = $row['statusId'];
                                                ?>
                                                <div class="btn-group mt-2">
                                                    <?php
                                                    if ($statusId == 10) {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!--                                ===========================Completed Workout Services ---===================-->
                                <div class="tab-pane" id="a">
                                    <?php
                                    $db = dbConn();
                                    $curdate = date('y/m/d');

                                    $sql5 = "SELECT 
    wss.workoutScheduleServiceId, 
    wss.workoutScheduleId, 
    wss.fitnessId, 
    wss.workoutScheduleDate, 
    wss.slotId, 
    wss.jobCardId, 
    wss.statusId, 
    s.statusName,
    w.workoutId,
    w.workoutName,
    m.memberId,
    m.memberRegistrationNo,
    m.firstName,
    m.lastName
FROM tbl_workout_schedule_services wss
INNER JOIN tbl_status s ON wss.statusId = s.statusId
INNER JOIN tbl_workout_schedules ws ON wss.workoutScheduleId = ws.workoutScheduleId
INNER JOIN tbl_personal_workouts w ON ws.workoutId = w.workoutId
INNER JOIN tbl_members m ON ws.memberId = m.memberId
WHERE wss.statusId = '10'
ORDER BY wss.workoutScheduleDate DESC";

                                    $result5 = $db->query($sql5);
                                    if ($result5->num_rows > 0) {
                                        while ($row = $result5->fetch_assoc()) {
                                            ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <b>Job Card Id: <?php echo $row['jobCardId']; ?></b>
                                                </div>

                                                <div class="user-block">
                                                    Booking Date: <?php echo $row['workoutScheduleDate']; ?>
                                                </div>
                                                <div class="user-block">
                                                    Workout Id: <?php echo $row['workoutId']; ?>
                                                    <span class="float-right">Workout Name: <?php echo $row['workoutName']; ?></span>
                                                </div>
                                                <div class="user-block">
                                                    Member Reg No: <?php echo $row['memberRegistrationNo']; ?>
                                                    <span class="float-right">Member Name: <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                                                </div>

                                                <?php
                                                $statusId = $row['statusId'];
                                                ?>
                                                <div class="btn-group mt-2">
                                                    <?php
                                                    if ($statusId == 10) {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName']; ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['StatusName']; ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <!--===================Edit profile====================-->
                                <div class="tab-pane" id="settings">
                                    <?php
                                    $message = []; // Initialize message array
                                    extract($_POST);

                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "upload_image") {
                                        $PreviousProfileImage = isset($_POST['PreviousProfileImage']) ? $_POST['PreviousProfileImage'] : "";
                                        $Photo = $PreviousProfileImage; // Ensure it's always defined

                                        if (!empty($_FILES["profilePhoto"]["name"])) {
                                            $target_dir = "../uploads/";
                                            $target_file = $target_dir . basename($_FILES["profilePhoto"]["name"]);
                                            $uploadOk = 1;
                                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                            $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);

                                            if ($check !== false) {
                                                $uploadOk = 1;
                                            } else {
                                                $message['profilePhoto'] = "File is not an image.";
                                                $uploadOk = 0;
                                            }

                                            if (file_exists($target_file)) {
                                                $message['profilePhoto'] = "Sorry, file already exists.";
                                                $uploadOk = 0;
                                            }

                                            if ($_FILES["profilePhoto"]["size"] > 5000000) {
                                                $message['profilePhoto'] = "Sorry, your file is too large.";
                                                $uploadOk = 0;
                                            }

                                            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                                                $message['profilePhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                $uploadOk = 0;
                                            }

                                            if ($uploadOk == 1) {
                                                if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file)) {
                                                    $Photo = htmlspecialchars(basename($_FILES["profilePhoto"]["name"]));
                                                } else {
                                                    $message['profilePhoto'] = "Sorry, there was an error uploading your file.";
                                                }
                                            }
                                        }

                                        // Ensure $Photo is never empty
                                        if (empty($Photo)) {
                                            $Photo = $PreviousProfileImage;
                                        }

                                        // Update Records
                                        $db = dbConn();
                                        $sql = "UPDATE tbl_instructors SET profilePhoto='$Photo' WHERE instructorId='{$_SESSION['INSTRUCTORID']}'";
                                        $db->query($sql);
                                        ?>
                                        <div class="card " style="background-color: #00008B">
                                            <div class="card-header text-center">
                                                <h3 class="text-center text-light">Update successfully <i class="far fa-thumbs-up"></i></h3>
                                                <!--                                                <a class="btn btn-warning btn-sm" href="#" role="button">View Profile</a>-->
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="profilePhoto" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" id="profilePhoto" name="profilePhoto">
                                            <input type="hidden" name="PreviousProfileImage" value="<?php echo @$profilePhoto; ?>">
                                        </div>

                                        <div class="form-group ms-4">
                                            <button type="submit" class="btn btn-primary" id="action" name="action" value="upload_image">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            </div>

            <?php
            include '../footer.php';
            ?>

            <script>

                function update(element) {
                    $(element).parent().submit();
                }
            </script>
