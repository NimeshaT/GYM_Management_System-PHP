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
                <div class="col">
                    <div class="card card-primary">
<!--                        <div class="card-header">
                            <h3 class="card-title">Create User Account</h3>
                        </div>-->
                        <?php
                        extract($_POST);
                        
                        if(empty($action)){
                            $action='create_account';
                            $form_title='Create';
                            $submit='Create';
                            $btn='primary';
                        }
                        
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
                            //Insert Record
                            if (empty($message)) {
                                $db = dbConn();
                                $sql = "INSERT INTO tbl_instructors("
                                        . "userName,"
                                        . "password,"
                                        . "title,"
                                        . "firstName,"
                                        . "LastName,"
                                        . "address,"
                                        . "email,"
                                        . "telNo)VALUES("
                                        . "'$userName',"
                                        . "'" . sha1($password) . "',"
                                        . "'$title',"
                                        . "'$firstName',"
                                        . "'$lastName',"
                                        . "'$address',"
                                        . "'$email',"
                                        . "'$telNo')";

                                $db->query($sql);
                            }
                            
                            $action='create_account';
                            $form_title='Create';
                            $submit='Create';
                            $btn='primary';
                        }
                        
//                        ---------------------Edit account-----------------------------
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit_account') {
                            
                            //echo 'edit';
                            //echo $instructorId;
                            $db= dbConn();
                            $sql="SELECT * FROM tbl_instructors WHERE instructorId='$instructorId'";
                            $result=$db->query($sql);
                            
                            $row=$result->fetch_assoc();
                            
                            $title=$row['title'];
                            $firstName=$row['firstName'];
                            $lastName=$row['lastName'];
                            $address=$row['address'];
                            $email=$row['email'];
                            $telNo=$row['telNo'];
                            $userName=$row['userName'];
                            $password=$row['password'];
                            $instructorId=$row['instructorId'];
                            
                            $action='update_account';
                            $form_title='Update';
                            $submit='Update';
                            $btn='success';
                        }
                        
                        //                        ---------------------Update account-----------------------------
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'update_account') {
                            
                            $db= dbConn();
                            $sql="UPDATE tbl_instructors SET "
                                    . "title='$title',"
                                    . "firstName='$firstName',"
                                    . "lastName='$lastName',"
                                    . "address='$address',"
                                    . "email='$email',"
                                    . "telNo='$telNo' "
                                    . "WHERE instructorId='$instructorId'";
                            $db->query($sql);
                            $submit='Update';
                            $btn='success';
                        }
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?php echo @$form_title; ?> User Account</h3>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    //$title='';
                                    ?>
                                    <label for="title">Select Title</label>
                                    <select class="form-control" name="title" id="title">
                                        <option value="">--</option>
                                        <option value="Mr." <?php if(@$title=='Mr.'){?> selected <?php }?>>Mr.</option>
                                        <option value="Miss."<?php if(@$title=='Miss.'){?> selected <?php }?>>Miss.</option>
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
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
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
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table of User Details</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_instructors";
                            $result = $db->query($sql);
                            ?>
                            <table id="user_list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile Image</th>
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
                                                <td><?php echo $row['profilePhoto']; ?></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                        <input type="hidden" name="instructorId" value="<?php echo $row['instructorId']; ?>">
                                                        <button type="submit" class="btn btn-warning" name="action" value="edit_account">Edit</button>
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


