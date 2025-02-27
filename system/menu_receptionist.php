     <!--        ////////////////////////My Profile Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
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
                <a href="<?php echo SITE_URL; ?>userRoles/view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Members</p>
                </a>
              </li>
            </ul>
          </li>
          <!--        ////////////////////////Attendance Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Attendance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo SITE_URL; ?>poyaDay/create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mark Attendance</p>
                </a>
              </li>
            </ul>
          </li>
          <!--        ////////////////////////Reservation Management////////////////////////////-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
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
                <a href="<?php echo SITE_URL; ?>users/view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Fitness Reservations</p>
                </a>
              </li>
            </ul>
          </li>
          
