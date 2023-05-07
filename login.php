<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
      include "head_links.php";
    ?>

  </head>
  <body>


    <?php
      session_start();
      include "connect.php";

      //check if user is logged in
      if(isset($_SESSION['user_id']))
      {
        header("Location: 404.php");
      }

      // get email url value 
      if(isset($_GET['email']))
      {
        $email = $_GET['email'];
      }

    ?>

      <?php
        // msg when something happens
        $msg = array();
        
        // <!-- When form is submitted -->
        if(isset($_POST['submit']))
        {
          //POST from Form
          $email = $_POST['email'];
          $password = $_POST['password'];
          
          // Check Credentials if match in the database
          $sql = "select * from users where email='$email' ";
          $res = mysqli_query($conn, $sql);

          //Admin login Credentials
          $sql1 = "select * from admin where email ='$email' and password='$password' ";
          $res1 = mysqli_query($conn, $sql1);

          // Users start here
          if($res->num_rows == 1)
          {
              $row = $res->fetch_assoc();
              $hash = $row['password'];
              $activation = $row['activation'];

              // check if user is already verified first 
              if($activation == 1)
              {
                if(password_verify($password, $hash))
                {
                    $id = $row['id'];
                    // Start the session and allow login
                    $_SESSION['user_id'] = $id;

                    //redirects user to profile
                    header("location: profile.php");
                }
                else
                {
                  $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                              Incorrect credentials, please try again!
                            </div>
                          ';
                }
              }
              else if($activation == 2)
              {
                $msg[] = '<div class="alert alert-danger text-center">
                              Account has been disabled, please contact us here 
                              <span class="text-primary">eduplaymaker@gmail.com</span>
                            </div>
                          ';
              }
              else if($activation == 0)
              {
                $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                              Please Verify your email first!
                            </div>
                          ';
              }

          }
          //Admin start here
          else
          if($res1->num_rows > 0)
          {
              $row = $res1->fetch_assoc();
              $id = $row['id'];
              $_SESSION['admin_id'] = $id;
              header("Location: admin/index.php");
          }
          else
          {
            $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                          Incorrect credentials, please try again!
                      </div>
                    ';
          }
        }
      ?>

    <!-- ========================= hero4-section-wrapper-2 start ========================= -->
    <section id="home" class="hero4-section-wrapper-2">

      <?php
        include "navbar.php";
      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero4-section hero4-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-5">
              <div class="hero4-content-wrapper">
                <form action="" method="POST">
                      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Login</h2>
                      <h5 class="wow fadeInUp" data-wow-delay=".5s">Welcome Back to Learning ERA! </h5>

                        <?php
                          foreach($msg as $msg_item)
                          {
                            echo $msg_item;
                          }
                        ?>

                        <!-- email address and password -->
                        <div class="row">
                          <!-- email  -->
                          <div class="col-md-12 mb-5 wow fadeInUp" data-wow-delay=".8s">
                            <label class="form-label" for="email"><strong>Email Address</strong></label>
                            <input type="email" class="form-control" name="email" <?php echo isset($_GET['email']) ? "value='$email'" : "placeholder='Email address'" ?> required>
                          </div>
                          <!-- password  -->
                          <div class="col-md-12 mb-5 wow fadeInUp" data-wow-delay=".8s">
                            <label class="form-label" for="password"><strong>Password</strong></label>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                          </div>
                          <!-- forget pass modal  -->
                          <div class="col-md-12 mb-5 wow fadeInUp" data-wow-delay=".8s">
                            <a href="forgot_pass.php" class="text-danger">Forgot password?</a>
                          </div>
                        </div>
                        
                        <!-- Submit button here -->
                        <div class="text-center mb-12 pb-30 pt-40 wow fadeInUp" data-wow-delay=".9s">
                            <input type="submit" value="Login" class="btn btn-primary" name="submit">
                        </div>

                        <div class="text-center pb-25 wow fadeInUp" data-wow-delay="1s">
                            <large>Don't have an account yet? <br>
                              <a href="register.php" class="text-primary text-xl font-semibold">Register Here</a>
                            </large>
                        </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- ========================= Home end ========================= -->
        
      <script>
        //Version 2 of Sticky navbar (hero4)
            window.onscroll = function () 
            {
                var header_navbar = document.querySelector(".hero4-section-wrapper-2 .header");
                var sticky = header_navbar.offsetTop;

                if (window.pageYOffset > sticky) {
                    header_navbar.classList.add("sticky");
                } else {
                    header_navbar.classList.remove("sticky");
                }

                // show or hide the back-top-top button
                var backToTo = document.querySelector(".scroll-top");
                if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                    backToTo.style.display = "flex";
                } else {
                    backToTo.style.display = "none";
                }
            };
      </script>
    


    <!-- ========================= FOOTER START ========================= -->
    <?php
      include "footer.php";
      include "preloader.php";
    ?>
    <!-- ========================= FOOTER END ========================= -->
     
    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->
		

    <?php
      include "script_links.php";
    ?>
    
  </body>
</html>
