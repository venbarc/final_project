<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Feedback | Learning E.R.A</title>
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
    ?>

    <!-- ========================= hero2-section-wrapper-2 start ========================= -->
    <section id="home" class="hero2-section-wrapper-2">

      <?php
        include "navbar.php";

        // check if user is logged in
        if(isset($_SESSION['user_id']))
        {
          // get users data
          $user_id = $_SESSION['user_id'];
          $sql = "select * from users where id ='$user_id' ";
          $res = mysqli_query($conn, $sql);
          $user = mysqli_fetch_assoc($res);

          $email = $user['email'];
          $fname = $user['fname'];
          $lname = $user['lname'];
          $full_name = $fname .' '. $lname;

          $lname = $user['lname'];
          $gender = $user['gender'];
          $contact = $user['contact'];
          $address = $user['address'];

          $image_upload = $user['image_upload'];

          $user_type = $user['user_type'];
          $date_reg = $user['date_reg'];
          
          $you_are = "";

          // check user type
          if($user_type == 'prof')
          {
              $you_are = "Professor";
          }
          else
          {
              $you_are = "Student";
          }
        }
        else
        {
          header("Location: login.php");
        }

      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero2-section hero2-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-12">
              <div class="hero2-content-wrapper">

                <div class="row wow fadeInUp" data-wow-delay=".8s">
                  <?php
                    if(isset($_GET['id']))
                    {
                      $id = $_GET['id'];

                      $stmt_feedback = $conn->prepare("select * from concerns where id='$id' ");
                      $stmt_feedback->execute();
                      $res_feedback = $stmt_feedback->get_result();

                      if($res_feedback->num_rows > 0)
                      {
                        while($row = $res_feedback->fetch_assoc())
                        {
                          $concern_title = $row['concern_title'];
                          $concern_msg = $row['concern_msg'];
                          $date = $row['date'];
                          $admin_feedback = $row['admin_feedback'];

                          if(empty($admin_feedback))
                          {

                            echo '
                            <div class="row">
                              <div class="col-md-7">
                                <a href="help_center.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <h6 class="text-danger">'. $date .'</h6>
                                <h3>Concern Subject : <span class="text-danger"> '.$concern_title.' </span> </h3>
                                <p>
                                    '.$concern_msg.'
                                </p>
                                <h4 class="text-primary pt-5">No feedback yet.</h4> 
                              </div>
                              <div class="col-md-5">
                                <img src="assets/img/help/help.png" class="responsive-img">
                              </div>
                            </div>
                            ';  
                          }
                          else{
                            echo'
                            <div class="row">
                              <div class="col-md-7">
                                <a href="help_center.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <h6 class="text-danger">'. $date .'</h6>
                                <h3>Concern Subject : <span class="text-danger"> '.$concern_title.' </span> </h3>
                                <p>
                                    '.$concern_msg.'
                                </p>
                                <h4 class="text-primary mt-5">Learning ERA Team feedback :</h4> 
                                <p class="pt-2" style="text-align: justify">
                                    '.$admin_feedback.'
                                </p>
                              </div>
                              <div class="col-md-5">
                                <img src="assets/img/help/help.png" class="responsive-img">
                              </div>
                            </div>
                            
                            ';
                          }
                        }
                      }
                    }
                  ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- ========================= Home end ========================= -->

      <script>
      //Version 2 of Sticky navbar (hero2)
            window.onscroll = function () 
            {
                var header_navbar = document.querySelector(".hero2-section-wrapper-2 .header");
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
