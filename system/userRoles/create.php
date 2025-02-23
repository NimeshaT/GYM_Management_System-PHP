<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User Roles</a></li>
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
                        if (empty($action)) {
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "create_account") {
                            $roleCode = dataClean($roleCode);
                            $roleName = dataClean($roleName);

//                            ======================Start Validation=================
                            $message = array();
                            if (empty($roleCode)) {
                                $message['roleCode'] = "Role code should not be empty..!";
                            }
                            if (empty($roleName)) {
                                $message['roleName'] = "Role name should not be empty..!";
                            }
                            if (!empty($roleCode)) {
                                $db = dbConn();
                                $sql = "SELECT * FROM tbl_user_roles WHERE roleCode='$roleCode'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    $message['roleCode'] = ' Role Code already exist';
                                }
                            }


                            //=======================Insert Records=======================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_user_roles("
                                        . "roleCode,roleName,statusId)VALUES("
                                        . "'$roleCode','$roleName','1')";
                                $db->query($sql);

                                //===========successful message=============
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

                        //=======================Update Records======================
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "update_account") {
                            $db = dbConn();
                            $sql = "UPDATE tbl_user_roles SET "
                                    . "roleName='$roleName'"
                                    . "WHERE roleCode='$roleCode'";
                            $db->query($sql);

                            //===========successful meesage=============
                            ?>
                            <div class="card " style="background-color: #00008B">
                                <div class="card-header text-center">
                                    <h3 class="text-center text-light">Update successfully..!<i class="far fa-thumbs-up"></i></h3>
                                </div>
                            </div>
                            <?php
                            $submit = "update";
                        }


                        //=======================Edit Records===============
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "edit_account") {

                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_user_roles WHERE roleCode='$roleCode'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $roleName = $row['roleName'];
                            $roleCode = $row['roleCode'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                            $roleName = "";
                            $roleCode = "";
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                         //change status
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
                            $db = dbConn();
                            $Stid = $Stid == '1' ? '2' : '1';
                            $sql = "UPDATE tbl_user_roles SET statusId='$Stid' WHERE roleCode='$Sid'";
                            $db->query($sql);
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> User Role Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="roleCode">User role code</label>
                                    <input type="text" class="form-control" id="roleCode" name="roleCode" placeholder="Enter RoleCode" value="<?php echo @$roleCode; ?>">
                                    <div class="text-danger"><?php echo @$message['roleCode']; ?></div>
                                </div>
                                <div class="form-group">
                                    <label for="roleName">User role name</label>
                                    <input type="text" class="form-control" id="roleName" name="roleName" placeholder="Enter RoleName" value="<?php echo @$roleName; ?>">
                                    <div class="text-danger"><?php echo @$message['roleName']; ?></div>
                                </div>

                            </div>
                            <div class="card-footer">
<!--                                <input type="hidden" name="RoleCode" value="<?php echo @$RoleCode; ?>">-->
                                <button type="submit" class="btn btn-primary" name="action" value="<?php echo @$action ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Users Role Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_user_roles INNER JOIN tbl_status ON tbl_user_roles.statusId=tbl_status.statusId";
                            $result = $db->query($sql);
                            ?>
                            <table id="role_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Change Status</th>
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
                                                <td><?php echo $row['roleName']; ?></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="change">Change</button>
                                                        <input type="hidden" name="Sid" value="<?php echo $row['roleCode'] ?>">
                                                        <input type="hidden" name="Stid" value="<?php echo $row['statusId'] ?>">
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['statusId'] == '1') {
                                                        ?>
                                                        <button type="button" class="btn btn-success btn-sm"><?php echo $row['statusName'] ?></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="button" class="btn btn-danger btn-sm"><?php echo $row['statusName'] ?></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="roleCode" value="<?php echo $row['roleCode']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary">Edit</button>
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


