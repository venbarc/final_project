<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Edit edit_profile | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

   
    <?php
      header("Cache-Control: no-cache, must-revalidate");
      include "head_links.php";
    ?>

  </head>
  <body>


    <?php
      session_start();
      include "connect.php";
    ?>

    

    <?php

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
        $gender = $user['gender'];
        $contact = $user['contact'];
        $address = $user['address'];

        $image_upload = $user['image_upload'];

        $user_type = $user['user_type'];
        $date_reg = $user['date_reg'];

        $you_are = "";

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

        <!-- ========================= hero2-section-wrapper-2 start ========================= -->
        <section id="home" class="hero2-section-wrapper-2">

          <?php
            include "navbar.php";
          ?>

          <!-- ========================= edit_profile start ========================= -->
          <section id="edit_profile" class="edit_profile-section edit_profile-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">
                          
                            <div class="edit-profile-form">

                              <div class="row">
                                <div class="col-md-1">
                                  <a href="profile.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                  <br>
                                </div>
                                <div class="col-md-11">

                              <?php
//===============================================================Start Edit profile=====================================================================//

                                //if submit 1 is posted (Update personal info)
                                  if(isset($_POST['submit1']))
                                  {
                                      $fname = $_POST['fname'];
                                      $lname = $_POST['lname'];
                                      $contact = $_POST['contact'];
                                      $address = $_POST['address'];

                                      $sql_update_personal = "update users set fname='$fname', lname='$lname', contact='$contact', address='$address' where id ='$user_id' ";
                                      $res_update_personal = mysqli_query($conn, $sql_update_personal);

                                      echo '
                                        <div class="alert alert-success text-center" role="alert" id="myAlert">
                                          Successfully Update Personal information.
                                        </div>
                                      ';
                                  }

                                //if submit 2 is posted (Change Email)
                                  if(isset($_POST['submit2']))
                                  {
                                      $new_email = $_POST['new_email'];

                                      $sql_change_email = "select * from users where email='$new_email' ";
                                      $res_change_email = mysqli_query($conn, $sql_change_email);

                                      // if there are existing email
                                      if($res_change_email->num_rows > 0)
                                      {
                                        echo '
                                          <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                            Email address is not available. pls try again!
                                          </div>
                                        ';
                                      }
                                      else
                                      {
                                        $sql_change_email_success = "Update users set email='$new_email' where id='$user_id'";
                                        $res_change_email_success = mysqli_query($conn, $sql_change_email_success);

                                        ?>
                                          <script>
                                            location.href="edit_profile.php";
                                          </script>
                                        <?php
                                      }
                                  }

                                //if submit 3 is posted (Change Password)
                                  if(isset($_POST['submit3']))
                                  {
                                      $current_password = $_POST['current_password'];
                                      
                                      $new_pass = $_POST['new_pass'];
                                      $cnew_pass = $_POST['cnew_pass'];
                                    //pass from database
                                      $password = $user['password'];

                                      //if Current password match database
                                      if(password_verify($current_password, $password ))
                                      {
                                        //if new and current password match
                                        if($new_pass === $cnew_pass)
                                        {
                                          $new_hashed_pass = password_hash($new_pass,PASSWORD_DEFAULT);
                                          $sql_change_pass = "update users set password = '$new_hashed_pass' where id='$user_id' ";
                                          $res_change_pass = mysqli_query($conn, $sql_change_pass);
                                          
                                          echo '
                                            <div class="alert alert-success text-center" role="alert" id="myAlert">
                                              Successfully Update Personal information.
                                            </div>
                                          ';
                                        }
                                        else
                                        {
                                          echo '
                                            <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                              New password and confirm password does not match. pls try again!
                                            </div>
                                          ';
                                        }
                                      }
                                      else
                                      {
                                        echo '
                                            <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                              Current password does not match. pls try again!
                                            </div>
                                          ';
                                      }
                                      
                                  }
//===============================================================End Edit profile=====================================================================//


//============================================================== Start Upload image=====================================================================//
                                  //if upload image is posted
                                    if (isset($_POST['submit_img'])) 
                                    {
                                      
                                      $upload_ext = strtolower(pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION)); // Get the file extension
                                      $upload_name = 'img-' . rand(300000, 800000) . '.' . $upload_ext; // Generate the file name
                                      $upload_file = 'uploads/' . $upload_name; // Combine the folder and name
                                      
                                      if(!in_array($upload_ext, array('jpg', 'jpeg', 'png'))) // Check if the file is a valid image file
                                      {
                                          echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Only JPG, JPEG, and PNG files are allowed.</div>';
                                      }
                                      else
                                      if ($_FILES['upload_file']['size'] > 5000000) // Check if the file is not larger than 5MB
                                      {
                                          echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Maximum file size is 5MB.</div>';
                                      }
                                      else
                                      if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_file)) // Move the temporary uploaded file to the target folder
                                      {
                                          // update image users 
                                          $sql_upload_img = "UPDATE users SET image_upload = '$upload_file' WHERE id='$user_id'";
                                          $res_upload_img = mysqli_query($conn, $sql_upload_img);
                                          // update image prof_class 
                                          $sql_upload_img2 = "UPDATE prof_class SET image_upload = '$upload_file' WHERE student_email='$email'";
                                          $res_upload_img2 = mysqli_query($conn, $sql_upload_img2);

                                          if ($res_upload_img) 
                                          {
                                              ?>
                                                <script>
                                                  location.href = "edit_profile.php";
                                                </script>
                                              <?php
                                          } 
                                          else 
                                          {
                                              echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Something went wrong. Please try again!</div>';
                                          }
                                          mysqli_close($conn);
                                      } 
                                      else 
                                      {
                                          echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Error Occurred. Please try again later!</div>';
                                      }
                                  }
//===============================================================End Upload image=====================================================================//
                              ?>


                                <!-- Start Row for the Update User Personal information -->
                                <div class="row">

                                    <div class="col-md-3 text-center">
                                        <!-- image here -->

                                        <div style="display: flex; justify-content: center; align-items: center;">
                                          <div class="profile-img wow fadeInUp" data-wow-delay=".2s">
                                            
                                            <?php
                                              if(empty($image_upload))
                                              {
                                                ?>
                                                  <img src="assets/img/profile/default-profile.png">
                                                <?php
                                              }
                                              else
                                              {
                                                ?>
                                                  <img src="<?php echo $image_upload ?>">
                                                <?php
                                              }
                                            ?>
                                            
                                            <br><br>
                                            <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto;" data-toggle="modal" data-target="#edit_modal4">
                                              Update Image
                                            </button>
                                          </div>  
                                        </div>

                                    </div>

                                    <div class="padding-edit-profile"></div>

                                    <div class="col-md-9 pl-30">
                                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".3s" style="color:#2F80ED;">Personal Information</h3>
                                        <div class="row">

                                            <p class="text-danger wow fadeInUp" data-wow-delay=".4s">Registered on:<?php echo ' '. $date_reg ?></p> <br> <br>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".4s">
                                                <label class="form-label"><h6> First name</h6></label>
                                                <p><?php echo $fname ?></p> 
                                            </div>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".5s">
                                                <label class="form-label"><h6>Last name</h6></label>
                                                <p><?php echo $lname ?></p> 
                                            </div>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".6s">
                                                <label class="form-label"><h6>Gender</h6></label>
                                                <p><?php echo $gender ?></p> 
                                            </div>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".7s">
                                                <label class="form-label"><h6>User Type</h6></label>
                                                <p><?php echo $you_are ?></p>
                                            </div>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".7s">
                                                <label class="form-label"><h6>Address</h6></label>
                                                <p><?php echo (isset($address) && !empty($address)) ? $address : '<span class="text-danger"> Add Address </span>'; ?></p>
                                            </div>
                                            <div class="col-sm-4 pb-25 wow fadeInUp" data-wow-delay=".7s">
                                                <label class="form-label"><h6>Contact</h6></label>
                                                <p><?php echo (isset($contact) && !empty($contact)) ? $contact : '<span class="text-danger"> Add Contact </span>'; ?></p>
                                            </div>
                                            <div class="col-sm-12 pb-10 wow fadeInUp" data-wow-delay=".8s">
                                                <button type="button" class="btn btn-primary mb-20 wow fadeInUp" data-wow-delay=".8s" data-toggle="modal" data-target="#edit_modal1">
                                                    Update Personal Information
                                                </button>
                                            </div>

                                           <!-- Start for the email and change pass -->
                                            <div class="col-md-12 wow fadeInUp" data-wow-delay=".8s">
                                                <label class="form-label"><h6> Email</h6></label> <br>
                                                <p><?php echo $email ?></p><br>
                                                <!-- <button type="button" class="btn btn-primary wow fadeInUp" data-wow-delay=".9s" data-toggle="modal" data-target="#edit_modal2">
                                                    Change Email
                                                </button> -->
                                                <div class="break" style="display: none"><br></div>
                                                <button type="button" class="btn btn-danger wow fadeInUp" data-wow-delay=".9s" data-toggle="modal" data-target="#edit_modal3">
                                                    Change Password
                                                </button>
                                            </div>

                                        </div>
                                        

                                        
                                    </div>

                                </div>
                                <!-- End Row for the Update User Personal information -->

                                </div>
                            </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

          <!-- Form and Submit buttons are inside modals -->
          <?php
              include "modals.php";
          ?>
          
          </section>
          <!-- ========================= edit_profile end ========================= -->


        </section>
        <!-- ========================= hero2-section-wrapper-2 start ========================= -->

      
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
