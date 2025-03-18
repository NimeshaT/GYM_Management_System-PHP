<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cashier Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cashier</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(invoiceId) AS countInvoice FROM tbl_workouts_invoice ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countInvoice"]; ?></h3>
                            <p>All Workouts Invoice</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
             <div class="inner">
                            <?php
                            $db = dbConn();
                            $currentD = date('y-m-d');
                            $sql = "SELECT COUNT(fitnessInvoiceId) AS countFinvoice FROM tbl_fitness_invoice";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countFinvoice"]; ?></h3>
                            <p>All fitness Invoice</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(classInvoiceId) AS countC FROM tbl_class_invoice";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countC"]; ?></h3>
                            <p>All Class Invoice</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT SUM(total) AS classTotal FROM tbl_class_invoice";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3>Rs. <?php echo $row["classTotal"]; ?></h3>
                            <p>Total Class Income</p>
                        </div>
            </div>
          </div>
        </div>
          <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT SUM(advancedPayment) AS sumAdvancedPayment,SUM(totalAmount) AS sumTotal FROM tbl_workouts_invoice ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            $finalT=$row["sumAdvancedPayment"]+$row["sumTotal"];
                            ?>
                            <h3>Rs. <?php echo $finalT; ?></h3>
                            <p>Total Workout Income</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
             <div class="inner">
                            <?php
                            $db = dbConn();
                            $currentD = date('y-m-d');
                            $sql = "SELECT SUM(total) AS fitnessTotal FROM tbl_fitness_invoice";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3>Rs. <?php echo $row["fitnessTotal"]; ?></h3>
                            <p>Total Fitness Income</p>
                        </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!----------Chart------------>
<div class="container-fluid">
    <section style="width: 70%" class="mx-auto">
        <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart of Income</h3>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
    </section>
</div> 
  </div>