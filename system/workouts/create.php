<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Workout</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Workout</a></li>
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
                            if (empty($workoutName)) {
                                $message['workoutName'] = "Workout Name should not be empty..!";
                            }
                            if (empty($workoutDescription)) {
                                $message['workoutDescription'] = "Workout Description should not be empty..!";
                            }
                            
//                            if (empty($workoutImage)) {
//                                $message['workoutImage'] = "Workout Image should not be empty..!";
//                            }
                            //validation end
                            
                            //profile image uploading
                            if(empty($message)){
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["workoutImage"]["name"]);
                                $uploadOk = 1;
                                //path info extension->get extension of file type
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                //check whether it is an image or not
                                $check = getimagesize($_FILES["workoutImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['workoutImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                
                                // Check if file already exists->only check the content not image content
                                if (file_exists($target_file)) {
                                    $message['workoutImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                
                                // Check file size(KB)
                                if ($_FILES["workoutImage"]["size"] > 5000000) {
                                    $message['workoutImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
                                
                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['workoutImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["workoutImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["workoutImage"]["name"]));
                                    } else {
                                        $message['workoutImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
                            
                            //Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_personal_workouts("
                                        . "workoutName,"
                                        . "workoutDescription,"
                                        . "workoutImage,statusId)VALUES("
                                        . "'$workoutName',"
                                        . "'$workoutDescription',"
                                        . "'$Photo','1')";

                                $db->query($sql);
                                
                                ?>
                        <div class="card " style="background-color: #00008B">
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
                            
                            if (empty($message) AND!empty($_FILES["workoutImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["workoutImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["workoutImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['workoutImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['workoutImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                // Check file size
                                if ($_FILES["workoutImage"]["size"] > 5000000) {
                                    $message['workoutImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['workoutImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["workoutImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["workoutImage"]["name"]));
                                    } else {
                                        $message['workoutImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousProfilePhoto;
                            }

                            $db = dbConn();
                            $sql = "UPDATE tbl_personal_workouts SET "
                                    . "workoutName='$workoutName',"
                                    . "workoutDescription='$workoutDescription',"
                                    . "workoutImage='$Photo',"
                                    . "statusId='1' "
                                    . "WHERE workoutId='$workoutId'";
                            $db->query($sql);
                            ?>
                        <div class="card " style="background-color: #00008B">
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
                            $sql = "SELECT * FROM tbl_personal_workouts WHERE workoutId='$workoutId'";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();

                            $workoutName = $row['workoutName'];
                            $workoutDescription = $row['workoutDescription'];
                            $workoutImage = $row['workoutImage'];
                            $statusId = $row['statusId'];
                            $workoutId = $row['workoutId'];

                            $action = 'update_account';
                            $form_title = 'Update';
                            $submit = 'Update';
                            $btn = 'success';
                        }

                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Workout Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="workoutName">Workout Name</label>
                                    <input type="text" class="form-control" id="workoutName" name="workoutName" placeholder="Enter Workout Name" value="<?php echo @$workoutName ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['workoutName']; ?></div>

                                <div class="form-group">
                                    <label for="workoutDescription">Workout Description</label>
                                    <textarea class="form-control" id="workoutDescription" name="workoutDescription" placeholder="Enter Workout Description"><?php echo @$workoutDescription ?></textarea>
                                </div>
                                <div class="text-danger"><?php echo @$message['workoutDescription']; ?></div>

                                <div class="mb-3">
                                    <label for="workoutImage">Workout Image</label>
                                    <input type="file" class="form-control" id="workoutImage" name="workoutImage">
                                    <input type="hidden" name="PreviousProfilePhoto" value="<?php echo @$workoutImage; ?>">
<!--                                    <div class="text-danger"><?php echo @$message['workoutImage']; ?></div>-->
                                </div>
                                
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="workoutId" value="<?php echo @$workoutId ?>">
                                <button type="submit" class="btn btn-<?php echo @$btn; ?>" name="action" value="<?php echo @$action; ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Table of Workouts Details</h3>
                        </div>
                        <div class="card-body">
<!--                            -----------------Search BAR----------------------->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="workoutName" id="workoutName" class="form-control" placeholder="Enter Workout Name">
                                <button type="submit" class="btn btn-success mt-2 mb-2" name="action" value="search_account">Search</button>
                            </form>

                            <?php
//                            ----------------Search Account-search bar------------------
                            $where=null;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search_account') {
                                if(!empty($workoutName)){
                                    $where.="WHERE workoutName='$workoutName'";
                                }
                            }
                            
                            //change status
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
                            $db = dbConn();
                            $Stid = $Stid == '1' ? '2' : '1';
                            $sql = "UPDATE tbl_personal_workouts SET statusId='$Stid' WHERE workoutId='$Swid'";
                            $db->query($sql);
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_personal_workouts INNER JOIN tbl_status ON tbl_personal_workouts.statusId=tbl_status.statusId $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="workout_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Workout Name</th>
                                        <th>Workout Image</th>
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

                                                <td><?php echo $row['workoutName']; ?></td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['workoutImage']; ?>"></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="change">Change</button>
                                                        <input type="hidden" name="Swid" value="<?php echo $row['workoutId'] ?>">
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
                                                        <input type="hidden" name="workoutId" value="<?php echo $row['workoutId']; ?>">
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
        $('#workout_list').DataTable({
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


