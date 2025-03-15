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

//        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_invoice" && isset($memberId)) {
//
//            //echo $memberId=$_POST['memberId'];
//            //echo $appointmentId;
//            $adAmount = $_POST['adAmount'];
//            //echo 'JIIIIIIIII';
//            $db = dbConn();
//            $sql2 = "INSERT INTO tbl_workouts_invoice("
//                    . "memberId,"
//                    . "jobCardId,"
//                    . "workoutScheduleId,"
//                    . "advancedPayment,advancePayStatusId)VALUES("
//                    . "'$memberId',"
//                    . "'$jobCardId',"
//                    . "'$workoutScheduleId',"
//                    . "'$adAmount','2')";
//
//            $db->query($sql2);
//            echo '<h1 class="text-success">Advanced Payment added successfully!!</h1>';
//        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_total") {

            
            $lblTotal=$_POST['lblTotal'];
            $db = dbConn();
                        $sql2 = "INSERT INTO tbl_fitness_invoice("
                    . "memberId,"
                    . "bookingId,"
                    . "fitnessJobCardId,"
                    . "fitnessId,invoiceDate,total)VALUES("
                    . "'$memberId',"
                    . "'$bookingId',"
                    . "'$fitnessJobCardId',"
                    . "'$fitnessId',CURDATE(),'$lblTotal')";
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
                                <b>Booking ID:</b> <?php echo $bookingId ?><br>
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
                                            <th>Fitness ID</th>
                                            <th>Fitness Name</th>
                                            <th>Fitness Charge</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql1 = "SELECT * FROM tbl_fitness_job_card INNER JOIN tbl_fitness ON tbl_fitness_job_card.fitnessId=tbl_fitness.fitnessId WHERE fitnessJobCardId='$fitnessJobCardId'";
                                        $result1 = $db->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $fId=$row1['fitnessId'];
                                                $fCharge=$row1['fitnessCharge'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row1['bookingId']; ?></td>
                                                    <td><?php echo $row1['fitnessJobCardId']; ?></td>
                                                    <td><?php echo $row1['fitnessId']; ?></td>
                                                    <td><?php echo $row1['fitnessName']; ?></td>
                                                    <td><?php echo $row1['fitnessCharge']; ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-6">
          
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Total Amount</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">fitness Charge:</th>
                                            <td id="lblwCharge"><?php echo @$fCharge; ?></td>
                                        </tr>
<!--                                        <tr>
                                            <th>Advance Payment:</th>
                                            <td id="lblpCharge">2000.00</td>
                                        </tr>-->
                                        <tr>
                                            <th>Total:</th>
                                            <td id="lblTotal" class="text-danger"><?php echo @$fCharge; ?></td>
                                        </tr>
                                        
                                    </table>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input type="hidden" name="memberId" value="<?php echo @$memberId ?>">
                                                <input type="hidden" name="bookingId" value="<?php echo @$bookingId ?>">
                                                <input type="hidden" name="fitnessId" value="<?php echo @$fId ?>">
                                                <input type="hidden" name="fitnessJobCardId" value="<?php echo @$fitnessJobCardId ?>">
                                    <input type="hidden" name="lblTotal" id="lblTotal" value="<?php echo @$fCharge ?>"> 
                                    <button type="submit" name="action" value="add_total" class="btn btn-primary btn-sm">Save Total</button>
                                    </form>
                                </div>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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








