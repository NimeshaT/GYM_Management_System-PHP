<?php
include '../header.php';
include '../nav.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <!--insert advance payment-->
        <?php
        extract($_POST);

        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_invoice" && isset($memberId)) {

            //echo $memberId=$_POST['memberId'];
            //echo $appointmentId;
            $adAmount = $_POST['adAmount'];
            //echo 'JIIIIIIIII';
            $db = dbConn();
            $sql2 = "INSERT INTO tbl_workouts_invoice("
                    . "memberId,"
                    . "jobCardId,"
                    . "workoutScheduleId,"
                    . "advancedPayment,advancePayStatusId)VALUES("
                    . "'$memberId',"
                    . "'$jobCardId',"
                    . "'$workoutScheduleId',"
                    . "'$adAmount','2')";

            $db->query($sql2);
            echo '<h1 class="text-success">Advanced Payment added successfully!!</h1>';
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_total") {

            
            $lblTotalCharge=$_POST['lblTotalCharge'];
            $db = dbConn();
            $sql2 = "UPDATE tbl_workouts_invoice SET totalAmount='$lblTotalCharge'";
            $db->query($sql2);
            echo '<h1 class="text-success">Total Payment added successfully!!</h1>';
        }
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Everest Fitness Center
                                    <small class="float-right">Date:<?php echo date("Y-m-d") ?></small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Cashier</strong><br>
                                    No.38, Makumbura<br>
                                    Kottawa<br>
                                    Phone: 0382258963<br>
                                    Email: everestfitness@gmail.com
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <?php
                                    extract($_POST);
                                    //echo $memberId;
                                    //echo $jobCardId;
                                    //echo $appointmentId;

                                    $db = dbConn();
                                    $sql = "SELECT * FROM tbl_members WHERE memberId='$memberId'";
                                    $result = $db->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>

                                            <strong><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></strong><br>
                                            Reg No: <?php echo $row['memberRegistrationNo']; ?><br>
                                            Phone: <?php echo $row['phoneNumber1']; ?><br>
                                            Email: <?php echo $row['email']; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Appointment ID:</b> <?php echo $appointmentId ?><br>
                                <b>Payment Due:</b> <?php echo date("Y-m-d") ?><br>
                            </div>

                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Job Card ID</th>
                                            <th>Schedule ID</th>
                                            <th>Workout ID</th>
                                            <th>Workout Name</th>
                                            <th>Workout Charge</th>
                                            <th>Workout Schedule Services</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql1 = "SELECT * FROM tbl_workout_schedules INNER JOIN tbl_personal_workouts ON tbl_workout_schedules.workoutId=tbl_personal_workouts.workoutId WHERE jobCardId='$jobCardId'";
                                        $result1 = $db->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $shId=$row1['workoutScheduleId'];
                                                $wCharge=$row1['workoutCharge'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row1['appointmentId']; ?></td>
                                                    <td><?php echo $row1['jobCardId']; ?></td>
                                                    <td><?php echo $row1['workoutScheduleId']; ?></td>
                                                    <td><?php echo $row1['workoutId']; ?></td>
                                                    <td><?php echo $row1['workoutName']; ?></td>
                                                    <td><?php echo $row1['workoutCharge']; ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <td>
                                                <table class="table table-info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Workout Schedule Service ID</th>
                                                            <th scope="col">Fitness ID</th>
                                                            <th scope="col">Fitness Name</th>
                                                            <th scope="col">Schedule Date</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql3 = "SELECT * FROM tbl_workout_schedule_services INNER JOIN tbl_fitness ON tbl_workout_schedule_services.fitnessId=tbl_fitness.fitnessId INNER JOIN tbl_status ON tbl_workout_schedule_services.statusId=tbl_status.statusId WHERE jobCardId='$jobCardId'";
                                                        $result3 = $db->query($sql3);
                                                        if ($result3->num_rows > 0) {
                                                            while ($row3 = $result3->fetch_assoc()) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row3['workoutScheduleServiceId']; ?></td>
                                                                    <td><?php echo $row3['fitnessId']; ?></td>
                                                                    <td><?php echo $row3['fitnessName']; ?></td>
                                                                    <td><?php echo $row3['workoutScheduleDate']; ?></td>
                                                                    <td><?php echo $row3['statusName']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Advance Payment</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Charge:</th>
                                            <td id="lblAdPayment">Rs. 2000.00</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <?php
                                            $sql4="SELECT * FROM tbl_workouts_invoice INNER JOIN tbl_advance_pay_status ON tbl_workouts_invoice.advancePayStatusId=tbl_advance_pay_status.advancePayStatusId WHERE jobCardId='$jobCardId'";
                                            $result4=$db->query($sql4);
                                            if($result4->num_rows>0){
                                                while ($row4=$result4->fetch_assoc()){
                                            ?>
                                            <td><button type="button" class="btn btn-warning"><?php echo $row4['advancePayStatus']; ?></button></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <!--                                            <div>-->
                                        <td colspan="2" class="text-left">
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                <input type="hidden" name="memberId" value="<?php echo @$memberId ?>">
                                                <input type="hidden" name="appointmentId" value="<?php echo @$appointmentId ?>">
                                                <input type="hidden" name="jobCardId" value="<?php echo @$jobCardId ?>">
                                                <input type="hidden" name="workoutScheduleId" value="<?php echo @$shId ?>">
                                                <input type="hidden" name="adAmount" id="adAmount"> 
                                                <button type="submit" name="action" value="add_invoice" class="btn btn-primary btn-sm" >Save Advance Payment</button>
                                            </form>
    <!--                                                    <input type="text" name="memberId" value="<?php echo @$memberId ?>">-->
                                            <!--                                                    <button type="submit" class="btn btn-info" name="action" value="saveAdvancedPay">Save</button>-->
                                            <!--                                                    <button type="submit" class="btn btn-danger" name="action" value="cancel">Cancel</button>-->
                                        </td>
                                        <!--                                            </div>-->
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Total Amount</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Workout Charge:</th>
                                            <td id="lblwCharge"><?php echo @$wCharge?></td>
                                        </tr>
                                        <tr>
                                            <th>Advance Payment:</th>
                                            <td id="lblpCharge">2000.00</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td id="lblTotalChargeDisplay" class="text-danger"></td>
                                        </tr>
                                        
                                    </table>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input type="hidden" name="memberId" value="<?php echo @$memberId ?>">
                                                <input type="hidden" name="appointmentId" value="<?php echo @$appointmentId ?>">
                                                <input type="hidden" name="jobCardId" value="<?php echo @$jobCardId ?>">
                                                <input type="hidden" name="workoutScheduleId" value="<?php echo @$shId ?>">
                                    <input type="hidden" name="lblTotalCharge" id="lblTotalCharge"> 
                                    <button type="submit" name="action" value="add_total" class="btn btn-primary btn-sm">Save Total</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
            
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include '../footer.php';
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the text from lblAdPayment (remove 'Rs. ' and trim whitespace)
        var chargeText = document.getElementById("lblAdPayment").textContent.replace("Rs. ", "").trim();
        
        // Set it as the value of the hidden input
        document.getElementById("adAmount").value = chargeText;
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get values from lblwCharge and lblpCharge
        let wCharge = parseFloat(document.getElementById("lblwCharge").textContent.trim()) || 0;
        let pCharge = parseFloat(document.getElementById("lblpCharge").textContent.trim()) || 0;

        // Calculate total charge
        let totalCharge = wCharge - pCharge;

        // Display total charge in table
        document.getElementById("lblTotalChargeDisplay").textContent = totalCharge.toFixed(2);

        // Assign total charge to hidden input field
        document.getElementById("lblTotalCharge").value = totalCharge.toFixed(2);
    });
</script>








