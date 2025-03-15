<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fitness</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Fitness</a></li>
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
                            if (empty($workoutId)) {
                                $message['workoutId'] = "Workout Name should not be empty..!";
                            }
                            if (empty($fitnessName)) {
                                $message['fitnessName'] = "Fitness Name should not be empty..!";
                            }
                            if (empty($fitnessDesc)) {
                                $message['fitnessDesc'] = "Fitness Description should not be empty..!";
                            }
                             if (empty($fitnessCharge)) {
                                $message['fitnessCharge'] = "Fitness Charge should not be empty..!";
                            }

                            //validation end
                            
                            //profile image uploading
                            if(empty($message)){
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["fitnessImage"]["name"]);
                                $uploadOk = 1;
                                //path info extension->get extension of file type
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                //check whether it is an image or not
                                $check = getimagesize($_FILES["fitnessImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['fitnessImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                
                                // Check if file already exists->only check the content not image content
                                if (file_exists($target_file)) {
                                    $message['fitnessImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                
                                // Check file size(KB)
                                if ($_FILES["fitnessImage"]["size"] > 5000000) {
                                    $message['fitnessImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
                                
                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['fitnessImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["fitnessImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["fitnessImage"]["name"]));
                                    } else {
                                        $message['fitnessImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
                            
                            //Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_fitness("
                                        . "workoutId,"
                                        . "fitnessName,"
                                        . "fitnessDesc,"
                                        . "fitnessCharge,fitnessImage,statusId)VALUES("
                                        . "'$workoutId',"
                                        . "'$fitnessName',"
                                        . "'$fitnessDesc',"
                                        . "'$fitnessCharge',$Photo','1')";

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
                            
                            if (empty($message) AND!empty($_FILES["fitnessImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["fitnessImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["fitnessImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['fitnessImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['fitnessImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                // Check file size
                                if ($_FILES["fitnessImage"]["size"] > 5000000) {
                                    $message['fitnessImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['fitnessImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["fitnessImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["fitnessImage"]["name"]));
                                    } else {
                                        $message['fitnessImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousProfilePhoto;
                            }

                            $db = dbConn();
                            $sql = "UPDATE tbl_fitness SET "
                                    . "workoutId='$workoutId',"
                                    . "fitnessName='$fitnessName',"
                                    . "fitnessDesc='$fitnessDesc',"
                                    . "fitnessCharge='$fitnessCharge',"
                                    . "fitnessImage='$Photo',"
                                    . "statusId='1' "
                                    . "WHERE fitnessId='$fitnessId'";
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
                            $sql = "SELECT * FROM tbl_fitness WHERE fitnessId='$fitnessId'";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();

                            $workoutId = $row['workoutId'];
                            $fitnessName = $row['fitnessName'];
                            $fitnessDesc = $row['fitnessDesc'];
                            $fitnessCharge = $row['fitnessCharge'];
                            $fitnessImage = $row['fitnessImage'];
                            $statusId = $row['statusId'];
                            $fitnessIdId = $row['fitnessId'];

                            $action = 'update_account';
                            $form_title = 'Update';
                            $submit = 'Update';
                            $btn = 'success';
                        }

                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Fitness Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <?php
                                    $db= dbConn();
                                    $sql="SELECT * FROM tbl_personal_workouts";
                                    $result=$db->query($sql);
                                    ?>
                                    <label for="workout">Select Workout Type</label>
                                    <select class="form-control" name="workoutId" id="workoutId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if($result->num_rows>0){
                                            while ($row=$result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['workoutId']; ?>" <?php if (@$workoutId == $row['workoutId']) { ?> selected <?php } ?>><?php echo $row['workoutName']; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="text-danger"><?php echo @$message['workoutId']; ?></div>
                                
                                <div class="form-group">
                                    <label for="fitnessName">Fitness Name</label>
                                    <input type="text" class="form-control" id="fitnessName" name="fitnessName" placeholder="Enter fitness Name" value="<?php echo @$fitnessName ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['fitnessName']; ?></div>

                                <div class="form-group">
                                    <label for="fitnessDesc">Fitness Description</label>
                                    <textarea class="form-control" id="fitnessDesc" name="fitnessDesc" placeholder="Enter Fitness Description"><?php echo @$fitnessDesc ?></textarea>
                                </div>
                                <div class="text-danger"><?php echo @$message['fitnessDesc']; ?></div>
                                
                                <div class="form-group">
                                    <label for="fitnessCharge">Fitness Charge</label>
                                    <input type="text" class="form-control" id="fitnessCharge" name="fitnessCharge" placeholder="Enter fitness Charge" value="<?php echo @$fitnessCharge ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['fitnessCharge']; ?></div>

                                <div class="mb-3">
                                    <label for="fitnessImage">Fitness Image</label>
                                    <input type="file" class="form-control" id="fitnessImage" name="fitnessImage">
                                    <input type="hidden" name="PreviousProfilePhoto" value="<?php echo @$fitnessImage; ?>">
<!--                                    <div class="text-danger"><?php echo @$message['fitnessImage']; ?></div>-->
                                </div>
                                
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="fitnessId" value="<?php echo @$fitnessId ?>">
                                <button type="submit" class="btn btn-<?php echo @$btn; ?>" name="action" value="<?php echo @$action; ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Table of Fitness Details</h3>
                        </div>
                        <div class="card-body">
<!--                            -----------------Search BAR----------------------->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="fitnessName" id="fitnessName" class="form-control" placeholder="Enter fitness Name">
                                <button type="submit" class="btn btn-success mt-2 mb-2" name="action" value="search_account">Search</button>
                            </form>

                            <?php
//                            ----------------Search Account-search bar------------------
                            $db = dbConn();
                            $where=null;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search_account') {
                                if(!empty($fitnessName)){
                                    $where.="WHERE fitnessName='$fitnessName'";
                                }
                            }
                            
                            //change status
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
                            //$db = dbConn();
                            $Stid = $Stid == '1' ? '2' : '1';
                            $sql = "UPDATE tbl_fitness SET statusId='$Stid' WHERE fitnessId='$Sfid'";
                            $db->query($sql);
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_fitness INNER JOIN tbl_status ON tbl_fitness.statusId=tbl_status.statusId $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="fitness_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Fitness Name</th>
                                        <th>Fitness Image</th>
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

                                                <td><?php echo $row['fitnessName']; ?></td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['fitnessImage']; ?>"></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="change">Change</button>
                                                        <input type="hidden" name="Sfid" value="<?php echo $row['fitnessId'] ?>">
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
                                                        <input type="hidden" name="fitnessId" value="<?php echo $row['fitnessId']; ?>">
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
        $('#fitness_list').DataTable({
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


