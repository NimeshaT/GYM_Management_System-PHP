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
                <div class="col-6">
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
                                        . "appointmentId,workoutId,instructorId,statusId)VALUES("
                                        . "'$jobCardId',"
                                        . "'$memberId',"
                                        . "'$appointmentId',"
                                        . "'$workoutId',"
                                        . "'$instructor_Id','8')";
                                $db->query($sql);

                                $workoutScheduleId = $db->insert_id;
                                foreach ($Services as $Value) {
                                    $sql = "INSERT INTO tbl_workout_schedule_services(workoutScheduleId,fitnessId,jobCardId,statusId) VALUES('$workoutScheduleId','$Value','$jobCardId','8')";
                                    $db->query($sql);
                                }

                                // Insert fitness services with their corresponding dates
                                if (!empty($_POST['Services']) && !empty($_POST['dates'])) {
                                    foreach ($_POST['Services'] as $fitnessId) {
                                        // Ensure a date is provided
                                        $date = $_POST['dates'][$fitnessId] ?? null;
                                        if (!empty($date)) {
                                            //$sql = "INSERT INTO tbl_workout_schedule_services (workoutScheduleId, fitnessId, workoutScheduleDate, jobCardId, statusId)VALUES ('$workoutScheduleId', '$fitnessId', '$date','$jobCardId','8')";
                                            $sql = "UPDATE tbl_workout_schedule_services 
                    SET workoutScheduleDate = '$date' 
                    WHERE workoutScheduleId = '$workoutScheduleId' 
                    AND fitnessId = '$fitnessId'";
                                            $db->query($sql);
                                        }
                                    }
                                }

                                // Insert fitness services with their corresponding slots
                                if (!empty($_POST['Services']) && !empty($_POST['slots'])) {
                                    foreach ($_POST['Services'] as $fitnessId) {
                                        // Ensure a date is provided
                                        $slot = $_POST['slots'][$fitnessId] ?? null;
                                        if (!empty($slot)) {
                                            //$sql = "INSERT INTO tbl_workout_schedule_services (workoutScheduleId, fitnessId, workoutScheduleDate, jobCardId, statusId)VALUES ('$workoutScheduleId', '$fitnessId', '$date','$jobCardId','8')";
                                            $sql1 = "UPDATE tbl_workout_schedule_services 
                    SET slotId = '$slot' 
                    WHERE workoutScheduleId = '$workoutScheduleId' 
                    AND fitnessId = '$fitnessId'";
                                            $db->query($sql1);
                                        }
                                    }
                                }
                                // ===========successful meesage=============
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
                                                        <input class="form-check-input me-2" type="checkbox" value="<?php echo $row['fitnessId']; ?>" 
                                                               id="fitness_<?php echo $row['fitnessId']; ?>" name="Services[]" 
                                                               <?php echo (!empty($Services) && in_array($row['fitnessId'], @$Services)) ? 'checked' : ''; ?> >

                                                        <label class="form-check-label" for="fitness_<?php echo $row['fitnessId']; ?>">
                                                            <?php echo $row['fitnessName']; ?>
                                                        </label>
                                                    </div>

                                                    <!-- Date Selection -->
                                                    <input type="date" class="form-control mt-1" 
                                                           id="date" 
                                                           name="dates[<?php echo $row['fitnessId']; ?>]" 
                                                           min="<?= date('Y-m-d'); ?>" 
                                                           onchange="loadSchedulesSlots(this.value, '<?php echo $instructor_Id; ?>', '<?php echo $row['fitnessId']; ?>')">

                                                    <!-- Unique Slot Dropdown -->
                                                    <div id="slot_schedules_list_<?php echo $row['fitnessId']; ?>">
                                                        <select class="form-control form-select" name="slots[<?php echo $row['fitnessId']; ?>]" id="slot">
                                                            <option value="">Select a slot</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="text" name="workoutScheduleId" value="<?php echo @$workoutScheduleId; ?>">
                                    <button type="submit" class="btn btn-info" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                    <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                ?>
                <div class="col-6">
                </div>
                <?php
                ?>
            </div>
        </div>
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    //============================Check Poya days=====================
<?php
//$db = dbConn();
$sql = "SELECT * FROM tbl_poya_days";
$result = $db->query($sql);

$days = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
//separate year month and date
        $parts = explode("-", $row["poyaDay"]);
        $days[] = array((int) $parts[0], (int) $parts[1], (int) $parts[2]);
    }
}

//php to js view
echo "const poyaDays = " . json_encode($days) . ";";
?>

    $("#date").on("change keyup", e => {
        //check date in an array
        const parts = e.target.value.split("-");
        const year = parseInt(parts[0]);
        const month = parseInt(parts[1]);
        const day = parseInt(parts[2]);

        let isPoya = false;

        for (const i of poyaDays) {
            if (i[0] == year && i[1] == month && i[2] == day) {
                isPoya = true;
                break;
            }
        }

        if (isPoya) {
            window.alert("Selected day is a poya day. Please select a different date.");
            //event target value - enter date
            e.target.value = "";
        } else {
            checkForFreeSlots(e.target.value)
        }
    });
</script>
<script>
    function loadSchedulesSlots(date, instructorId, fitnessId) {
        $.ajax({
            type: 'POST',
            url: 'load_schedule_slot.php',
            data: {date: date, instructorId: instructorId, fitnessId: fitnessId},
            success: function (response) {
                $("#slot_schedules_list_" + fitnessId).html(response); // Update the correct dropdown
            },
            error: function (request, status, error) {
                alert("Error: " + error);
            }
        });
    }

</script>



