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
                <input type="text" name="cName" placeholder="Enter Class Name">
                <input type="text" name="cDay" placeholder="Enter Class Day">
                <button type="submit" class="bg-success btn btn-sm">Search</button>
            </form>
            <?php
            extract($_POST);
            $where = null;
            
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            //check class name
            if(!empty($cName)){
                $where.="className='$cName' AND";
            }
            //check class day
            if(!empty($cDay)){
                $where.=" classDay='$cDay' AND";
            }
            
            //generate dynamic query remove AND last characters from the string
            if(!empty($where)){
                $where= substr($where, 0,-3);
                $where=" WHERE $where";
            }
            
            }
            $db = dbConn();
            $sql = "SELECT * FROM tbl_classes INNER JOIN tbl_instructors ON tbl_classes.instructorId=tbl_instructors.instructorId INNER JOIN tbl_status ON tbl_classes.statusId=tbl_status.statusId  $where";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_fitness">
                <thead class="bg bg-info">
                    <tr>
                        <th>Class Id</th>
                        <th>Class Image</th>
                        <th>Instructor Name</th>
                        <th>Class Name</th>
                        <th>Class Fees</th>
                        <th>Class Description</th>
                        <th>Class Day</th>
                        <th>Class Start Time</th>
                        <th>Class End Time</th>
                        <th>Class Duration</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $row['classId']; ?></td>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['classImage']; ?>"></td>
                                <td><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['className']; ?></td>
                                <td><?php echo $row['classFees']; ?></td>
                                <td><?php echo $row['classDesc']; ?></td>
                                <td><?php echo $row['classDay']; ?></td>
                                <td><?php echo $row['classStartTime']; ?></td>
                                <td><?php echo $row['classEndTime']; ?></td>
                                <td><?php echo $row['classDuration']; ?></td>
                                <td><?php echo $row['statusName']; ?></td>
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

