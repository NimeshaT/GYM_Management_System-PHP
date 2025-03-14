<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Members</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Members</a></li>
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
                <input type="text" name="nic" placeholder="Enter Nic Number">
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
                //check service id
            if(!empty($nic)){
                $where.="nic='$nic' AND";
            }
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
            $sql = "SELECT * FROM tbl_members $where";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_instructor">
                <thead class="bg bg-info">
                    <tr>
                        <th>Member Image</th>
                        <th>Member Id</th>
                        <th>Reg No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>NicNumber</th>
                        <th>Email</th>
                        <th>TelNo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>../uploads2/<?php echo $row['profileImage']; ?>"></td>
                                <td><?php echo $row['memberId']; ?></td>
                                <td><?php echo $row['memberRegistrationNo']; ?></td>
                                <td><?php echo $row['firstName']; ?></td>
                                <td><?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['addressLine1']; ?> <?php echo $row['addressLine2']; ?> <?php echo $row['addressLine3']; ?> <?php echo $row['addressLine4']; ?></td>
                                <td><?php echo $row['nic']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phoneNumber1']; ?></td>
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

