<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Job Card</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Job Card</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card card-info">
                   
                        <?php
                        extract($_POST);
                        
                        $memberId;
                        $appointmentId;
                        $appointmentTypeId;
                        $workoutId;
                        $slotId;
                        $appointmentDate;
                        
                        if (empty($action)) {
                            $action = 'create_account';
                            $form_title = 'Create';
                            $submit = 'Create';
                            $btn = 'primary';
                        }

                        $submit = 'Save';
                        $btn = 'primary';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'create_account') {

                            $message = array();

                            //validation start
                            if (empty($instructorId)) {
                                $message['instructorId'] = "Instructor Name should not be empty..!";
                            }
                            
                            //validation end
                            
                            //Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_job_card("
                                        . "instructorId,"
                                        . "memberId,"
                                        . "appointmentTypeId,"
                                        . "appointmentId,"
                                        . "workoutId,statusId)VALUES("
                                        . "'$instructorId',"
                                        . "'$memberId',"
                                        . "'$appointmentTypeId',"
                                        . "'$appointmentId',"
                                        . "'$workoutId','7')";
                                
                                $db->query($sql);
                                
                            $sql1="UPDATE tbl_appointments SET statusId='5' WHERE appointmentId='$appointmentId'";
                         $db->query($sql1);
                                $db->query($sql);
                                
                                
                                ?>
                        <div class="card bg-primary">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-light">Insert successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                            <?php
                        }

                            $action = 'create_account';
                            $form_title = 'Create';
                            $submit = 'Create';
                            $btn = 'primary';
                        }

                        //Update Records
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update_account') {
                            
                            $db = dbConn();
                            $sql = "UPDATE tbl_job_card SET "
                                    . "instructorId='$instructorId' "
                                    . "WHERE jobCardId='$jobCardId'";
                            $db->query($sql);
                            ?>
                        <div class="card bg-primary">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-light">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                        <?php
                            $submit = 'Update';
                            $btn = 'success';
                        }
                        
                        //Edit Records
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit_account') {

                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_job_card INNER JOIN tbl_instructors ON tbl_job_card.instructorId=tbl_instructors.instructorId INNER JOIN tbl_appointment_type ON tbl_job_card.appointmentTypeId=tbl_appointment_type.appointmentTypeId INNER JOIN tbl_personal_workouts ON tbl_job_card.workoutId=tbl_personal_workouts.workoutId WHERE jobCardId='$jobCardId'";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();

                            //$instructorId = $row['instructorId'];
                            $jobCardId = $row['jobCardId'];
                            //$firstName = $row['firstName'];
                            //$lastName=$row['lastName'];
                            $appointmentId=$row['appointmentId'];
                            $appointmentTypeId=$row['appointmentTypeId'];
                            $workoutId=$row['workoutId'];
                            
                            $action = 'update_account';
                            $form_title = 'Update';
                            $submit = 'Update';
                            $btn = 'success';
                        }

                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Job Card</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="appointmentId">Appointment ID</label>
                                    <input type="text" class="form-control" id="appointmentId" name="appointmentId" value="<?php echo @$appointmentId ?>" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="appointmentTypeId">Appointment Type ID</label>
                                    <input type="text" class="form-control" id="appointmentTypeId" name="appointmentTypeId" value="<?php echo @$appointmentTypeId ?>" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="workoutId">Workout ID</label>
                                    <input type="text" class="form-control" id="workoutId" name="workoutId" value="<?php echo @$workoutId ?>" readonly>
                                </div>
                              
                                <div class="form-group">
                                    <?php
                                    $db= dbConn();
                                    //$sql="SELECT * FROM tbl_instructors";
                                    //$sql="SELECT * FROM tbl_instructors WHERE NOT IN (SELECT * FROM tbl_job_card INNER JOIN tbl_appointments ON tbl_job_card.appointmentId=tbl_appointments.appointmentId WHERE tbl_appointments.appointmentDate='$appointmentDate' AND tbl_job_card.instructorId='$instructorId' AND tbl_appointments.slotId='$slotId')";
                                    
                                    // SQL query to select instructors who are NOT assigned in job card for the given date and slot
                                    
                                    if (!empty($appointmentDate) && !empty($slotId)) {
                                    $sql = "SELECT * FROM tbl_instructors WHERE instructorId NOT IN (SELECT tbl_job_card.instructorId FROM tbl_job_card INNER JOIN tbl_appointments ON tbl_job_card.appointmentId = tbl_appointments.appointmentId WHERE tbl_appointments.appointmentDate = '$appointmentDate' AND tbl_appointments.slotId = '$slotId')";
                                    }
                                    
                                    $result=$db->query($sql);
                                    ?>
                                    <label for="instructors">Select Instructor</label>
                                    <select class="form-control" name="instructorId" id="instructorId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if($result->num_rows>0){
                                            while ($row=$result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['instructorId']; ?>" <?php if (@$instructorId == $row['instructorId']) { ?> selected <?php } ?>><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                    
                                </div>
                               
                              
                                <div class="text-danger"><?php echo @$message['instructorId']; ?></div>
                                
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="jobCardId" value="<?php echo @$jobCardId ?>">
                                <input type="text" name="memberId" value="<?php echo @$memberId ?>">
                                <button type="submit" class="btn btn-<?php echo @$btn; ?>" name="action" value="<?php echo @$action; ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Table of Job Card Details</h3>
                        </div>
                        <div class="card-body">
<!--                            -----------------Search BAR----------------------->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="appointmentId" id="appointmentId" class="form-control" placeholder="Enter Appointment ID">
                                <button type="submit" class="btn btn-success mt-2 mb-2" name="action" value="search_account">Search</button>
                            </form>

                            <?php
//                            ----------------Search Account-search bar------------------
                            $where=null;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search_account') {
                                if(!empty($appointmentId)){
                                    $where.="WHERE appointmentId='$appointmentId'";
                                }
                            }
                        
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_job_card INNER JOIN tbl_instructors ON tbl_job_card.instructorId=tbl_instructors.instructorId INNER JOIN tbl_status ON tbl_job_card.statusId=tbl_status.statusId $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="job_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Appointment ID</th>
                                        <th>Instructor Name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>

                                                <td><?php echo $row['appointmentId']; ?></td>
                                                <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                                <td><?php echo $row['statusName']; ?></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="jobCardId" value="<?php echo $row['jobCardId']; ?>">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="action" value="edit_account">Edit</button>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    $(function () {
        $('#job_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


