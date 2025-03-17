<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            extract($_POST);
            ?>
            <div class="row">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM tbl_instructors WHERE instructorId='{$_SESSION['INSTRUCTORID']}'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="<?php echo SITE_URL; ?>uploads/<?php echo $row['profilePhoto']; ?>"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $_SESSION['FIRSTNAME'] ?> <?php echo $_SESSION['LASTNAME'] ?></h3>
                                </div>
                            </div>

                            <!-- =====================About me box=================================-->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Nic Number</strong>
                                    <p class="text-muted">
                                        <?php echo $row['nicNo'] ?>
                                    </p>
                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted"><?php echo $row['address'] ?></p>
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Contact No:</strong>
                                    <p class="text-muted"><?php echo $row['telNo'] ?></p>
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Email</strong>
                                    <p class="text-muted"><?php echo $row['email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!--===================Edit profile====================-->
                                <div class="tab-pane" id="settings">
                                    <?php
                                    $message = []; // Initialize message array
                                    extract($_POST);

                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "upload_image") {
                                        $PreviousProfileImage = isset($_POST['PreviousProfileImage']) ? $_POST['PreviousProfileImage'] : "";
                                        $Photo = $PreviousProfileImage; // Ensure it's always defined

                                        if (!empty($_FILES["profilePhoto"]["name"])) {
                                            $target_dir = "../uploads/";
                                            $target_file = $target_dir . basename($_FILES["profilePhoto"]["name"]);
                                            $uploadOk = 1;
                                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                            $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);

                                            if ($check !== false) {
                                                $uploadOk = 1;
                                            } else {
                                                $message['profilePhoto'] = "File is not an image.";
                                                $uploadOk = 0;
                                            }

                                            if (file_exists($target_file)) {
                                                $message['profilePhoto'] = "Sorry, file already exists.";
                                                $uploadOk = 0;
                                            }

                                            if ($_FILES["profilePhoto"]["size"] > 5000000) {
                                                $message['profilePhoto'] = "Sorry, your file is too large.";
                                                $uploadOk = 0;
                                            }

                                            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
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

                                        // Ensure $Photo is never empty
                                        if (empty($Photo)) {
                                            $Photo = $PreviousProfileImage;
                                        }

                                        // Update Records
                                        $db = dbConn();
                                        $sql = "UPDATE tbl_instructors SET profilePhoto='$Photo' WHERE instructorId='{$_SESSION['INSTRUCTORID']}'";
                                        $db->query($sql);
                                        ?>
                                        <div class="card " style="background-color: #00008B">
                                            <div class="card-header text-center">
                                                <h3 class="text-center text-light">Update successfully <i class="far fa-thumbs-up"></i></h3>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="profilePhoto" class="form-label">Profile Image</label>
                                            <input class="form-control" type="file" id="profilePhoto" name="profilePhoto">
                                            <input type="hidden" name="PreviousProfileImage" value="<?php echo @$profilePhoto; ?>">
                                        </div>

                                        <div class="form-group ms-4">
                                            <button type="submit" class="btn btn-primary" id="action" name="action" value="upload_image">Submit</button>
                                        </div>
                                    </form>
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

<!--            <script>

                function update(element) {
                    $(element).parent().submit();
                }
            </script>-->
