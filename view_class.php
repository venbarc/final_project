<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>View Class | Learning E.R.A</title>
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
        $full_name = $fname .' '. $lname;

        $lname = $user['lname'];
        $gender = $user['gender'];
        $contact = $user['contact'];
        $special = $user['special'];

        $image_upload = $user['image_upload'];

        $user_type = $user['user_type'];
        $date_reg = $user['date_reg'];
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

          <section id="view_class" class="view_class-section view_class-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                        <br>
                            <?php
                              if(isset($_GET['subject']) && isset($_GET['subject_token']))
                              {
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];

                                //get your email to highlight you in view class 
                                $sql_get_profile = "select * from prof_class where student_email='$email'";
                                $res_get_profile = mysqli_query($conn, $sql_get_profile);

                                // get professors name 
                                $prof_prof_details = "select * from prof_class where subject_token='$subject_token' ";
                                $res_prof_details = mysqli_query($conn, $prof_prof_details);
                                $row_pd = mysqli_fetch_assoc($res_prof_details);
                                $prof_name = $row_pd['prof_name'];

                                echo'
                                <div class="row">
                                  <div class="col-md-1">
                                    <a href="subject_student.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                  </div>
                                  <div class="col-md-5">
                                    <h2 class="pb-20">'. $subject .' Class</h2>
                                  </div>
                                  <div class="col-md-6">
                                    <h5 class="pb-20"> Prof. '. $prof_name .' | <span class="text-primary"> '.$subject_token .' </span></h5>
                                  </div>
                              
                                </div>
                                ';

                                // get classmates 
                                $sql_classmates = "select * from prof_class where subject='$subject' and subject_token='$subject_token' order by score desc";
                                $res_classmates = mysqli_query($conn, $sql_classmates);
                                
                                $count = 1;
                                if($res_classmates->num_rows > 0)
                                {
                                  echo'

                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col"> # </th>
                                          <th scope="col"> Profile </th>
                                          <th scope="col"> Email </th>
                                          <th scope="col"> First Name </th>
                                          <th scope="col"> Last Name </th>
                                          <th scope="col"> Gender </th>
                                          <th scope="col"> Score </th>
                                          <th scope="col"> Badges </th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        ';
                                      while($row = $res_classmates->fetch_assoc())
                                      {
                                        $image_upload = $row['image_upload'];
                                        $student_email = $row['student_email'];
                                        $student_fname = $row['student_fname'];
                                        $student_lname = $row['student_lname'];
                                        $student_gender = $row['student_gender'];
                                        $score = $row['score'];
                                        // badges variables 
                                        $badge = ''; 
                                        $g_badges = 'assets/img/badges/gold.png';
                                        $s_badges = 'assets/img/badges/silver.png';
                                        $b_badges = 'assets/img/badges/bronze.png';

                                        //=========================================================================
                                        //== Score and badges functions
                                        if($score == 0)
                                        {
                                          $score = 0;
                                        }
                                        else{
                                          $score = $row['score'];

                                          if($count == 1)
                                          {
                                            $stmt_badges = $conn->prepare("update prof_class set badges = ? where student_email= ? and subject_token = ? ");
                                            $stmt_badges->bind_param('sss', $g_badges, $student_email, $subject_token);
                                            $stmt_badges->execute();
                                            $stmt_badges->close();
                                            $badge = ' <img src="'.$g_badges.'" class="data_badge"> ';
                                          }
                                          else
                                          if($count == 2)
                                          {
                                            $stmt_badges = $conn->prepare("update prof_class set badges = ? where student_email= ? and subject_token = ? ");
                                            $stmt_badges->bind_param('sss', $s_badges, $student_email, $subject_token);
                                            $stmt_badges->execute();
                                            $stmt_badges->close();
                                            $badge = ' <img src="'.$s_badges.'" class="data_badge"> ';
                                          }
                                          else
                                          if($count == 3)
                                          {
                                            $stmt_badges = $conn->prepare("update prof_class set badges = ? where student_email= ? and subject_token = ? ");
                                            $stmt_badges->bind_param('sss', $b_badges, $student_email, $subject_token);
                                            $stmt_badges->execute();
                                            $stmt_badges->close();
                                            $badge = ' <img src="'.$b_badges.'" class="data_badge"> ';
                                          }
                                          else
                                          {
                                            $badge = ' ';
                                            $stmt_badges = $conn->prepare("update prof_class set badges = ? where student_email= ? and subject_token = ? ");
                                            $stmt_badges->bind_param('sss', $badge, $student_email, $subject_token);
                                            $stmt_badges->execute();
                                            $stmt_badges->close();
                                          }

                                        }
                                        //=========================================================================
                                       
                                        
                                        if($student_email == $email)
                                        {
                                          echo'
                                            <tr class="text-white" style="background: #2F80ED;">
                                              <td data-label="Email" class="data">'. $count++ .'</td>
                                              <td data-label="Profile" class="img">
                                                ';
                                                  if(empty($image_upload))
                                                  {
                                                    echo'
                                                      <img src="assets/img/profile/default-profile.png" class="view_class_img_you">
                                                    ';
                                                  }
                                                  else
                                                  {
                                                    echo'
                                                      <img src="'.$image_upload.'" class="view_class_img_you">
                                                    ';
                                                  }
                                               echo'
                                              </td>
                                              <td data-label="Email" class="data">'. $student_email .'</td>
                                              <td data-label="First Name" class="data">'. $student_fname .'</td>
                                              <td data-label="Last Name" class="data">'. $student_lname .'</td>
                                              <td data-label="Gender" class="data">'. $student_gender .'</td>
                                              <td data-label="Score" class="data">'. $score .'</td>
                                              <td data-label="Badge" class="data_badge">'. $badge .'</td>
                                            </tr>
                                            ';
                                        }
                                        else
                                        {
                                          echo'
                                              <tr>
                                                <td data-label="Email" class="data">'. $count++ .'</td>
                                                <td data-label="Profile" class="img">
                                                  ';
                                                      if(empty($image_upload))
                                                      {
                                                        echo'
                                                          <img src="assets/img/profile/default-profile.png" class="view_class_img_you">
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        echo'
                                                          <img src="'.$image_upload.'" class="view_class_img_you">
                                                        ';
                                                      }
                                                  echo'
                                                </td>
                                                <td data-label="Email" class="data">'. $student_email .'</td>
                                                <td data-label="First Name" class="data">'. $student_fname .'</td>
                                                <td data-label="Last Name" class="data">'. $student_lname .'</td>
                                                <td data-label="Gender" class="data">'. $student_gender .'</td>
                                                <td data-label="Score" class="data">'. $score .'</td>
                                                <td data-label="Badge" class="data_badge">'. $badge .'</td>
                                              </tr>
                                          ';
                                        }

                                        
                                      }
                                        
                                    echo '
                                    </tbody>
                                    </table>';
                                }
                                else
                                {
                                  ?>
                                    <br>
                                    <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                                  <?php
                                }

                              }


                              
                            ?>

                            
                          
                        </div>
                    </div>
                </div>
            </div>

          </section>

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
