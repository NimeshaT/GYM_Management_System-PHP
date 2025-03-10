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

                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }

                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
//                            $PackageName = dataClean($PackageName);

                            // Start validation
                            $message = array();
//                            if (empty($PackageName)) {
//                                $message['PackageName'] = "Package Name should not be empty..!";
//                            }
//                            if (empty($PackagePrice)) {
//                                $message['PackagePrice'] = "Package Price should not be empty..!";
//                            }
//                            if (empty($DiscountRate)) {
//                                $message['DiscountRate'] = "Discount Rate should not be empty..!";
//                            }
//                            if (empty($ServiceDurationId)) {
//                                $message['ServiceDurationId'] = "Consultation Time should not be empty..!";
//                            }
//                            if (empty($ServiceTypeId)) {
//                                $message['ServiceTypeId'] = "ServiceType Name should not be empty..!";
//                            }

                            //Start Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                echo $sql = "INSERT INTO tbl_workout_schedules("
                                . "jobCardId,"
                                . "memberId,"
                                . "appointmentId,workoutId,slotId,instructorId)VALUES("
                                . "'$jobCardId',"
                                . "'$memberId',"
                                . "'$appointmentId',"
                                . "'$workoutId',"
                                . "'$slotId',"
                                . "'$instructorId')";
                                $db->query($sql);

                                $workoutScheduleId = $db->insert_id;
                                foreach ($Services as $Value) {
                                    $sql = "INSERT INTO tbl_workout_schedule_services(workoutScheduleId,fitnessId) VALUES('$workoutScheduleId','$fitnessId')";
                                    $db->query($sql);
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
                                $sql = "INSERT INTO tbl_bridal_packages_services(BridalPackageId,BridalServiceId) VALUES('$BridalPackageId','$Value')";
                                $db->query($sql);
                            }
//                                ===========successful meesage=============
                            ?>
                            <div class="card " style="background-color: #FFD700">
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
                            $sql = "SELECT * FROM tbl_bridal_packages WHERE BridalPackageId='$BridalPackageId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $PackageName = $row['PackageName'];
                            $PackagePrice = $row['PackagePrice'];
                            $DiscountRate = $row['DiscountRate'];
                            $FreeItem = $row['FreeItem'];
                            $PackageImage = $row['PackageImage'];
                            $ServiceDurationId = $row['ServiceDurationId'];
                            $ServiceTypeId = $row['ServiceTypeId'];
                            $BridalPackageId = $row['BridalPackageId'];

                            //checkboxes
                            $sql = "SELECT * FROM tbl_bridal_packages_services WHERE BridalPackageId='$BridalPackageId'";
                            $result = $db->query($sql);
                            $Services = array();
                            while ($row = $result->fetch_assoc()) {
                                $Services[] = $row['BridalServiceId'];
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
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
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

<!--                                <div class="form-group">
                                    <label for="fitnessName">Select Fitness</label>
                                    <?php
                                    //$db = dbConn();
                                    $sql = "SELECT * FROM tbl_fitness WHERE workoutId='$workoutId'";
                                    $result = $db->query($sql);
                                    ?>

                                    <div class="row">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $row['fitnessId']; ?>" id="<?php echo $row['fitnessId']; ?>" name="Services[]"
                                                        <?php
                                                        if (!empty($Services)) {
                                                            if (in_array($row['fitnessId'], @$Services)) {
                                                                ?>
                                                                       checked
                                                                       <?php
                                                                   }
                                                               }
                                                               ?>
                                                               >
                                                        <label class="form-check-label" for="fitnessId">
                                                            <?php echo $row['fitnessName']; ?>
                                                        </label>

                                                    </div>
                                                    <div class="form-group">
                                                                                                                    <label for="workoutId">Slot ID</label>
                                                        <input type="text" class="form-control" id="slotId" name="slotId" value="<?php echo @$slotId; ?>" readonly>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label for="fitnessName" class="fw-bold">Select Fitness</label>
                                    <?php
                                    $sql = "SELECT * FROM tbl_fitness WHERE workoutId='$workoutId'";
                                    $result = $db->query($sql);
                                    ?>

                                    <div class="row">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input me-2" type="checkbox" 
                                                               value="<?php echo $row['fitnessId']; ?>" 
                                                               id="fitness_<?php echo $row['fitnessId']; ?>" 
                                                               name="Services[]" 
                                                               <?php echo (!empty($Services) && in_array($row['fitnessId'], @$Services)) ? 'checked' : ''; ?> >
                                                        <label class="form-check-label" for="fitness_<?php echo $row['fitnessId']; ?>">
                                                            <?php echo $row['fitnessName']; ?>
                                                        </label>
                                                    </div>

                                                    <!-- Date field -->
                                                    <input type="date" class="form-control mt-1" id="date" name="date" >
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="scheduleId" value="<?php echo @$scheduleId; ?>">
                                <button type="submit" class="btn btn-info" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">

                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {
        $('#bridal_list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

</script>


