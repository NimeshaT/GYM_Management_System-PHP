<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Class Attendance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class Attendance</a></li>
                        <li class="breadcrumb-item active">Mark</li>
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
                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {

//                            ======================Start Validation=================
                            $message = array();

                            if (empty($memberId)) {
                                $message['memberId'] = "Member should not be empty..!";
                            }
                            if (empty($attendDate)) {
                                $message['attendDate'] = "Date should not be empty..!";
                            }
                            if (empty($classId)) {
                                $message['classId'] = "Class should not be empty..!";
                            }

//                            =======================Insert Records=======================
                            if (empty($message)) {
                                $db = dbConn();
                                echo $sql = "INSERT INTO tbl_class_attendance("
                                        . "memberId,attendDate,classId)VALUES("
                                        . "'$memberId','$attendDate','$classId')";
                                $db->query($sql);

                                //                                ===========successful meesage=============
                                ?>
                                <div class="card " style="background-color: #00008B">
                                    <div class="card-header text-center">
                                        <h3 class="text-center text-light">Insert successfully..!<i class="far fa-thumbs-up"></i></h3>
                                    </div>
                                </div>
                                <?php
                            }
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }



                        //                        =======================Update Records======================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {


                            $db = dbConn();
                            $sql = "UPDATE tbl_class_attendance SET "
                                    . "memberId='$memberId',"
                                    . "attendDate='$attendDate',"
                                    . "classId='$classId'"
                                    . "WHERE classAttendId='$classAttendId'";
                            $db->query($sql);

                            //                                ===========successful meesage=============
                            ?>
                            <div class="card " style="background-color: #00008B">
                                <div class="card-header text-center">
                                    <h3 class="text-center text-light">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                </div>
                            </div>
                            <?php
                            $submit = "update";
                        }


//                        =======================Edit Records===============
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {

                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_class_attendance WHERE classAttendId='$classAttendId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $memberId = $row['memberId'];
                            $attendDate = $row['attendDate'];
                            $classId = $row['classId'];
                            $classAttendId = $row['classAttendId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                            $memberId = "";
                            $attendDate = "";
                            $classId = "";
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Class Attendance Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT tbl_class_enrollment.memberId,tbl_members.firstName,tbl_members.lastName FROM tbl_class_enrollment INNER JOIN tbl_members ON tbl_class_enrollment.memberId=tbl_members.memberId";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="members">Select Member</label>
                                    <select class="form-control" name="memberId" id="memberId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['memberId']; ?>" <?php if (@$memberId == $row['memberId']) { ?> selected <?php } ?>><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="attendDate">Date</label>
                                    <input type="date" class="form-control" id="attendDate" name="attendDate"  value="<?php echo @$attendDate; ?>" min="<?= date('Y-m-d'); ?>">
                                    <div class="text-danger"><?php echo @$message['attendDate']; ?></div>
                                    <input type="hidden" name="classAttendId" value="<?php echo isset($classAttendId) ? $classAttendId : '' ?>">
                                </div>
                                
                                <div class="form-group">
                                    <?php
                                    $db = dbConn();
                                    $sql = "SELECT * from tbl_classes";
                                    $result = $db->query($sql);
                                    ?>
                                    <label for="class">Select Class</label>
                                    <select class="form-control" name="classId" id="classId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['classId']; ?>" <?php if (@$classId == $row['classId']) { ?> selected <?php } ?>><?php echo $row['className']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Attendance Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_class_attendance";
                            $result = $db->query($sql);
                            ?>
                            <table id="poya_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Member Id</th>
                                        <th>Class Id</th>
                                        <th>Attend Date</th>
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
                                                        <input type="hidden" name="classAttendId" value="<?php echo $row['classAttendId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary">Edit</button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['memberId']; ?></td>
                                                <td><?php echo $row['classId']; ?></td>
                                                <td><?php echo $row['attendDate']; ?></td>
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
        $('#role_list').DataTable({
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


