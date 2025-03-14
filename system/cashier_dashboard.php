<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cashier Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(invoiceId) AS countInvoice FROM tbl_workouts_invoice ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countInvoice"]; ?></h3>
                            <p>No of All Invoice</p>
                        </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
             <div class="inner">
                            <?php
                            $db = dbConn();
                            $currentD = date('y-m-d');
                            $sql = "SELECT COUNT(appointmentId) AS countApp FROM tbl_appointments WHERE appointmentDate='$currentD' AND appointmentTypeId='1'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countApp"]; ?></h3>
                            <p>Daily workouts appointments</p>
                        </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $currentD = date('y-m-d');
                            $sql = "SELECT COUNT(workoutScheduleServiceId) AS countS FROM tbl_workout_schedule_services WHERE workoutScheduleDate='$currentD'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countS"]; ?></h3>
                            <p>Daily workout schedules</p>
                        </div>
            </div>
          </div>
          <!-- ./col -->
<!--          <div class="col-lg-3 col-6">
             small box 
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
        </div>
        
      </div>
    </section>
  </div>