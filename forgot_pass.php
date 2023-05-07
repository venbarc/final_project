<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Forgot password | Learning E.R.A</title>
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
  <body>


    <?php
      session_start();
      include "connect.php";

      //check if user is logged in
      if(isset($_SESSION['user_id']))
      {
        ?>
          <script>
            location.href = "404.php";
          </script>
        <?php
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
                      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Forgot Password</h2>
                      <!-- Change title  -->
                      <?php 
                        if(isset($_POST['submit_forgot_pass']))
                        {
                          $email = $_POST['email'];
                          echo'
                            <a href="login.php?email='.$email.'">
                              <h6>Check your email and <span class="text-primary">Login here</span></h6>
                            </a>
                            <br>
                          ';
                        }
                        else{
                          echo'
                            <h5 class="wow fadeInUp" data-wow-delay=".5s" id="display">Enter your Email</h5>
                          ';
                        }
                      ?>
                        <?php
                          // <!-- When form is submitted -->
                          if(isset($_POST['submit_forgot_pass']))
                          {
                            // initialization 
                            $email = $_POST['email'];

                            // generate random strings and numbers for password 
                            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $new_pass = substr(str_shuffle($chars), 0, 12);

                            // hash the password 
                            $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);

                            // check if the email exist in the database 
                            $stmt = $conn->prepare("select * from users where email = ?");
                            $stmt->bind_param('s', $email);
                            $stmt->execute();
                            $res = $stmt->get_result();

                            if($res->num_rows > 0) //if there are result
                            {
                              // update password of specific user 
                              $stmt = $conn->prepare("update users set password = ? where email = ?");
                              $stmt->bind_param('ss', $hash_pass, $email);
                              $stmt->execute();
                              
                              if($stmt->affected_rows > 0)
                              {
                                //SMTP settings
                                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;

                                // mails and pass mails 
                                $mail->Username = 'eduplaymaker@gmail.com';
                                $mail->Password = 'eitilzvungtklpdy';

                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                                $mail->setFrom('eduplaymaker@gmail.com', 'Learning ERA New Password');
                                // users email 
                                $mail->addAddress($email);
                                $mail->isHTML(true);
                                $mail->Subject = 'Forgot Password';
                                $mail->Body = '
                                <div style="border-radius: 1%; border: 3px dashed #dc3545 ; padding: 5%; text-align: left; margin: 0 10%;">
                                    <h3 style="color: #dc3545;"> 
                                        Learning ERA New Password 
                                    </h3> 
                                    <h4>
                                      Your new password : <br>
                                      <span style="color: #007bff; text-decoration: underline; font-weight: 600; font-size: 20px;"> 
                                      '. $new_pass .'
                                      </span> 
                                    </h4>
                                    <p style="color: #dc3545; margin-top:3%">
                                      <strong>Note: </strong>
                                      It is recommended to change your password after logging in the new credentials,
                                      Please do not share this to anyone else for your account security. 
                                    </p>
                                </div>
                                ';
                                
                                if($mail->send())
                                {
                                  echo'
                                  <div class="alert alert-success text-center">
                                    We have sent a email to <span class="text-primary">'.$email.'</span> kindly verify check it.
                                  </div>
                                  ';
                                }
                               
                              }
                             
                            }
                            else{
                              echo'
                                  <div class="alert alert-danger text-center">
                                    Email does not exist in or database, please try again.
                                  </div>
                                  ';
                            }

                          }
                          else{
                            ?>
                              <!-- email address and password -->
                              <div class="row">
                                  <!-- email  -->
                                  <div class="col-md-12 wow fadeInUp" data-wow-delay=".8s">
                                      <input type="email" name="email" class="form-control" placeholder="Email here..." required>
                                  </div>
                                  <!-- Submit button here -->
                                  <div class="text-center mb-12 pb-30 pt-40 wow fadeInUp" data-wow-delay=".9s">
                                      <input type="submit" value="Submit" class="btn btn-primary" name="submit_forgot_pass">
                                  </div>
                              </div>
                            <?php
                          }
                        ?>
                        
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
