<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manager Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manager</li>
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
                            $sql = "SELECT COUNT(workoutId) AS countWorkout FROM tbl_personal_workouts ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countWorkout"]; ?></h3>
                            <p>All Workouts</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(fitnessId) AS countfitness FROM tbl_fitness ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countfitness"]; ?></h3>
                            <p>All Fitness</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(classId) AS countClass FROM tbl_classes";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countClass"]; ?></h3>
                            <p>All Classes</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(memberId) AS countmember FROM tbl_members";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countmember"]; ?></h3>
                            <p>All Members</p>
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
                            $sql = "SELECT COUNT(appointmentId) AS countAppointment FROM tbl_appointments ";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countAppointment"]; ?></h3>
                            <p>Workouts Appointments</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(workoutScheduleId) AS countSchedules FROM tbl_workout_schedules";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countSchedules"]; ?></h3>
                            <p>Workout Schedules</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(bookingId) AS countBooking FROM tbl_bookings";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countBooking"]; ?></h3>
                            <p>Fitness Bookings</p>
                        </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(classEnrollmentId) AS countEnrollments FROM tbl_class_enrollment";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countEnrollments"]; ?></h3>
                            <p>Class Enrollments</p>
                        </div>
            </div>
          </div>
        </div>
          <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
               <div class="inner">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT COUNT(instructorId) AS countInstructors FROM tbl_instructors";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <h3><?php echo $row["countInstructors"]; ?></h3>
                            <p>All Instructors</p>
                        </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!----------Chart------------>
<div class="container-fluid">
    <section style="width: 70%" class="mx-auto">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bar Chart of Bookings and Enrollments</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
    </section>
</div> 
  </div>