<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Profile | Learning ERA</title>
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
        $address = $user['address'];

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

          <section id="profile" class="profile-section profile-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">
                            
                            <div class="row">
                                <div class="col-md-3 text-center;">
                                  <!-- image here -->

                                  <div style="display: flex; justify-content: center; align-items: center;">
                                      <div class="profile-img wow fadeInUp" data-wow-delay=".1s">
                                        
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
                                        <p class="text-primary text-center"> <strong> Registered on : <?php echo $date_reg ?></strong> </p>
                                        <br>
                                       

                                      </div>  
                                  </div>
                                  <br>

                                </div>
                                <div class="col-md-9 pl-30">

                                  <?php
                                    if($gender == 'Male')
                                    {
                                      $sex = 'Mr';
                                    }
                                    else
                                    {
                                      $sex = 'Ms';
                                    }
                                  ?>

                                  <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s" style="color:#2F80ED;">Welcome <?php echo $sex .'. '. $fname .' '. $lname?> </h3>

                                  <div class="row">
                                    <!-- personal info  -->
                                    <div class="col-md-4">
                                      <p class="wow fadeInUp" data-wow-delay=".4s"><?php echo '<strong>Email : </strong> '. $email ?></p> <br>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="wow fadeInUp" data-wow-delay=".4s"><?php echo '<strong>Address : </strong>' . 
                                      (isset($address) && !empty($address) ? $address : '<span class="text-danger">Add address</span>') ?></p> <br>
                                    </div>
                                    <div class="col-md-4">
                                      <p class="wow fadeInUp" data-wow-delay=".4s"><?php echo '<strong>Contact : </strong>' . 
                                      (isset($contact) && !empty($contact) ? $contact : '<span class="text-danger">Add contact</span>') ?></p> <br>
                                    </div>
                                    <!-- edit profile btn  -->
                                    <div class="col-md-4 mb-20">
                                      <a href="edit_profile.php" class="btn btn-primary wow fadeInUp" data-wow-delay=".3s">Edit Personal information</a> 
                                    </div>
                                    <!-- Badges  -->
                                    <div class="col-md-8 mb-20">
                                        <?php
                                          // check if Badges exist in prof_class db 
                                          $stmt_check_badge = $conn->prepare("select * from prof_class where student_email = ? and badges != '' ");
                                          $stmt_check_badge->bind_param('s', $email);
                                          $stmt_check_badge->execute();
                                          $res_check_badge = $stmt_check_badge->get_result();

                                          if($res_check_badge->num_rows > 0)
                                          {
                                            echo' <h5 class="text-primary">Badges</h5> ';
                                            while($row = $res_check_badge->fetch_assoc())
                                            {
                                              $badges = $row['badges'];

                                              if(empty($badges))
                                              {
                                                echo '';
                                              }
                                              else{
                                                echo ' <img src="'.$badges.'" width="60" height="60"> ';
                                              }
                                            }
                                          }
                                          else{
                                            echo' ';
                                          }
                                          $stmt_check_badge->close();
                                          
                                        ?>
                                    </div>
                                  </div>

                                  

                                </div>
                            </div>
                            <br><br>


                              <?php

                                //========================if user is a professor=================================================
                                if($user_type == 'prof')
                                {
                                  ?>
                                    <div class="row">
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".3s">
                                        <a href="add_quiz.php">
                                          <div class="card card-1">
                                            <h4 class="pb-25">Create Quiz</h4>
                                            <p class='text-dark text-'>Create a alluring quiz to make learning fun and productive.</p> <br>
                                            <?php
                                              //Count total Quiz
                                              $sql_count_all_quiz = "select count(*) from quiz_type where prof_email='$email' ";
                                              $res_count_all_quiz = mysqli_query($conn, $sql_count_all_quiz);

                                              if($res_count_all_quiz)
                                              {
                                                $count_quiz = mysqli_fetch_array($res_count_all_quiz)[0];
                                                echo '<h3>'. $count_quiz .'</h3>';
                                              }
                                              else
                                              {
                                                echo '<h3>'. $count_quiz = 0 .'</h3>';
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".4s">
                                        <a href="subject_prof.php">
                                          <div class="card card-2">
                                            <h4 class="pb-25">Classes</h4>
                                            <p class='text-dark text-'>Create Subjects to provide students different quizzes.</p> <br>
                                            <?php
                                              //Count total Subject
                                              $sql_count_subject = "select count(*) from subject where prof_email='$email' ";
                                              $res_count_subject = mysqli_query($conn, $sql_count_subject);

                                              if($res_count_subject)
                                              {
                                                $count_subject = mysqli_fetch_array($res_count_subject)[0];
                                                echo '<h3>'. $count_subject .'</h3>';
                                              }
                                              else
                                              {
                                                echo '<h3>'. $count_subject = 0 .'</h3>';
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".5s">
                                        <a href="history_prof.php">
                                          <div class="card card-3">
                                            <h4 class="pb-25">Quiz History</h4>
                                            <p class='text-dark text-'>Quiz histories of students can be viewed here.</p> <br>
                                            <?php
                                              //Count total history
                                              $sql_count_history = "select count(*) from quiz_result where prof_email='$email' ";
                                              $res_count_history = mysqli_query($conn, $sql_count_history);

                                              if($res_count_history)
                                              {
                                                $count_history = mysqli_fetch_array($res_count_history)[0];
                                                echo '<h3>'. $count_history .'</h3>';
                                              }
                                              else
                                              {
                                                $count_history = 0;
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>

                                    </div>
                                  <?php
                                }
                                //=================if user is a Student=================================================
                                else
                                {
                                  ?>
                                    <div class="row justify-content">
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".3s">
                                        <a href="quiz.php">
                                          <div class="card card-1">
                                            <h3 class="pb-25">Quiz's</h3>
                                            <p class='text-dark text-'>You can view your available quiz here.</p> <br>
                                            <?php
                                              // count quiz available joining table quiz_type and prof_class
                                              $sql_count_quizzes = "SELECT COUNT(*) as count FROM quiz_type q JOIN prof_class c ON q.subject_token = c.subject_token 
                                              WHERE q.publish_stat = 1 and c.student_email='$email' and c.approval= 1 ORDER BY q.quiz_token";
                                              $res_count_quizzes = mysqli_query($conn, $sql_count_quizzes);

                                              if($res_count_quizzes)
                                              {
                                                $count_quiz_avail = mysqli_fetch_array($res_count_quizzes)[0];
                                                echo '<h3>'. $count_quiz_avail .'</h3>';
                                              }
                                              else
                                              {
                                                $count_quiz_avail = 0;
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".4s">
                                        <a href="subject_student.php">
                                          <div class="card card-2">
                                            <h3 class="pb-25">Subjects</h3>
                                            <p class='text-dark text-'>View your professors here.</p> <br>
                                            <?php
                                              //Count total Subject
                                              $sql_count_subject = "select count(*) from prof_class where student_email='$email' ";
                                              $res_count_subject = mysqli_query($conn, $sql_count_subject);

                                              if($res_count_subject)
                                              {
                                                $count_subject = mysqli_fetch_array($res_count_subject)[0];
                                                echo '<h3>'. $count_subject .'</h3>';
                                              }
                                              else
                                              {
                                                $count_subject = 0;
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>
                                      <div class="col-md-4 pb-10 wow fadeInUp" data-wow-delay=".5s">
                                        <a href="history_student.php">
                                          <div class="card card-3">
                                            <h3 class="pb-25">Histories</h3>
                                            <p class='text-dark text-'>View Your subjects here.</p> <br>
                                            <?php
                                              //Count total history
                                              $sql_count_history = "select count(*) from quiz_result where student_email='$email' ";
                                              $res_count_history = mysqli_query($conn, $sql_count_history);

                                              if($res_count_history)
                                              {
                                                $count_history = mysqli_fetch_array($res_count_history)[0];
                                                echo '<h3>'. $count_history .'</h3>';
                                              }
                                              else
                                              {
                                                $count_history = 0;
                                              }
                                            ?>
                                          </div>
                                        </a>
                                      </div>
                                    </div>
                                  <?php
                                }

                              ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form and Submit buttons are inside modals -->
            <?php
                include "modals.php";
            ?>

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

//====================for Copy Link clip board (subject.php)=========================================
            function copyToClipboard(text) 
            {
                var textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                var alert = document.getElementById("myAlert2");
                alert.style.display = "block";
                setTimeout(function()
                {
                    alert.style.display = "none";
                }, 5000); // Hide the alert after 5 seconds
            }

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
