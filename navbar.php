
<!-- ========================= Navbar start ========================= -->
      <header class="header header-2">
        <div class="navbar-area">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                  <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo/learning_era_logo.png" alt="">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent2">
                    <ul id="nav2" class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <a class="page-scroll" href="index.php#home"><i class="fa-regular fa-house"></i> Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="index.php#features">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="index.php#goal">Goal</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="index.php#team">Team</a>
                      </li>

                <?php
                  // check if user is logged in
                    if(isset($_SESSION['user_id']))
                    {
                      // get users data
                        $user_id = $_SESSION['user_id'];
                        $sql = "select * from users where id ='$user_id' ";
                        $res = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_assoc($res);

                        $fname = $user['fname'];
                        $user_type = $user['user_type'];

                      //If user type is professor
                        if($user_type == 'prof')
                        {
                          echo '
                          <li class="nav-item">
                            <a href="profile.php" class="page-scroll" >'. $user_type .'. '.  $fname  .'</a>
                          </li>
                          <li class="nav-item">
                            <a href="logout.php" class="page-scroll text-danger" >Logout</a>
                          </li>
                          
                          ';
                        }
                      //if user type is student
                        else
                        {
                          echo '
                          <li class="nav-item">
                            <a href="profile.php" class="page-scroll" >'. $fname .'</a>
                          </li>
                          <li class="nav-item">
                            <a href="logout.php" class="page-scroll text-danger" >Logout</a>
                          </li>
                          ';
                        }
                    }
                    else
                    {
                      ?>
                        <li class="nav-item">
                          <a class="page-scroll" href="login.php">Login</a>
                        </li>
                      </ul>
                      
                        <a href="register.php" class="button button-sm radius-10 d-none d-lg-flex">Get Started</a>
                      <?php
                    }
                ?>

                      
                  </div>
                  <!-- navbar collapse -->
                </nav>
                <!-- navbar -->
              </div>
            </div>
            <!-- row -->
          </div>
          <!-- container -->
        </div>
        <!-- navbar area -->
      </header>
<!-- ========================= Navbar end ========================= -->