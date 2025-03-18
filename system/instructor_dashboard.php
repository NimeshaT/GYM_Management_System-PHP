<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Instructor Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Instructor</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(jobCardId) AS countJC FROM tbl_job_card WHERE statusId='8'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countJC"]; ?></h3>
                            <p>All Pending Workout JobCard</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(jobCardId) AS countJC FROM tbl_job_card WHERE statusId='9'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countJC"]; ?></h3>
                            <p>All OnGoing Workout JobCard</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(jobCardId) AS countJC FROM tbl_job_card WHERE statusId='10'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countJC"]; ?></h3>
                            <p>All Completed Workout JobCard</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(fitnessJobCardId) AS countFJC FROM tbl_fitness_job_card WHERE statusId='8'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countFJC"]; ?></h3>
                            <p>All Pending Fitness JobCard</p>
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
                            $sql = "SELECT COUNT(fitnessJobCardId) AS countFJC FROM tbl_fitness_job_card WHERE statusId='9'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countFJC"]; ?></h3>
                            <p>All OnGoing Fitness JobCard</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(fitnessJobCardId) AS countFJC FROM tbl_fitness_job_card WHERE statusId='10'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countFJC"]; ?></h3>
                            <p>All Completed Fitness JobCard</p>
                        </div>
            </div>
          </div>
        </div>
      </div>
    </section>
            <!----------Chart------------>
<div class="container-fluid">
    <section style="width: 70%" class="mx-auto">
        <div class="row">
            <div class="col">
                 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pie Chart Workout Job Cards</h3>
              </div>
              <div class="card-body">
                <canvas id="lineChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            </div>
            <div class="col">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Pie Chart Fitness Job Cards</h3>
              </div>
              <div class="card-body">
                <canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            </div>
        </div>
    </section>
</div> 
  </div>