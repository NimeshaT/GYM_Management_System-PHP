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
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            //echo '<h1>View users</h1>';
            $db= dbConn();
            $sql="SELECT * FROM tbl_instructors";
            $result=$db->query($sql);
            ?>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Instructor ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            ?>
                    <tr>
                        <td><?php echo $row['instructorId'];?></td>
                        <td><?php echo $row['firstName'];?></td>
                        <td><?php echo $row['lastName'];?></td>
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

