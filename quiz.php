<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Quiz | Learning E.R.A</title>
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

        <!-- ========================= hero2-section-wrapper-2 start ========================= -->
        <section id="home" class="hero2-section-wrapper-2">

          <?php
            include "navbar.php";
          ?>

          <section id="quiz" class="quiz-section quiz-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <div class="alert alert-warning text-center" role="alert" id="myAlert">
                              Available quizzes will be seen here.
                            </div>
                        
                            <div class="row">
                              <div class="col-md-1">
                                <a href="profile.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <br>
                              </div>
                              <div class="col-md-11">
                                <h3 class="pb-20"> Quizzes </h3>
                              </div>
                            </div>

                            <?php 
                                // get quizzes by joining table quiz_type and prof_class identifying same subject token  
                                $sql_get_quizzes = "SELECT q.*, c.* FROM quiz_type q JOIN prof_class c ON q.subject_token = c.subject_token WHERE q.publish_stat = 1 
                                and c.student_email='$email' and c.approval= 1 ORDER BY q.quiz_token";
                                $res_get_quizzes = mysqli_query($conn, $sql_get_quizzes);
                                
                                if($res_get_quizzes->num_rows > 0)
                                {
                                  while($row = $res_get_quizzes->fetch_assoc())
                                  {
                                    $prof_name = $row['prof_name'];
                                    $quiz_title = $row['quiz_title'];
                                    $quiz_token = $row['quiz_token'];
                                    $quiz_time = $row['quiz_time'];
                                    $num_ques = $row['num_ques'];
                                    $passing = $row['passing'];
                                    $quiz_description = $row['quiz_description'];
                                    $subject = $row['subject'];
                                    $subject_token = $row['subject_token'];

                                    ?>
                                      <div id="quiz2" class="mb-20">  
                                        <div class="row">
                                          <div class="col-md-2 pt-15">
                                          <?php echo $subject .' | '. $subject_token ?> 
                                            <h4 class="text-dark"> <?php echo $quiz_title ?></h4>
                                          </div>
                                          <div class="col-md-2 pt-25">
                                            <h5><?php echo $quiz_description ?></h5>
                                          </div>
                                          <div class="col-md-2 pt-25">
                                            <p>Duration | <span class="text-danger"><?php echo $quiz_time ?> Minutes </p>
                                            <h6>Passing score : <br> <span class="text-success"><?php echo $passing ?> % </p>
                                          </div>
                                          <div class="col-md-2 pt-20">
                                            <p>Items | <span class="text-primary"><?php echo $num_ques ?></span></p>
                                          </div>
                                          <div class="col-md-2 pt-20">
                                            <p>Prepared by | <br> <span class="text-secondary"><?php echo $prof_name ?></span></p>
                                          </div>
                                          <div class="col-md-2 pt-10">
                                              <!-- check if user already taken the quiz  -->
                                              <?php
                                                $sql_taken_quiz = "select * from quiz_result where student_email = '$email' and quiz_token='$quiz_token' ";
                                                $res_taken_quiz = mysqli_query($conn, $sql_taken_quiz);

                                                if($res_taken_quiz->num_rows > 0)
                                                {
                                                  ?>
                                                    <h6>
                                                      <a href="quiz_result.php?passing=<?php echo $passing?>&num_ques=<?php echo $num_ques?>&quiz_token=<?php echo $quiz_token?>&subject=<?php echo $subject ?>&quiz_title=<?php echo $quiz_title ?>&quiz_description=<?php echo $quiz_description?>&subject_token=<?php echo $subject_token?>" class="btn btn-danger">
                                                        Already Taken
                                                      </a>
                                                    </h6>
                                                  <?php
                                                }
                                                else
                                                {
                                                  ?>
                                                    <h6>
                                                      <a href="take_quiz.php?passing=<?php echo $passing?>&num_ques=<?php echo $num_ques?>&quiz_time=<?php echo $quiz_time?>&subject=<?php echo $subject ?>&quiz_title=<?php echo $quiz_title ?>&quiz_token=<?php echo $quiz_token ?>&subject_token=<?php echo $subject_token?>&quiz_description=<?php echo $quiz_description?>" class="btn btn-primary">
                                                        Take quiz
                                                      </a>
                                                    </h6>
                                                  <?php
                                                }
                                              ?>
                                              
                                          </div>  
                                        </div>
                                      </div>
                                    <?php
                                  }
                                }
                                else
                                {
                                    ?>
                                        <br>
                                        <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Quizzes yet. </h3>
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
