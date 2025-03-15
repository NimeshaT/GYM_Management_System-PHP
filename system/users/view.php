<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Instructor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Instructor</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!--            ========================Search=========================-->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <input type="text" name="email" placeholder="Enter Email">
               <input type="text" name="firstName" placeholder="Enter FName">
               <input type="text" name="lastName" placeholder="Enter LName">
                <button type="submit" class="bg-success btn btn-sm">Search</button>
            </form>
            <?php
            extract($_POST);
            $where = null;
            
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            //check email
            if(!empty($email)){
                $where.=" email='$email' AND";
            }
            //check FName
            if(!empty($firstName)){
                $where.=" firstName='$firstName' AND";
            }
            //check LName
            if(!empty($lastName)){
                $where.=" lastName='$lastName' AND";
            }
            
            //generate dynamic query remove AND last characters from the string
            if(!empty($where)){
                $where= substr($where, 0,-3);
                $where=" WHERE $where";
            }
            
//            echo $where;
            }
            $db = dbConn();
            $sql = "SELECT * FROM tbl_instructors INNER JOIN tbl_instructor_title ON tbl_instructors.titleId=tbl_instructor_title.titleId $where";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_instructor">
                <thead class="bg bg-info">
                    <tr>
                        <th>Instructor Image</th>
                        <th>Instructor Id</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>NicNumber</th>
                        <th>Email</th>
                        <th>TelNo</th>
                        <th>UserName</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['profilePhoto']; ?>"></td>
                                <td><?php echo $row['instructorId']; ?></td>
                                <td><?php echo $row['titleName']; ?></td>
                                <td><?php echo $row['firstName']; ?></td>
                                <td><?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['nicNo']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['telNo']; ?></td>
                                <td><?php echo $row['userName']; ?></td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php
include '../footer.php';

