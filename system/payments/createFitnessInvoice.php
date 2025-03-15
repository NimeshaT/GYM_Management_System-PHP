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
                        <h3 class="card-title">Completed Fitness Job Cards</h3>
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
                        
                        $sql1="SELECT * FROM tbl_fitness_job_card INNER JOIN tbl_status ON tbl_fitness_job_card.statusId=tbl_status.statusId INNER JOIN tbl_fitness ON tbl_fitness_job_card.fitnessId=tbl_fitness.fitnessId INNER JOIN tbl_time_slots ON tbl_fitness_job_card.slotId=tbl_time_slots.slotId
                            WHERE tbl_fitness_job_card.statusId='10'";

   
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
                                    <th>Booking Id</th>
                                    <th>Fitness Id</th>
                                    <th>Fitness Name</th>
                                    <th>Member ID</th>
                                    <th>Slot ID</th>
                                    <th>Slot Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <form action="createFitnessInvoice2.php" method="post">
                                                    <input type="hidden" name="fitnessJobCardId" value="<?php echo $row['fitnessJobCardId']; ?>">
                                                    <input type="hidden" name="memberId" value="<?php echo $row['memberId']; ?>">
                                                    <input type="hidden" name="bookingId" value="<?php echo $row['bookingId']; ?>">
                                                    <input type="hidden" name="fitnessId" value="<?php echo $row['fitnessId']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Create Invoice</button>
                                                </form>
                                            </td>
                                            <td>
                                                    <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName'] ?></button>
                                            </td>

                                            <td><?php echo $row['fitnessJobCardId']; ?></td>
                                            <td><?php echo $row['instructorId']; ?></td>
                                            <td><?php echo $row['appointmentTypeId']; ?></td>
                                            <td><?php echo $row['bookingId']; ?></td>
                                            <td><?php echo $row['fitnessId']; ?></td>
                                            <td><?php echo $row['fitnessName']; ?></td>
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['slotId']; ?></td>
                                            <td><?php echo $row['slotName']; ?></td>
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









