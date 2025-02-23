<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Poya Days</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Poya Days</a></li>
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

//                            ======================Start Validation=================
                            $message = array();

                            if (empty($poyaDay)) {
                                $message['poyaDay'] = "Poya day should not be empty..!";
                            }

//                            =======================Insert Records=======================
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_poya_days("
                                        . "poyaDay)VALUES("
                                        . "'$poyaDay')";
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
                            $sql = "UPDATE tbl_poya_days SET "
                            . "poyaDay='$poyaDay'"
                            . "WHERE poyaDayId='$poyaDayId'";
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
                            echo $sql = "SELECT * FROM tbl_poya_days WHERE poyaDayId='$poyaDayId'";
                            $result = $db->query($sql);

                            //show one record
                            $row = $result->fetch_assoc();

                            $poyaDay = $row['poyaDay'];
                            $poyaDayId = $row['poyaDayId'];

                            //change action after edit
                            $action = "update_account";
                            $form_title = "Update";
                            $submit = "Update";
                        }
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "cancel") {
                             $poyaDay = "";
                             //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Poyadays Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="poyaDay">Poya Day</label>
                                    <input type="date" class="form-control" id="poyaDay" name="poyaDay"  value="<?php echo @$poyaDay; ?>">
                                    <div class="text-danger"><?php echo @$message['poyaDay']; ?></div>
                                    <input type="hidden" name="poyaDayId" value="<?php echo isset($poyaDayId) ? $poyaDayId : '' ?>">
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
                            <h3 class="card-title">Poya Days Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_poya_days";
                            $result = $db->query($sql);
                            ?>
                            <table id="poya_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Poya Day</th>
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
                                                        <input type="hidden" name="poyaDayId" value="<?php echo $row['poyaDayId']; ?>">
                                                        <button type="submit" name="action" value="edit_account" class="btn btn-primary">Edit</button>
                                                    </form>
                                                </td>
                                                <td><?php echo $row['poyaDay']; ?></td>
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


