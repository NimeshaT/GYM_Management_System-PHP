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

        if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "add_total") {
            $total = $_POST['total'];
            $db = dbConn();
            echo $sql2 = "INSERT INTO tbl_class_invoice("
                    . "classEnrollmentId,"
                    . "memberId,"
                    . "classId,"
                    . "year,month,total,statusId)VALUES("
                    . "'$classEnrollmentId',"
                    . "'$memberId',"
                    . "'$classId',"
                    . "'$y','$m','$total','10')";
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
                                <br>
                                <b>Payment Due:</b> <?php echo date("Y-m-d") ?><br>
                            </div>

                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class ID</th>
                                            <th>Class Name</th>
                                            <th>Class Fees</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql1 = "SELECT * FROM tbl_class_enrollment INNER JOIN tbl_classes ON tbl_class_enrollment.classId=tbl_classes.classId WHERE classEnrollmentId='$classEnrollmentId'";
                                        $result1 = $db->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $total = $row1['classFees'];
                                                $cId=$row1['classId'];
                                                $y=date('Y');
                                                $m=date('M');
                                                ?>
                                                <tr>
                                                    <td><?php echo $row1['classId']; ?></td>
                                                    <td><?php echo $row1['className']; ?></td>
                                                    <td><?php echo $row1['classFees']; ?></td>
                                                    <td><?php echo @$y; ?></td>
                                                    <td><?php echo @$m; ?></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6">
                                <p class="lead">Total Amount</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Cash Payment:</th>
<!--                                            <td id="lblwCharge"><?php echo @$fCharge; ?></td>-->
                                            <td><input type="text" class="form-control" id="cashP" name="cashP"></td>

                                        </tr>

                                        <tr>
                                            <th>Total:</th>
                                            <td id="lblTotal" class="text-danger"><?php echo $total; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Balance:</th>
                                            <td id="lblbalance" class="text-danger"></td>
                                        </tr>
                                    </table>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <input type="text" name="memberId" value="<?php echo @$memberId ?>">
                                        <input type="text" name="classEnrollmentId" value="<?php echo @$classEnrollmentId ?>">
                                        <input type="text" name="classId" value="<?php echo @$cId ?>">
                                        <input type="text" name="total" id="total" value="<?php echo @$total ?>"> 
                                        <input type="text" name="y" value="<?php echo @$y ?>">
                                        <input type="text" name="m" value="<?php echo @$m ?>">
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
        function updateBalance() {
            let PCharge = parseFloat(document.getElementById("cashP").value.trim()) || 0;
            let TCharge = parseFloat(document.getElementById("lblTotal").textContent.trim()) || 0;

            let balance = PCharge - TCharge;

            document.getElementById("lblbalance").textContent = balance.toFixed(2);
            document.getElementById("balance").value = balance.toFixed(2);
        }

        // Run balance update when the input value changes
        document.getElementById("cashP").addEventListener("input", updateBalance);
    });
</script>








