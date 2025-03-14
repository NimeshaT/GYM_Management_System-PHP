<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="card-title">Completed Workout Schedules</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        extract($_POST);
                        ?>

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="A_Id" placeholder="Enter Appointment Id" value="<?php echo @$A_Id ?>">
                            <input type="text" name="M_Reg" placeholder="Enter Member RegNo" value="<?php echo @$M_Reg ?>">
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


                        
//                        $sql1 = "SELECT
//            ws.*, 
//            jc.*,
//            jc.statusId AS jobcard_statusId,
//            s.statusName,
//            pw.*, 
//            a.*, 
//            ts.*, 
//            f.* 
//         FROM tbl_workout_schedules AS ws
//         LEFT JOIN tbl_workout_schedule_services AS wss ON ws.workoutScheduleId = wss.workoutScheduleId
//         LEFT JOIN tbl_job_card AS jc ON ws.jobCardId = jc.jobCardId
//         LEFT JOIN tbl_status AS s ON jc.statusId = s.statusId
//         LEFT JOIN tbl_personal_workouts AS pw ON ws.workoutId = pw.workoutId
//         LEFT JOIN tbl_appointments AS a ON ws.appointmentId = a.appointmentId
//         LEFT JOIN tbl_time_slots AS ts ON ws.slotId = ts.slotId
//         LEFT JOIN tbl_fitness AS f ON wss.fitnessId = f.fitnessId
//         WHERE jc.statusId IN ('7','8','9','10')
//         $where";
                        
                        $sql1="SELECT * FROM tbl_job_card INNER JOIN tbl_status ON tbl_job_card.statusId=tbl_status.statusId
                            WHERE tbl_job_card.statusId IN ('8', '9', '10')";

   
                        $result = $db->query($sql1);
                        ?>
                        <table id="jobCard_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Job Card Status</th>
                                    <th>Job Card Id</th>
                                    <th>Instructor Id</th>
                                    <th>Appointment Type Id</th>
                                    <th>Appointment Id</th>
                                    <th>Workout Id</th>
<!--                                    <th>Workout Name</th>
                                    <th>Schedule ID</th>
                                    <th>Member ID</th>
                                    <th>Slot ID</th>
                                    <th>Slot Name</th>-->
<!--                                    <th>Workout Schedule Services</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        //echo $appNo=$row['appointmentId'];
                                        //echo $sid=$row['service_statusId'];
                                        //echo $row['workoutScheduleId'];
                                        ?>
                                        <tr>
                                            <td>
                                                <form action="createInvoice2.php" method="post">
                                                    <input type="hidden" name="jobCardId" value="<?php echo $row['jobCardId']; ?>">
                                                    <input type="hidden" name="memberId" value="<?php echo $row['memberId']; ?>">
                                                    <input type="hidden" name="appointmentId" value="<?php echo $row['appointmentId']; ?>">
                                                    <input type="hidden" name="workoutId" value="<?php echo $row['workoutId']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Create Invoice</button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['statusId'] == '8') {
                                                    ?>
                                                    <button type="button" class="btn btn-warning btn-sm"><?php echo $row['statusName'] ?></button>
                                                    <?php
                                                } elseif ($row['statusId'] == '9') {
                                                    ?>
                                                    <button type="button" class="btn btn-primary btn-sm"><?php echo $row['statusName'] ?></button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName'] ?></button>
                                                    <?php
                                                }
                                                ?>

                                            </td>

                                            <td><?php echo $row['jobCardId']; ?></td>
                                            <td><?php echo $row['instructorId']; ?></td>
                                            <td><?php echo $row['appointmentTypeId']; ?></td>
                                            <td><?php echo $row['appointmentId']; ?></td>
                                            <td><?php echo $row['workoutId']; ?></td>
<!--                                            <td><?php echo $row['workoutName']; ?></td>
                                            <td><?php echo $row['workoutScheduleId']; ?></td>
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['slotId']; ?></td>
                                            <td><?php echo $row['slotName']; ?></td>-->
        <!--                                            <td><?php echo $row['fitnessId']; ?></td>
                                            <td><?php echo $row['fitnessName']; ?></td>
                                            <td><?php echo $row['appointmentDate']; ?></td>-->
<!--                                            <td>
                                                <table class="table table-info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Schedule Service ID</th>
                                                            <th scope="col">Fitness ID</th>
                                                            <th scope="col">Workout Schedule Date</th>
                                                            <th scope="col">Service Status ID</th>
                                                            <th scope="col">Service Status Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $workoutScheduleId = $row['workoutScheduleId'];
                                                        $sql2 = "SELECT * FROM tbl_workout_schedule_services LEFT JOIN tbl_status ON tbl_workout_schedule_services.statusId = tbl_status.statusId WHERE workoutScheduleId = '$workoutScheduleId'";
                                                        $result2 = $db->query($sql2);
                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row2['workoutScheduleServiceId']; ?></td>
                                                            <td><?php echo $row2['fitnessId']; ?></td>
                                                            <td><?php echo $row2['workoutScheduleDate']; ?></td>
                                                            <td><?php echo $row2['statusId']; ?></td>
                                                            <td><?php echo $row2['statusName']; ?></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </td>-->
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









