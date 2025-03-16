     <!--        ////////////////////////My Profile Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Profile
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>myProfile/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>
            </ul>
          </li>
<!--        ////////////////////////Member Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Member 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>users/viewMembers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Members</p>
                </a>
              </li>
            </ul>
          </li>
          <!--        ////////////////////////Attendance Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Attendance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>attendance/classAttendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Attendance</p>
                </a>
              </li>
            </ul>
          </li>
          <!--        ////////////////////////Reservation Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Reservations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>reservations/workoutReservation.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Workouts Reservations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>reservations/fitnessBooking.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Fitness Reservations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>reservations/viewClassEnrollment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Class Enrollments</p>
                </a>
              </li>
            </ul>
          </li>
          
