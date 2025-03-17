<?php
include '../header.php';
include '../nav.php';
//include 'system/function.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report on reservations by Personal Workouts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php
                $db = dbConn();
                $sql1 = "SELECT * FROM tbl_personal_workouts";
                $result1 = $db->query($sql1);
                ?>
                <label for="s_Id" class="form-label">Workout Name : </label>
                <select  class="btn btn-sm bg-info" name="s_Id" id="s_Id">
                    <option value="">--</option>
                    <?php
                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['workoutId']; ?>" <?php if (@$s_Id == $row['workoutId']) { ?> selected <?php } ?>><?php echo $row['workoutName']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
               <input type="text" name="cus_Reg" placeholder="Enter Member RegNo">
                <input type="date" name="from" placeholder="Enter from date">
                <input type="date" name="to" placeholder="Enter to date">

                <button type="submit" class="bg-success">Search</button>
            </form>
            <?php
            extract($_POST);
            $db = dbConn();
            $where = null;
            //dynamically generate the query
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //check workout id
                if (!empty($s_Id)) {
                    $where .= "tbl_personal_workouts.workoutId='$s_Id' AND";
                }
                //check customer reg no
                if (!empty($cus_Reg)) {
                    $where .= " tbl_members.memberRegistrationNo='$cus_Reg' AND";
                }
                //check from to dates
                if (!empty($from) && !empty($to)) {
                    $where .= " tbl_appointments.appointmentDate BETWEEN  '$from' AND '$to' AND";
                }
                //generate dynamic query remove AND last characters from the string
                if (!empty($where)) {
                    $where = substr($where, 0, -3);
                    $where = " WHERE $where";
                }
            }

            $sql = "SELECT * FROM tbl_appointments INNER JOIN tbl_members ON tbl_appointments.memberId=tbl_members.memberId INNER JOIN tbl_personal_workouts ON tbl_appointments.workoutId=tbl_personal_workouts.workoutId $where";
            $result = $db->query($sql);
            ?>
            <div id="divData">
                <?php
                echo "<strong>Found " . $result->num_rows . " records</strong>";
                ?>
                <table border='1' width='100%' class="mt-3 table table-bordered" id="tbl_Data">
                    <thead>
                        <tr>
                            <th>Appointment Id</th>
                            <th>Workout Id</th>
                            <th>Customer Reg No</th>
                            <th>AppointmentDate</th>
                            <th>Slot ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php
                        echo $row['appointmentId'];
//                                        $total += $row['AppointmentId'];
                                ?></td>
                                    <td><?php echo $row['workoutId'] ?></td>
                                    <td><?php echo $row['memberRegistrationNo'] ?></td>
                                    <td><?php echo $row['appointmentDate'] ?></td>
                                    <td><?php echo $row['slotId'] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button onclick="exportTableToExcel('tbl_Data', 'appointments-data')">Export Table Data To Excel File</button>
            <button onclick="printTable('tbl_Data', 'Appointment Data');">Convert HTML to PDF</button>
        </div>
    </section>

</div>

<?php
include '../footer.php';
?>



