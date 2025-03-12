<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-info">
                        <?php
                        extract($_POST);

                        //echo $appointmentId;
                        //echo $jobCardId;
                        //echo $workoutId;
                        //echo $appointmentTypeId;
                        //echo $instructorId;
                        $instructor_Id = $_SESSION['INSTRUCTORID'];

                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "create_account") {

                            // Start validation
                            $message = array();

                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_workout_schedules("
                                        . "jobCardId,"
                                        . "memberId,"
                                        . "appointmentId,workoutId,slotId,instructorId,statusId)VALUES("
                                        . "'$jobCardId',"
                                        . "'$memberId',"
                                        . "'$appointmentId',"
                                        . "'$workoutId',"
                                        . "'$slotId',"
                                        . "'$instructor_Id','8')";
                                $db->query($sql);

                                $workoutScheduleId = $db->insert_id;
                                foreach ($Services as $Value) {
                                    $sql = "INSERT INTO tbl_workout_schedule_services(workoutScheduleId,fitnessId) VALUES('$workoutScheduleId','$Value')";
                                    $db->query($sql);
                                }

                                // Insert fitness services with their corresponding dates
                                if (!empty($_POST['Services']) && !empty($_POST['dates'])) {
                                    foreach ($_POST['Services'] as $fitnessId) {
                                        // Ensure a date is provided
                                        $date = $_POST['dates'][$fitnessId] ?? null;
                                        if (!empty($date)) {
                                            $sql = "INSERT INTO tbl_workout_schedule_services (workoutScheduleId, fitnessId, workoutScheduleDate, jobCardId, statusId)VALUES ('$workoutScheduleId', '$fitnessId', '$date','$jobCardId','8')";
                                            $db->query($sql);
                                        }
                                    }
                                }

                                //                                ===========successful meesage=============
                                ?>
                                <div class="card bg-primary">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-dark">Insert successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                                <?php
                            }
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        //Start Update Records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {

                            $db = dbConn();
                            $sql = "UPDATE tbl_workout_schedules SET "
                                    . "jobCardId='$jobCardId',"
                                    . "memberId='$memberId',"
                                    . "appointmentId='$appointmentId',"
                                    . "workoutId='$workoutId',"
                                    . "slotId='$slotId',"
                                    . "instructorId='$instructorId' "
                                    . "WHERE workoutScheduleId='$workoutScheduleId'";
                            $db->query($sql);
                            $sql = "DELETE FROM tbl_workout_schedule_services WHERE workoutScheduleId='$workoutScheduleId'";
                            $db->query($sql);
                            foreach ($Services as $Value) {
                                $sql = "INSERT INTO tbl_workout_schedule_services(workoutScheduleId,fitnessId) VALUES('$workoutScheduleId','$Value')";
                                $db->query($sql);
                            }
//                                ===========successful meesage=============
                            ?>
                            <div class="card bg-primary" >
                                <div class="card-header text-center">
                                    <h3 class="text-center text-dark">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                </div>
                            </div>
                            <?php
                            $submit = "update";
                        }

                        //start edit records
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_workout_schedules WHERE workoutScheduleId='$workoutScheduleId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $jobCardId = $row['jobCardId'];
                            $memberId = $row['memberId'];
                            $appointmentId = $row['appointmentId'];
                            $FreeItem = $row['FreeItem'];
                            $workoutId = $row['workoutId'];
                            $slotId = $row['slotId'];
                            $instructorId = $row['instructorId'];
                            $workoutScheduleServiceId = $row['workoutScheduleServiceId'];
                            $workoutScheduleId = $row['workoutScheduleId'];

                            //checkboxes
                            $sql = "SELECT * FROM tbl_workout_schedule_services WHERE workoutScheduleId='$workoutScheduleId'";
//                            $sql = "SELECT fitnessId FROM tbl_workout_schedule_services WHERE workoutScheduleId='$workoutScheduleId'";
                            $result = $db->query($sql);
                            $Services = array();
                            while ($row = $result->fetch_assoc()) {
                                $Services[] = $row['workoutScheduleServiceId'];
//                                $Services[] = $row['fitnessId'];
                            }

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Schedule Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="memberId">Member ID</label>
                                    <input type="text" class="form-control" id="memberId" name="memberId" value="<?php echo @$memberId; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="jobCardId">Job Card ID</label>
                                    <input type="text" class="form-control" id="jobCardId" name="jobCardId" value="<?php echo @$jobCardId; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="appointmentId">Appointment ID</label>
                                    <input type="text" class="form-control" id="appointmentId" name="appointmentId" value="<?php echo @$appointmentId; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="workoutId">Workout ID</label>
                                    <input type="text" class="form-control" id="workoutId" name="workoutId" value="<?php echo @$workoutId; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="workoutName">Workout Name</label>
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_personal_workouts WHERE workoutId='$workoutId'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <input type="text" class="form-control" id="workoutName" name="workoutName" value="<?php echo $row['workoutName']; ?>" readonly>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="workoutId">Slot ID</label>
                                    <input type="text" class="form-control" id="slotId" name="slotId" value="<?php echo @$slotId; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="slotName">Slot Name</label>
                                    <?php
                                    //$db= dbConn();
                                    $sql = "SELECT * FROM tbl_time_slots WHERE slotId='$slotId'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <input type="text" class="form-control" id="slotName" name="slotName" value="<?php echo $row['slotName']; ?>" readonly>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>


                                <div class="form-group">
                                    <label for="fitnessName" class="fw-bold">Select Fitness</label>
                                    <?php
                                    $sql = "SELECT * FROM tbl_fitness WHERE workoutId='$workoutId'";
                                    $result = $db->query($sql);
//                                    $sql = "SELECT * FROM tbl_fitness WHERE workoutId='$workoutId'";
//                                    $result = $db->query($sql);
                                    ?>

                                    <div class="row">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input me-2" type="checkbox" value="<?php echo $row['fitnessId']; ?>" id="fitness_<?php echo $row['fitnessId']; ?>" name="Services[]" 
                                                               <?php echo (!empty($Services) && in_array($row['fitnessId'], @$Services)) ? 'checked' : ''; ?> >
                                                        <label class="form-check-label" for="fitness_<?php echo $row['fitnessId']; ?>">
                                                            <?php echo $row['fitnessName']; ?>
                                                        </label>
                                                    </div>

<!--                                                    <input type="date" class="form-control mt-1" id="date" name="Dates[]" >-->
                                                    <input type="date" class="form-control mt-1" id="date" name="dates[<?php echo $row['fitnessId']; ?>]" >
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>




                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="workoutScheduleId" value="<?php echo @$workoutScheduleId; ?>">
                                    <button type="submit" class="btn btn-info" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                    <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Table of Schedule Dates</h3>
                        </div>
                        <?php
//                        if (!empty($workoutScheduleId)) {
                            ?>
                            <div class="card-body">

                                <?php
                                $db = dbConn();
                                //$sql = "SELECT * FROM tbl_workout_schedule_services INNER JOIN tbl_fitness ON tbl_workout_schedule_services.fitnessId=tbl_fitness.fitnessId WHERE workoutScheduleId='$workoutScheduleId'";
                                $sql="SELECT * FROM tbl_workout_schedules INNER JOIN tbl_workout_schedule_services ON tbl_workout_schedules.workoutScheduleId=tbl_workout_schedule_services.workoutScheduleId INNER JOIN tbl_fitness ON tbl_workout_schedule_services.fitnessId=tbl_fitness.fitnessId WHERE jobCardId='$jobCardId'";
                                $result = $db->query($sql);
                                ?>
                                <table id="fitness_list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Schedule Id</th>
                                            <th>Fitness ID</th>
                                            <th>Fitness Name</th>
                                            <th>Schedules Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>

                                                    <td><?php echo $row['workoutScheduleId']; ?></td>
                                                    <td><?php echo $row['fitnessId']; ?></td>
                                                    <td><?php echo $row['fitnessName']; ?></td>
                                                    <td><?php echo $row['workoutScheduleDate']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
//                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>



