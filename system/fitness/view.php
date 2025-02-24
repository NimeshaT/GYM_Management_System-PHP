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
                <input type="text" name="type" placeholder="Enter Workout Type Name">
                <input type="text" name="fitnessname" placeholder="Enter Fitness Name">
                <button type="submit" class="bg-success btn btn-sm">Search</button>
            </form>
            <?php
            extract($_POST);
            $where = null;
            
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            //check type
            if(!empty($type)){
                $where.="workoutName='$type' AND";
            }
            //check fitness Name
            if(!empty($fitnessname)){
                $where.=" fitnessName='$fitnessname' AND";
            }
            
            //generate dynamic query remove AND last characters from the string
            if(!empty($where)){
                $where= substr($where, 0,-3);
                $where=" WHERE $where";
            }
            
            }
            $db = dbConn();
            $sql = "SELECT * FROM tbl_fitness INNER JOIN tbl_personal_workouts ON tbl_fitness.workoutId=tbl_personal_workouts.workoutId INNER JOIN tbl_status ON tbl_fitness.statusId=tbl_status.statusId $where";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_fitness">
                <thead class="bg bg-info">
                    <tr>
                        <th>Fitness Id</th>
                        <th>Fitness Image</th>
                        <th>Workout Type</th>
                        <th>Fitness Name</th>
                        <th>Fitness Description</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><?php echo $row['fitnessId']; ?></td>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['fitnessImage']; ?>"></td>
                                <td><?php echo $row['workoutName']; ?></td>
                                <td><?php echo $row['fitnessName']; ?></td>
                                <td><?php echo $row['fitnessDesc']; ?></td>
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

