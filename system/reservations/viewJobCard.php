<?php
include '../header.php';
include '../nav.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Job Card</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Job Card</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-info">
                        View Job Card
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php
                            extract($_POST);
                            //echo $appointmentId;
                            $db= dbConn();
                            $sql="SELECT * FROM tbl_job_card INNER JOIN tbl_instructors ON tbl_job_card.instructorId=tbl_instructors.instructorId INNER JOIN tbl_appointment_type ON tbl_job_card.appointmentTypeId=tbl_appointment_type.appointmentTypeId INNER JOIN tbl_personal_workouts ON tbl_job_card.workoutId=tbl_personal_workouts.workoutId INNER JOIN tbl_status ON tbl_job_card.statusId=tbl_status.statusId WHERE tbl_job_card.appointmentId='$appointmentId'";
                            $result=$db->query($sql);
                            if($result->num_rows>0){
                                while ($row=$result->fetch_assoc()){
                            ?>
                            <li class="list-group-item">Job Card ID: <?php echo $row['jobCardId']; ?></li>
                            <li class="list-group-item">Instructor ID: <?php echo $row['instructorId']; ?></li>
                            <li class="list-group-item">Instructor Name: <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></li>
                            <li class="list-group-item">Appointment Type ID: <?php echo $row['appointmentTypeId']; ?></li>
                            <li class="list-group-item">Appointment Type Name: <?php echo $row['appointmentName']; ?></li>
                            <li class="list-group-item">Appointment ID: <?php echo $row['appointmentId']; ?></li>
                            <li class="list-group-item">Workout ID: <?php echo $row['workoutId']; ?></li>
                            <li class="list-group-item">Workout Name: <?php echo $row['workoutName']; ?></li>
                            <li class="list-group-item">Status: <p class="text-primary"><?php echo $row['statusName']; ?></p></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            
        </div>
    </section>
</div>
<?php
include '../footer.php';
?>



