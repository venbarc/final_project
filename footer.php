
<!-- ========================= footer style-1 start ========================= -->
    <footer class="footer footer-style-1">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-lg-4">
              <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                <div class="logo">
                  <a href="#home"> LOGO HERE</a>
                </div>
                <p class="desc">Learning ERA socials and contacts are here.</p>
                <ul class="socials">
                  <li> <a href="#0"> <i class="lni lni-facebook-filled"></i> </a> </li>
                  <li> <a href="#0"> <i class="lni lni-instagram-filled"></i> </a> </li>
                  <li> <a href="#0"> <i class="fab fa-google"></i> </a> </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="footer-widget wow fadeInUp" data-wow-delay=".3s">
                <h6>Quick Link</h6>
                <ul class="links">
                  <li> <a href="index.php#home">Home</a> </li>
                  <li> <a href="index.php#features">Features</a> </li>
                  <li> <a href="index.php#goal">Goal</a> </li>
                  <li> <a href="index.php#team">Team</a> </li>
                  
                </ul>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="footer-widget wow fadeInUp" data-wow-delay=".4s">
                <h6>Terms Of Services</h6>
                <ul class="links">
                  <li> <a href="tos.php">Terms And Condition</a> </li>
                  <li> <a href="privacypolicy.php">Privacy And Policy</a> </li>
                  <li> <a href="help_center.php">Help Center</a> </li>

                  <?php
                    if(isset($_SESSION['user_id']))
                    {
                      ?>
                        <li> <a class="text-danger" href="logout.php">Logout</a> </li>
                      <?php
                    }
                    else
                    {
                      ?>
                        <li> <a class="text-primary" href="Login.php">Login</a> </li>
                        <li> <a class="text-primary" href="register.php">Register</a> </li>
                      <?php
                    }
                  ?>
                  
                </ul>
              </div>
            </div>
            
          </div>
        </div>
        <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
          <p>@Copyright Learning ERA 2023</p>
        </div>
      </div>
    </footer>
    <!-- ========================= footer style-1 end ========================= -->