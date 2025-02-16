<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card card-primary">
                        <!--                        <div class="card-header">
                                                    <h3 class="card-title">Create User Account</h3>
                                                </div>-->
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

                            $firstName = dataClean($firstName);
                            $lastName = dataClean($lastName);
                            $address = dataClean($address);
                            $email = dataClean($email);
                            $telNo = dataClean($telNo);
                            $userName = dataClean($userName);

                            $message = array();

                            //validation start
                            if (empty($firstName)) {
                                $message['firstName'] = "FirstName should not be empty..!";
                            }
                            if (empty($lastName)) {
                                $message['lastName'] = "LastName should not be empty..!";
                            }
                            //validation end
                            
                            //profile image uploading
                            if(empty($message)){
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["profilePhoto"]["name"]);
                                $uploadOk = 1;
                                //path info extension->get extension of file type
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                //check whether it is an image or not
                                $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['profilePhoto'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                
                                // Check if file already exists->only check the content not image content
                                if (file_exists($target_file)) {
                                    $message['profilePhoto'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                
                                // Check file size(KB)
                                if ($_FILES["profilePhoto"]["size"] > 5000000) {
                                    $message['profilePhoto'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }
                                
                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['profilePhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["profilePhoto"]["name"]));
                                    } else {
                                        $message['profilePhoto'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            }
                            
                            //Insert Records
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_instructors("
                                        . "userName,"
                                        . "password,"
                                        . "titleId,"
                                        . "firstName,"
                                        . "LastName,"
                                        . "address,"
                                        . "email,"
                                        . "telNo,profilePhoto)VALUES("
                                        . "'$userName',"
                                        . "'" . sha1($password) . "',"
                                        . "'$titleId',"
                                        . "'$firstName',"
                                        . "'$lastName',"
                                        . "'$address',"
                                        . "'$email',"
                                        . "'$telNo','$Photo')";

                                $db->query($sql);
                            }

                            $action = 'create_account';
                            $form_title = 'Create';
                            $submit = 'Create';
                            $btn = 'primary';
                        }

                        //Update Records
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update_account') {
                            
                            if (empty($message) AND!empty($_FILES["profilePhoto"]["name"])) {
                                $target_dir = "../uploads/";
                                $target_file = $target_dir . basename($_FILES["profilePhoto"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);
                                if ($check !== false) {
                                //Multi-purpose Internet Mail Extensions                       
                                    $uploadOk = 1;
                                } else {
                                    $message['profilePhoto'] = "File is not an image.";
                                    $uploadOk = 0;
                                }
                                // Check if file already exists
                                if (file_exists($target_file)) {
                                    $message['profilePhoto'] = "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                // Check file size
                                if ($_FILES["profilePhoto"]["size"] > 5000000) {
                                    $message['profilePhoto'] = "Sorry, your file is too large.";
                                    $uploadOk = 0;
                                }

                                // Allow certain file formats
                                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                    $message['profilePhoto'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file)) {
                                        $Photo = htmlspecialchars(basename($_FILES["profilePhoto"]["name"]));
                                    } else {
                                        $message['profilePhoto'] = "Sorry, there was an error uploading your file.";
                                    }
                                }
                            } else {
                                $Photo = $PreviousProfilePhoto;
                            }

                            $db = dbConn();
                            $sql = "UPDATE tbl_instructors SET "
                                    . "titleId='$titleId',"
                                    . "firstName='$firstName',"
                                    . "lastName='$lastName',"
                                    . "address='$address',"
                                    . "email='$email',"
                                    . "telNo='$telNo',"
                                    . "profilePhoto='$Photo' "
                                    . "WHERE instructorId='$instructorId'";
                            $db->query($sql);
                            $submit = 'Update';
                            $btn = 'success';
                        }
                        
                        //Edit Records
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit_account') {

                            //echo 'edit';
                            //echo $instructorId;
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_instructors WHERE instructorId='$instructorId'";
                            $result = $db->query($sql);

                            $row = $result->fetch_assoc();

                            $titleId = $row['titleId'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $address = $row['address'];
                            $email = $row['email'];
                            $telNo = $row['telNo'];
                            $profilePhoto = $row['profilePhoto'];
                            $userName = $row['userName'];
                            $password = $row['password'];
                            $instructorId = $row['instructorId'];

                            $action = 'update_account';
                            $form_title = 'Update';
                            $submit = 'Update';
                            $btn = 'success';
                        }

                        //Start Delete
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> User Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    //$title='';
                                    $db= dbConn();
                                    $sql="SELECT * FROM tbl_instructor_title";
                                    $result=$db->query($sql);
                                    ?>
                                    <label for="title">Select Title</label>
                                    <select class="form-control" name="titleId" id="titleId">
                                        <option value="">--</option>
                                        <?php
                                        //fetch assoc convert data associative array
                                        if($result->num_rows>0){
                                            while ($row=$result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['titleId']; ?>" <?php if (@$titleId == $row['titleId']) { ?> selected <?php } ?>><?php echo $row['titleName']; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" value="<?php echo @$firstName ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['firstName']; ?></div>

                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php echo @$lastName ?>">
                                </div>
                                <div class="text-danger"><?php echo @$message['lastName']; ?></div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter Address"><?php echo @$address ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo @$email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="telNo">Telephone No:</label>
                                    <input type="text" class="form-control" id="telNo" name="telNo" placeholder="Enter Telephone No." value="<?php echo @$telNo ?>">
                                </div>
                                <div class="form-group">
                                    <label for="userName">UserName</label>
                                    <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter userName" value="<?php echo @$userName ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo @$password ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="profilePhoto">Profile Image</label>
                                    <input type="file" class="form-control" id="profilePhoto" name="profilePhoto">
                                    <input type="hidden" name="PreviousProfilePhoto" value="<?php echo @$profilePhoto; ?>">
                                    <div class="text-danger"><?php echo @$message['profilePhoto']; ?></div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="instructorId" value="<?php echo @$instructorId ?>">
                                <button type="submit" class="btn btn-<?php echo @$btn; ?>" name="action" value="<?php echo @$action; ?>"><?php echo @$submit; ?></button>
                                <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7">
                    <!--                    -----------Confirmation message----------->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete_account') {

                        //echo 'Do you want to?';
//                            $db= dbConn();
//                            $sql="DELETE FROM tbl_instructors WHERE instructorId='$instructorId'";
//                            $db->query($sql);
//                            
//                            $submit='Save';
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delete Confirmation</h3>
                            </div>
                            <div class="card-body">

                                Are you sure want to delete this record?
                                <br><br> 
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <input type="hidden" name="instructorId" value="<?php echo $instructorId; ?>">
                                    <button type="submit" class="btn btn-warning" name="action" value="delete_account_confirm">Yes</button>
                                    <button type="submit" class="btn btn-danger" name="action" value="delete_account_cancel">No</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete_account_confirm') {

                        $db = dbConn();
                        $sql = "DELETE FROM tbl_instructors WHERE instructorId='$instructorId'";
                        $db->query($sql);
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table of User Details</h3>
                        </div>
                        <div class="card-body">
<!--                            -----------------Search BAR----------------------->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter First Name">
                                <button type="submit" class="btn btn-success mt-2 mb-2" name="action" value="search_account">Search</button>
                            </form>

                            <?php
//                            ----------------Search Account-search bar------------------
                            $where=null;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'search_account') {
                                if(!empty($firstName)){
                                    $where.="WHERE firstName='$firstName'";
                                }
                            }
                            
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_instructors $where";
                            $result = $db->query($sql);
                            ?>
                            <table id="user_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile Image</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>

                                                <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><img class="img-fluid" width="100" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['profilePhoto']; ?>"></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="instructorId" value="<?php echo $row['instructorId']; ?>">
                                                        <button type="submit" class="btn btn-warning" name="action" value="edit_account">Edit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="instructorId" value="<?php echo $row['instructorId']; ?>">
                                                        <button type="submit" class="btn btn-danger" name="action" value="delete_account">Delete</button>
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
                        <!-- /.card-body -->
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
        $('#user_list').DataTable({
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


