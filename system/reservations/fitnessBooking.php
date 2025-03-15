<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reservations - Fitness</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Reservations</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Fitness Booking Details</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        extract($_POST);
                        ?>

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="A_Id" placeholder="Enter Booking Id" value="<?php echo @$A_Id ?>">
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
                                $where .= "tbl_bookings.bookingId='$A_Id' AND";
                            }
                            //check member reg no
                            if (!empty($M_Reg)) {
                                $where .= " tbl_members.memberRegistrationNo='$M_Reg' AND";
                            }
                            //check from to dates
                            if (!empty($from) && !empty($to)) {
                                $where .= " bookingDate BETWEEN  '$from' AND '$to' AND";
                            }
                            //generate dynamic query remove AND last characters from the string
                            if (!empty($where)) {
                                $where = substr($where, 0, -3);
                                $where = " AND $where";
                            }
                        }
                        $sql="SELECT * FROM tbl_bookings INNER JOIN tbl_fitness ON tbl_bookings.fitnessId=tbl_fitness.fitnessId INNER JOIN tbl_appointment_type ON tbl_bookings.appointmentTypeId=tbl_appointment_type.appointmentTypeId INNER JOIN tbl_members ON tbl_bookings.memberId=tbl_members.memberId INNER JOIN tbl_time_slots ON tbl_bookings.slotId=tbl_time_slots.slotId WHERE tbl_bookings.appointmentTypeId='2' $where ORDER BY bookingId DESC";
                        $result = $db->query($sql);
                        ?>
                        <table id="appointment_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Booking Id</th>
                                    <th>Appointment Type Id</th>
                                    <th>Booking Type Name</th>
                                    <th>Fitness Id</th>
                                    <th>Fitness Name</th>
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
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $AppNo = $row['bookingId'];
                                                $sql1 = "SELECT * FROM tbl_fitness_job_card WHERE bookingId='$AppNo'";
                                                $res = $db->query($sql1);
                                                if ($res->num_rows == 0) {
//                                                    echo $jobCardId=$row['jobCardId'];
                                                    ?>
                                                    <form action="createFitnessJobCard.php" method="post">
                                                        <input type="hidden" name="bookingId" value="<?php echo $row['bookingId']; ?>">
                                                        <input type="hidden" name="appointmentTypeId" value="<?php echo $row['appointmentTypeId']; ?>">
                                                        <input type="hidden" name="fitnessId" value="<?php echo $row['fitnessId']; ?>">
                                                        <input type="hidden" name="bookingDate" value="<?php echo $row['bookingDate']; ?>">
                                                        <input type="hidden" name="slotId" value="<?php echo $row['slotId']; ?>">
                                                        <input type="hidden" name="memberId" value="<?php echo $row['memberId']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">Create Job Card</button>
                                                    </form>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <form action="viewFitnessJobCard.php" method="post">
                                                        <input type="hidden" name="bookingId" value="<?php echo $row['bookingId']; ?>">
                                                        
                                                        <button type="submit" class="btn btn-success btn-sm">View Job Card</button>
                                                    </form>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row['bookingId']; ?></td>
                                            <td><?php echo $row['appointmentTypeId']; ?></td>
                                            <td><?php echo $row['appointmentName']; ?></td>
                                            <td><?php echo $row['fitnessId']; ?></td>
                                            <td><?php echo $row['fitnessName']; ?></td>
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['memberRegistrationNo']; ?></td>
                                            <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                            <td><?php echo $row['bookingDate']; ?></td>
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
        $('#appointment_list').DataTable({
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









