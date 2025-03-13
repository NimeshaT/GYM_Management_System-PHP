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
                        <li class="breadcrumb-item active">Acceptance</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Instructor Accepted Job Card</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        extract($_POST);
                        ?>

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="A_Id" placeholder="Enter Appointment Id" value="<?php echo @$A_Id ?>">
                            <input type="text" name="M_Reg" placeholder="Enter Member RegNo" value="<?php echo @$M_Reg?>">
                            <input type="date" name="from" placeholder="Enter from date" value="<?php echo @$from ?>">
                            <input type="date" name="to" placeholder="Enter to date" value="<?php echo @$to ?>">
                            <button type="submit" class="bg-success btn">Search</button>
                        </form>

                        <?php
                        
                        $db = dbConn();
                        $where = null;
                        //dynamically generate the query
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //check Appointment id
                            if (!empty($A_Id)) {
                                $where .= "tbl_appointments.appointmentId='$A_Id' AND";
                            }
                            //check member reg no
                            if (!empty($M_Reg)) {
                                $where .= " tbl_members.memberRegistrationNo='$M_Reg' AND";
                            }
                            //check from to dates
                            if (!empty($from) && !empty($to)) {
                                $where .= " appointmentDate BETWEEN  '$from' AND '$to' AND";
                            }
                            //generate dynamic query remove AND last characters from the string
                            if (!empty($where)) {
                                $where = substr($where, 0, -3);
                                $where = " AND $where";
                            }
                        }
                        
                            //change status
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
                            $db = dbConn();
//                            $Stid = $Stid == '7' ? '8' : '7';
                            $Stid = ($Stid == '7') ? '8' : (($Stid == '8') ? '9' : (($Stid == '9') ? '10' : '7'));
                            $sql = "UPDATE tbl_job_card SET statusId='$Stid' WHERE jobCardId='$Sjid'";
                            $db->query($sql);
                        }
                        
//                        $sql1="SELECT * FROM tbl_job_card INNER JOIN tbl_status ON tbl_job_card.statusId=tbl_status.statusId INNER JOIN tbl_personal_workouts ON tbl_job_card.workoutId=tbl_personal_workouts.workoutId INNER JOIN tbl_appointments ON tbl_job_card.appointmentId = tbl_appointments.appointmentId 
//        INNER JOIN tbl_members ON tbl_appointments.memberId = tbl_members.memberId INNER JOIN tbl_time_slots ON tbl_appointments.slotId=tbl_time_slots.slotId WHERE instructorId='" . $_SESSION['INSTRUCTORID'] . "' $where ORDER BY jobCardId DESC";
                        $sql1="SELECT tbl_job_card.statusId AS jobCardStatusId, tbl_status.statusName, tbl_job_card.jobCardId, 
                tbl_appointments.appointmentId, tbl_appointments.appointmentDate, tbl_appointments.appointmentTypeId, 
                tbl_personal_workouts.workoutId, tbl_personal_workouts.workoutName, 
                tbl_members.memberId, tbl_members.memberRegistrationNo AS memberRegNo, tbl_members.firstName,tbl_members.lastName,
                tbl_time_slots.slotId, tbl_time_slots.slotName, tbl_time_slots.slotStartTime, tbl_time_slots.slotEndTime
         FROM tbl_job_card 
         INNER JOIN tbl_status ON tbl_job_card.statusId = tbl_status.statusId 
         INNER JOIN tbl_personal_workouts ON tbl_job_card.workoutId = tbl_personal_workouts.workoutId 
         INNER JOIN tbl_appointments ON tbl_job_card.appointmentId = tbl_appointments.appointmentId 
         INNER JOIN tbl_members ON tbl_appointments.memberId = tbl_members.memberId 
         INNER JOIN tbl_time_slots ON tbl_appointments.slotId = tbl_time_slots.slotId 
         WHERE tbl_job_card.instructorId = '" . $_SESSION['INSTRUCTORID'] . "' $where ORDER BY tbl_job_card.jobCardId DESC";
                        $result = $db->query($sql1);
                        
                        ?>
                        <table id="jobCard_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Job Card Id</th>
                                    <th>Appointment Id</th>
                                    <th>Appointment Type Id</th>
                                    <th>Workout Id</th>
                                    <th>Workout Name</th>
                                    <th>Member Id</th>
                                    <th>Member Reg No.</th>
                                    <th>Member Name</th>
                                    <th>Appointment Date</th>
                                    <th>Slot No.</th>
                                    <th>Slot Start Time</th>
                                    <th>Slot End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        //echo $appNo=$row['appointmentId'];
                                        //echo $sid=$row['statusId'];
        
                                        ?>
                                        <tr>
                                            <td>
                                                    <?php
                                                    if ($row['jobCardStatusId'] == '7') {
                                                    ?>
                                                        <button type="button" class="btn btn-danger btn-sm"><?php echo $row['statusName'] ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName'] ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                            </td>
                                            <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="change">Change</button>
                                                        <input type="hidden" name="Sjid" value="<?php echo $row['jobCardId'] ?>">
                                                        <input type="hidden" name="Stid" value="<?php echo $row['jobCardStatusId'] ?>">
                                                    </form>
                                                </td>
                                            <td><?php echo $row['jobCardId']; ?></td>
                                            <td><?php echo $row['appointmentId']; ?></td>
                                            <td><?php echo $row['appointmentTypeId']; ?></td>
                                            <td><?php echo $row['workoutId']; ?></td>
                                            <td><?php echo $row['workoutName']; ?></td>
                                            
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['memberRegNo']; ?></td>
                                            <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                     
                                            <td><?php echo $row['appointmentDate']; ?></td>
                                            <td><?php echo $row['slotName']; ?></td>
                                            <td><?php echo $row['slotStartTime']; ?></td>
                                            <td><?php echo $row['slotEndTime']; ?></td>
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
    </section>
</div>

<?php
include '../footer.php';
?>

<script>
    $(function () {
        $('#jobCard_list').DataTable({
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









