<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Enrollments - Class</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Enrollments</a></li>
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
                        <h3 class="card-title">Class Enrollments Details</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        extract($_POST);
                        ?>
                        <?php
                        //change status-appointment
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "change") {
                            $Stid = $_POST['Stid'];
                            $classEnrollmentId = $_POST['classEnrollmentId'];

                            $db = dbConn();
                            $Stid = $Stid == '4' ? '5' : '4';
                            $sql = "UPDATE tbl_class_enrollment SET statusId='$Stid' WHERE classEnrollmentId='$classEnrollmentId'";
                            $db->query($sql);
                        }
                        ?>

                        <!--                            ================search==================-->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <input type="text" name="enrollmentId" placeholder="Enter Enrollment Id" value="<?php echo @$enrollmentId ?>">
                            <input type="text" name="enrollmentNo" placeholder="Enter Enrollment No" value="<?php echo @$enrollmentNo?>">
                            <input type="date" name="from" placeholder="Enter from date" value="<?php echo @$from ?>">
                            <input type="date" name="to" placeholder="Enter to date" value="<?php echo @$to ?>">
                            <button type="submit" class="bg-success btn">Search</button>
                        </form>

                        <?php
                        $db = dbConn();
                        $where = null;
                        //dynamically generate the query
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            //check enrollment id
                            if (!empty($enrollmentId)) {
                                $where .= "tbl_class_enrollment.classEnrollmentId='$enrollmentId' AND";
                            }
                            //check enrollment  no
                            if (!empty($enrollmentNo)) {
                                $where .= " tbl_class_enrollment.enrollmentNo='$enrollmentNo' AND";
                            }
                            //check from to dates
                            if (!empty($from) && !empty($to)) {
                                $where .= " enrollmentDay BETWEEN  '$from' AND '$to' AND";
                            }
                            //generate dynamic query remove AND last characters from the string
                            if (!empty($where)) {
                                $where = substr($where, 0, -3);
                                $where = " AND $where";
                            }
                        }
                        $sql = "SELECT 
    tbl_class_enrollment.classEnrollmentId, 
    tbl_class_enrollment.enrollmentNo, 
    tbl_class_enrollment.classId, 
    tbl_class_enrollment.instructorId, 
    tbl_class_enrollment.statusId, 
    tbl_class_enrollment.enrollmentDay, 
    tbl_class_enrollment.memberId, 
    tbl_status.statusName, 
    tbl_classes.className, 
    tbl_classes.classDay, 
    tbl_instructors.firstName, 
    tbl_instructors.lastName 
FROM tbl_class_enrollment 
INNER JOIN tbl_status ON tbl_class_enrollment.statusId = tbl_status.statusId 
INNER JOIN tbl_classes ON tbl_class_enrollment.classId = tbl_classes.classId 
INNER JOIN tbl_instructors ON tbl_class_enrollment.instructorId = tbl_instructors.instructorId $where";
                        $result = $db->query($sql);
                        ?>
                        <table id="appointment_list" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Enrollment Id</th>
                                    <th>Enrollment No</th>
                                    <th>Enrollment Date</th>
                                    <th>member Id</th>
                                    <th>Class Id</th>
                                    <th>Class Name</th>
                                    <th>Instructor Id</th>
                                    <th>Instructor Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                    <input type="hidden" name="classEnrollmentId" value="<?php echo $row['classEnrollmentId'] ?>">
                                                    <input type="hidden" name="Stid" value="<?php echo $row['statusId'] ?>">
                                                    <button type="submit" class="btn btn-success btn-sm" name="action" value="change">Change</button>
                                                </form>
                                            </td>
                                            <td><?php echo $row['statusName']; ?></td>
                                            <td><?php echo $row['classEnrollmentId']; ?></td>
                                            <td><?php echo $row['enrollmentNo']; ?></td>
                                            <td><?php echo $row['enrollmentDay']; ?></td>
                                            <td><?php echo $row['memberId']; ?></td>
                                            <td><?php echo $row['classId']; ?></td>
                                            <td><?php echo $row['className']; ?></td>
                                            <td><?php echo $row['instructorId']; ?></td>
                                            <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>

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









