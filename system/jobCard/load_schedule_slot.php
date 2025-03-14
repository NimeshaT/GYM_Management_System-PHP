<?php
include '../function.php';
//$slotId=$_POST['slotId'];
$date=$_POST['date'];
$instructorId=$_POST['instructorId'];
$fitnessId = $_POST['fitnessId'];
$db= dbConn();
//$sql="SELECT * FROM tbl_appointments WHERE NOT EXISTS appointmentDate='$appointmentDate'";
//echo $sql = "SELECT * FROM tbl_time_slots 
//        WHERE slotId NOT IN (
//            SELECT slotId FROM tbl_workout_schedule_services INNER JOIN tbl_workout_schedules ON tbl_workout_schedule_services.workoutScheduleId=tbl_workout_schedules.workoutScheduleId WHERE tbl_workout_schedule_services.workoutScheduleDate = '$date' AND SELECT slotId FROM tbl_workout_schedules WHERE tbl_workout_schedules.instructorId = '$instructorId')";

$sql = "SELECT * FROM tbl_time_slots 
WHERE slotId NOT IN (
    SELECT DISTINCT tbl_workout_schedule_services.slotId 
    FROM tbl_workout_schedule_services 
    INNER JOIN tbl_workout_schedules 
        ON tbl_workout_schedule_services.workoutScheduleId = tbl_workout_schedules.workoutScheduleId 
    WHERE tbl_workout_schedule_services.workoutScheduleDate = '2025-03-29'
    AND tbl_workout_schedules.instructorId = '15')";

$result=$db->query($sql);
?>


<select class="form-control form-select"  name="slots[<?php echo $fitnessId; ?>]" id="slot_schedules_list_<?php echo $fitnessId; ?>">
    <option value=""></option>
    <?php
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
    ?>
    <option value="<?php echo $row['slotId'];?>"><?php echo $row['slotName'];?></option>
    <?php
        }
    }
    ?>
</select>

