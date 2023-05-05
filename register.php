<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Register | Learning ERA</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
      include "head_links.php";

      // email set up /////////////////////////////////////////////////
      require 'PHPMailer-master/src/PHPMailer.php';
      require 'PHPMailer-master/src/SMTP.php';
      require 'PHPMailer-master/src/Exception.php';
    ?>

  </head>


    <?php
      session_start();
      include "connect.php";

      //check if user is logged in
      if(isset($_SESSION['user_id']))
      {
        header("Location: 404.php");
      }
    ?>

    <!-- ========================= hero3-section-wrapper-2 start ========================= -->
    <section id="home" class="hero3-section-wrapper-2">

      <?php
        include "navbar.php";
      ?>

      <!-- When form is submitted -->
      <?php
        // msg array when something happens
        $msg = array();
        
        if(isset($_POST['submit']))
        {
          //POST from Form
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $full_name = $fname .' '. $lname;

          $email = $_POST['email'];
          $password = $_POST['password'];
          $cpassword = $_POST['cpassword'];
          $gender = $_POST['gender'];
          $user_type = $_POST['user_type'];

          // generate a pin 
          $pin = rand(10000, 90000);

          // hash password 
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $error = false;

          //SMTP settings
          $mail = new PHPMailer\PHPMailer\PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;

          // mails and pass mails 
          $mail->Username = 'eduplaymaker@gmail.com';
          $mail->Password = 'dsgadbydpiddscef';

          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;
          $mail->setFrom('eduplaymaker@gmail.com', 'Learning ERA Verification');
          // users email 
          $mail->addAddress($email);
          $mail->isHTML(true);
          $mail->Subject = 'Verification Pin';
          $mail->Body = '

          <div style="border-radius: 1%; border: 2px solid #007bff; padding: 5%; text-align: center; margin: 0 10%;">
              <h1 style="color: #007bff;"> 
                  Learning ERA Verification 
              </h1> 

              <h2>
                Your verification pin: <br>
                <span style="color: #007bff; text-decoration: underline; font-weight: 600; font-size: 26px;"> '. $pin .'</span> 
              </h2>
          </div>
              
          ';

          // check if email sent 
          if ($mail->send()) 
          {
            // Check if email address already exists in the database
            $sql = "select email from users where email = '$email' ";
            $res = mysqli_query($conn, $sql);

            if($res->num_rows > 0)
            {
              $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                          Email not Available, pls try again!
                        </div>';
              $error = true;
            }
                    
            if($password != $cpassword)
            {
              $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                          Password and Confirm Password does not match!
                        </div>';
              $error = true;
            }
            else
            if($error != true)
            {
              // Insert Data into database
              $sql_insert_user = "insert into users (pin, fname, lname, email, password, gender, user_type) values ('$pin', '$fname', '$lname', '$email', '$hash', '$gender', '$user_type' )";
              $res_insert_user = mysqli_query($conn, $sql_insert_user);

              if($res_insert_user)
              {
                ?>
                  <script>
                    location.href = "verification.php?email=<?php echo $email ?>";
                  </script>
                <?php
              }
            }
          }

        }
      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero3-section hero3-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-5">
              <div class="hero3-content-wrapper">

                  <form action="" method="POST">
                      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Register</h2>
                      <h5 class="wow fadeInUp" data-wow-delay=".5s">Create your account here to join <br> Learning ERA! </h5>

                        <?php
                        foreach($msg as $msg_item)
                        {
                          echo $msg_item;
                        }
                        ?>

                        <div class="row">

                          <!-- First and Last Name -->
                          <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".6s">
                            <label class="form-label" for="email"><strong>First Name</strong></label>
                            <input type="text" class="form-control" placeholder="First Name" name="fname" required>
                          </div>
                          <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".7s">
                            <label class="form-label" for="password"><strong>Last Name</strong></label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
                          </div>

                          <!-- Email Address -->
                          <div class="col-md-12 mb-3 wow fadeInUp" data-wow-delay=".8s">
                            <label class="form-label" for="email"><strong>Email Address</strong></label>
                            <input type="email" class="form-control" placeholder="Email address" name="email" required>
                          </div>
                        
                          <!-- password and confirm password -->
                          <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".8s">
                            <label class="form-label" for="password"><strong>Password</strong></label>
                            <input type="password" class="form-control" placeholder="Password" minlength="6" name="password" required>
                          </div>
                          <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".8s">
                            <label class="form-label" for="cpassword"><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control" placeholder="Confirm Password" minlength="6" name="cpassword" required>
                          </div>
                          
                          <!-- Gender here -->
                            <div class="wrapper radio-center wow fadeInUp" data-wow-delay=".9s">
                              <input type="radio" name="gender" value="Male" id="option-male" required>
                              <input type="radio" name="gender" value="Female" id="option-female" required>
                                <label for="option-male" class="option option-male">
                                  <div class="dot"></div>
                                    <span>Male</span>
                                </label>
                                <label for="option-female" class="option option-female">
                                  <div class="dot"></div>
                                    <span>Female</span>
                                </label>
                            </div>

                          <!-- User Type here -->
                            <div class="wrapper radio-center wow fadeInUp" data-wow-delay=".9s">
                              <input type="radio" name="user_type" value="prof" id="option-prof" required>
                              <input type="radio" name="user_type" value="student" id="option-student" required>
                                <label for="option-prof" class="option option-prof">
                                  <div class="dot"></div>
                                    <span>Professor</span>
                                    </label>
                                <label for="option-student" class="option option-student">
                                  <div class="dot"></div>
                                    <span>Student</span>
                                </label>
                            </div>
                          
                        </div>
                        
                        <!-- Submit button here -->
                        <div class="text-center mb-12 pb-30 pt-30 wow fadeInUp" data-wow-delay="1s">
                            <input type="submit" value="Register" class="btn btn-primary" name="submit">
                        </div>

                        <div class="text-center pb-25 wow fadeInUp" data-wow-delay="1s">
                            <large>Already have an account? <br>
                              <a href="login.php" class="text-primary text-xl font-semibold">Login Here</a>
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

      <!-- Version 2 of Sticky navbar (hero3) -->
      <script>
            window.onscroll = function () 
            {
                var header_navbar = document.querySelector(".hero3-section-wrapper-2 .header");
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
