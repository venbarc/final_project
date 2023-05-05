    
    <div class="container-fluid py-4">
      <div class="row">
        <!-- all users  -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="fas fa-user"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">All Users</p>
                <?php
                  //Count total users
                  $sql_all_user = "select count(*) from users";
                  $res_all_user = mysqli_query($conn, $sql_all_user);

                  if($res_all_user)
                  {
                    $count_all_user = mysqli_fetch_array($res_all_user)[0];
                    echo '<h3 class="mb-0">'. $count_all_user .'</h3>';
                  }
                  else
                  {
                    $count_all_user = 0;
                  }
                ?>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-dark text-lg font-weight-bolder">Total user </span></p>
            </div>
          </div>
        </div>
        <!-- professors  -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="fas fa-user"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Professor</p>
                <?php
                  //Count total professors
                  $sql_all_prof = "select count(*) from users where user_type='prof' ";
                  $res_all_prof = mysqli_query($conn, $sql_all_prof);

                  if($res_all_prof)
                  {
                    $count_all_prof = mysqli_fetch_array($res_all_prof)[0];
                    echo '<h3 class="mb-0">'. $count_all_prof .'</h3>';
                  }
                  else
                  {
                    $count_all_prof = 0;
                  }
                ?>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-dark text-lg font-weight-bolder">Total Professor </span></p>
            </div>
          </div>
        </div>
        <!-- students  -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="fas fa-user"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Students</p>
                <?php
                  //Count total professors
                  $sql_all_student = "select count(*) from users where user_type='student' ";
                  $res_all_student = mysqli_query($conn, $sql_all_student);

                  if($res_all_student)
                  {
                    $count_all_student = mysqli_fetch_array($res_all_student)[0];
                    echo '<h3 class="mb-0">'. $count_all_student .'</h3>';
                  }
                  else
                  {
                    $count_all_student = 0;
                  }
                ?>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-dark text-lg font-weight-bolder">Total Students </span></p>
            </div>
          </div>
        </div>
        <!-- concerns  -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Concerns</p>
                <?php
                  //Count total professors
                  $sql_all_concerns = "select count(*) from concerns";
                  $res_all_concerns = mysqli_query($conn, $sql_all_concerns);

                  if($res_all_concerns)
                  {
                    $count_all_concerns = mysqli_fetch_array($res_all_concerns)[0];
                    echo '<h3 class="mb-0">'. $count_all_concerns .'</h3>';
                  }
                  else
                  {
                    $count_all_concerns = 0;
                  }
                ?>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-dark text-lg font-weight-bolder">Total Concerns </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>