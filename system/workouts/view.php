<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Workouts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Workouts</a></li>
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
                <input type="text" name="workoutId" placeholder="Enter Workout ID">
                <input type="text" name="workoutName" placeholder="Enter Workout Name">
                <button type="submit" class="bg-success btn btn-sm">Search</button>
            </form>
            <?php
            extract($_POST);
            $where = null;
            
            //dynamically generate the query
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
            //check workout Id
            if(!empty($workoutId)){
                $where.="workoutId='$workoutId' AND ";
            }
            
            //check workout Name
            if(!empty($workoutName)){
                $where.="workoutName='$workoutName' AND ";
            }
            
            //generate dynamic query remove AND last characters from the string
            if(!empty($where)){
                $where= substr($where, 0,-4);
                $where=" WHERE $where";
            }
            
//            echo $where;
            }
            $db = dbConn();
            echo $sql = "SELECT * FROM tbl_personal_workouts INNER JOIN tbl_status ON tbl_personal_workouts.statusId=tbl_status.statusId $where ";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped mt-2" id="tbl_workouts">
                <thead class="bg bg-info">
                    <tr>
                        <th>Workout Image</th>
                        <th>Workout Id</th>
                        <th>Workout Name</th>
                        <th>Workout Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <tr>
                                <td><img class="img-fluid" width="80" src="<?php echo SITE_URL; ?>uploads/<?php echo $row['workoutImage']; ?>"></td>
                                <td><?php echo $row['workoutId']; ?></td>
                                <td><?php echo $row['workoutName']; ?></td>
                                <td><?php echo $row['workoutDescription']; ?></td>
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

