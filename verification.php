<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title> Verification | Learning ERA</title>
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
        header("Location: 404.php");
      }
    ?>

    <!-- ========================= hero3-section-wrapper-2 start ========================= -->
    <section id="home" class="hero3-section-wrapper-2">

      <?php
        include "navbar.php";
                    
        // msg array when something happens
        $msg = array();

        // get email in url  
        if(isset($_GET['email']))
        {
            $email = $_GET['email'];
        }
        
        // when pin is submitted 
        if(isset($_POST['submit']))
        {
            // posted pin
            $pin = $_POST['pin'];

            $stmt = $conn->prepare("select * from users where email = ? ");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $res = $stmt->get_result();

            //get pin of that specific email in db
            $row = mysqli_fetch_assoc($res);
            $pin_db = $row['pin'];

            if($res->num_rows > 0)
            {
                if($pin_db == $pin)
                {
                    $stmt = $conn->prepare("update users set activation = 1 where email = ?");
                    $stmt->bind_param('s', $email);
                    $stmt->execute();

                    if($stmt->affected_rows > 0)
                    {
                        $msg[] = '<div class="alert alert-success text-center">
                          Successfully Verified your email proceed  
                          <a href="login.php?email='.$email.'" class="text-primary">Login here</a>
                        </div>';
                    }
                    else{
                        $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                          Something went wrong, please try again.
                        </div>';
                    }
                }
                else{
                    $msg[] = '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                          Verification Pin does not match! please check you email.
                        </div>';
                }            
            }
            $stmt->close();

        }
      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero3-section hero3-style-2" id="verification">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-5">
              <div class="hero3-content-wrapper">

                <?php
                    foreach($msg as $msg_item)
                    {
                    echo $msg_item;
                    }
                ?>
                
                  <form action="" method="POST">
                      <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Verification</h2>
                      <h6 class="wow fadeInUp mb-3" data-wow-delay=".5s">
                        We have sent your Verification pin at  
                        <span class="text-primary"><?php echo $email ?></span> 
                      </h6>

                        <?php

                            $stmt = $conn->prepare("select * from users where email = ?");
                            $stmt->bind_param('s', $email);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $row = mysqli_fetch_assoc($res);

                            $activation = $row['activation'];

                            if($activation == 1)
                            {
                                echo '
                                <h3 class="text-success">Verified Successfully</h3>
                                ';
                            }
                            else{
                                ?>
                                    <div class="row">
                                    <!-- pin -->
                                        <div class="col-md-12 mb-3 wow fadeInUp" data-wow-delay=".6s">
                                            <label class="form-label" for="pin"><strong>Verification Pin here:</strong></label>
                                            <input type="text" class="verification_field" name="pin" maxlength="5" required>
                                        </div>
                                    </div>
                                    <!-- Submit button here -->
                                    <div class="text-center mb-12 pb-30 pt-30 wow fadeInUp" data-wow-delay="1s">
                                        <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                                    </div>
                                <?php
                            }

                            $stmt->close();
                        
                        ?>

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
