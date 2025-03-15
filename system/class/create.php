<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Class</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
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
                            if (empty($instructorId)) {
                                $message['instructorId'] = "Instructor Name should not be empty..!";
                            }
                            if (empty($className)) {
                                $message['className'] = "Class Name should not be empty..!";
                            }
                            if (empty($classFees)) {
                                $message['classFees'] = "Class Fees should not be empty..!";
                            }
                            if (empty($classDesc)) {
                                $message['classDesc'] = "Class Description should not be empty..!";
                            }
                            if (empty($classDay)) {
                                $message['classDay'] = "Class Day should not be empty..!";
                            }
                            if (empty($classStartTime)) {
                                $message['classStartTime'] = "Class Start Time should not be empty..!";
                            }
                            if (empty($classEndTime)) {
                                $message['classEndTime'] = "Class End Time should not be empty..!";
                            }
                            

                            //validation end
                            
                            //profile image uploading
                            if(empty($message)){
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["classImage"]["name"]);
                                $uploadOk = 1;
                                //path info extension->get extension of file type
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                //check whether it is an image or not
                                $check = getimagesize($_FILES["classImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['classImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                
                                // Check if file already exists->only check the content not image content
                                if (file_exists($target_file)) {
                                    $message['classImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                
                                // Check file size(KB)
                                if ($_FILES["classImage"]["size"] > 5000000) {
                                    $message['classImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
                                
                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['classImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["classImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["classImage"]["name"]));
                                    } else {
                                        $message['classImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
                            
                            //Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                echo $sql = "INSERT INTO tbl_classes("
                                        . "instructorId,"
                                        . "className,"
                                        . "classFees,"
                                        . "classDesc,"
                                        . "classDay,"
                                        . "classStartTime,"
                                        . "classEndTime,"
                                        . "classDuration,"
                                        . "classImage,statusId)VALUES("
                                        . "'$instructorId',"
                                        . "'$className',"
                                        . "'$classFees',"
                                        . "'$classDesc',"
                                        . "'$classDay',"
                                        . "'$classStartTime',"
                                        . "'$classEndTime',"
                                        . "'$classDuration',"
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
                            
                            if (empty($message) AND!empty($_FILES["classImage"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["classImage"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["classImage"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['classImage'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['classImage'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                // Check file size
                                if ($_FILES["classImage"]["size"] > 5000000) {
                                    $message['classImage'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['classImage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["classImage"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["classImage"]["name"]));
                                    } else {
                                        $message['classImage'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousProfilePhoto;
                            }

                            $db = dbConn();
                            echo $sql = "UPDATE tbl_classes SET "
                                    . "instructorId='$instructorId',"
                                    . "className='$className',"
                                    . "classFees='$classFees',"
                                    . "classDesc='$classDesc',"
                                    . "classDay='$classDay',"
                                    . "classStartTime='$classStartTime',"
                                    . "classEndTime='$classEndTime',"
                                    . "classDuration='$classDuration',"
                                    . "classImage='$Photo',"
                                    . "statusId='1' "
                                    . "WHERE classId='$classId'";
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
                            $sql = "SELECT * FROM tbl_classes WHERE classId='$classId'";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();

                            $instructorId = $row['instructorId'];
                            $className = $row['className'];
                            $classFees = $row['classFees'];
                            $classDesc = $row['classDesc'];
                            $classDay = $row['classDay'];
                            $classStartTime = $row['classStartTime'];
                            $classEndTime = $row['classEndTime'];
                            $classDuration = $row['classDuration'];
                            $classImage = $row['classImage'];
                            $statusId = $row['statusId'];
                            $classId = $row['classId'];

                            $action = 'update_account';
                            $form_title = 'Update';
                            $submit = 'Update';
                            $btn = 'success';
                        }
                        
                        //Cancel Records
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'cancel') {

                            $instructorId = "";
                            $className = "";
                            $classFees = "";
                            $classDesc = "";
                            $classDay = "";
                            $classStartTime = "";
                            $classEndTime = "";
                            $classDuration = "";
                            $classImage = "";
                            $statusId = "";

                        }

                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> Class Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <?php
                                    $db= dbConn();
                                    $sql="SELECT * FROM tbl_instructors";
                                    $result=$db->query($sql);
                                    ?>
                                    <label for="instructors">Select Instructor</label>
                                    <select class="form-control" name="instructorId" id="instructorId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if($result->num_rows>0){
                                            while ($row=$result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['instructorId']; ?>" <?php if (@$instructorId == $row['instructorId']) { ?> selected <?php } ?>><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="text-danger"><?php echo @$message['instructorId']; ?></div>
                                
                                <div class="form-group">
                                    <label for="className">Class Name</label>
                                    <input type="text" class="form-control" id="className" name="className" placeholder="Enter class Name" value="<?php echo @$className ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['className']; ?></div>
                                
                                <div class="form-group">
                                    <label for="classFees">Monthly Class Fees</label>
                                    <input type="text" class="form-control" id="classFees" name="classFees" placeholder="Enter classFees" value="<?php echo @$classFees ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['classFees']; ?></div>

                                <div class="form-group">
                                    <label for="classDesc">Class Description</label>
                                    <textarea class="form-control" id="classDesc" name="classDesc" placeholder="Enter Class Description"><?php echo @$classDesc ?></textarea>
                                </div>
                                <div class="text-danger"><?php echo @$message['classDesc']; ?></div>
                                
                                <div class="form-group">
                                    <label for="classDay">Class Day</label>
                                    <input type="text" class="form-control" id="classDay" name="classDay" placeholder="Enter class Day" value="<?php echo @$classDay ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['classDay']; ?></div>
                                
                                <div class="form-group">
                                    <label for="classStartTime">Class Start Time</label>
                                    <input type="time" class="form-control" id="classStartTime" name="classStartTime" value="<?php echo @$classStartTime?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['classStartTime']; ?></div>
                                
                                <div class="form-group">
                                    <label for="classEndTime">Class End Time</label>
                                    <input type="time" class="form-control" id="classEndTime" name="classEndTime" value="<?php echo @$classEndTime?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['classEndTime']; ?></div>
                                <?php
                                //$classDuration=$classStartTime->diff($classEndTime);
                                //echo '$classDuration';
                                ?>
                                <div class="form-group">
                                    <label for="classDuration">Class Duration</label>
                                    <input type="text" class="form-control" id="classDuration" name="classDuration" value="<?php echo @$classDuration?>">
                                </div>
<!--                                <div class="text-danger"><?php echo @$message['classEndTime']; ?></div>-->

                                <div class="mb-3">
                                    <label for="classImage">Class Image</label>
                                    <input type="file" class="form-control" id="classImage" name="classImage">
                                    <input type="hidden" name="PreviousProfilePhoto" value="<?php echo @$classImage; ?>">
<!--                                    <div class="text-danger"><?php echo @$message['classImage']; ?></div>-->
                                </div>
                                
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="classId" value="<?php echo @$classId ?>">
                                <button type="submit" class="btn btn-<?php echo @$btn; ?>" name="action" value="<?php echo @$action; ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Table of Class Details</h3>
                        </div>
                        <div class="card-body">
<!--                            -----------------Search BAR----------------------->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="className" id="className" class="form-control" placeholder="Enter Class Name">
                                <button type="submit" class="btn btn-success mt-2 mb-2" name="action" value="search_account">Search</button>
                            </form>

                            <?php
//                            ----------------Search Account-search bar------------------
                            $where=null;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search_account') {
                                if(!empty($className)){
                                    $where.="WHERE className='$className'";
                                }
                            }
                            
                            //change status
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "change") {
                            $db = dbConn();
                            $Stid = $Stid == '1' ? '2' : '1';
                            $sql = "UPDATE tbl_classes SET statusId='$Stid' WHERE classId='$Scid'";
                            $db->query($sql);
                            //after submit
                            $action = "create_account";
                            $form_title = "Create";
                            $submit = "Create";
                        }
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_classes INNER JOIN tbl_instructors ON tbl_classes.instructorId=tbl_instructors.instructorId INNER JOIN tbl_status ON tbl_classes.statusId=tbl_status.statusId  $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="class_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Class Image</th>
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

                                                <td><?php echo $row['className']; ?></td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['classImage']; ?>"></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="change">Change</button>
                                                        <input type="hidden" name="Scid" value="<?php echo $row['classId'] ?>">
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
                                                        <input type="hidden" name="classId" value="<?php echo $row['classId']; ?>">
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
        $('#class_list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    
//Calculate Duration
document.getElementById("classStartTime").addEventListener("input", calculateDuration);
document.getElementById("classEndTime").addEventListener("input", calculateDuration);

function calculateDuration() {
    let startTime = document.getElementById("classStartTime").value;
    let endTime = document.getElementById("classEndTime").value;

    if (startTime && endTime) {
        // Convert HH:MM format to minutes
        let [startHour, startMinute] = startTime.split(":").map(Number);
        let [endHour, endMinute] = endTime.split(":").map(Number);

        // Convert to total minutes from midnight
        let startTotalMinutes = startHour * 60 + startMinute;
        let endTotalMinutes = endHour * 60 + endMinute;

        let durationMinutes = endTotalMinutes - startTotalMinutes;

        // Handle cases where end time is earlier than start time (overnight classes)
        if (durationMinutes < 0) {
            durationMinutes += 24 * 60; // Add 24 hours in minutes
        }

        // Convert total minutes back to HH:MM format
        let hours = Math.floor(durationMinutes / 60);
        let minutes = durationMinutes % 60;

        // Display the result in HH:MM format
        document.getElementById("classDuration").value =
            (hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes;
    } else {
        document.getElementById("classDuration").value = "";
    }
}
</script>



