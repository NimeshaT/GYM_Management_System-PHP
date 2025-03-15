<?php
include 'system/function.php';
$bookingDate=$_POST['bookingDate'];
$db= dbConn();
//$sql="SELECT * FROM tbl_appointments WHERE NOT EXISTS appointmentDate='$appointmentDate'";
$sql = "SELECT * FROM tbl_time_slots 
        WHERE slotId NOT IN (
            SELECT slotId FROM tbl_bookings WHERE bookingDate = '$bookingDate'
        )";
$result=$db->query($sql);
?>

<!--//echo $_POST['district_code'];-->
<select class="form-control form-select"  name="slotId" id="slotId">
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

