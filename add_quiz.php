<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Add Quiz | Learning E.R.A</title>
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

          <section id="add_quiz" class="add_quiz-section add_quiz-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <div class="alert alert-warning text-center" role="alert" id="myAlert">
                              Add Subject first to create quiz. If You don't have subject yet <a href="subject_prof.php">click here</a>.
                            </div>
                        
  
                            <div class="row">
                              <div class="col-md-1">
                                <a href="profile.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <br>
                              </div>
                              <div class="col-md-11">
                                <h3 class="pb-20"> Subjects </h3>
                              </div>
                            </div>

                            <?php
                                $prof_email = $user['email']; 

                                //get subject name from db
                                $sql_get_subject = "select * from subject where prof_email='$prof_email' ";
                                $res_get_subject = mysqli_query($conn, $sql_get_subject);
                                $count = 1;

                                if($res_get_subject->num_rows > 0)
                                {
                                  while($row = $res_get_subject->fetch_assoc())
                                  {
                                      $subject = $row['subject'];
                                      $subject_token = $row['subject_token'];

                                      //count all quiz type to specific user (prof)
                                      $sql_count_quiz = "select count(*) from quiz_type where prof_email='$email' and subject_token='$subject_token' ";
                                      $res_count_quiz = mysqli_query($conn, $sql_count_quiz);

                                      if($res_count_quiz)
                                      {
                                        $count_q_type = mysqli_fetch_array($res_count_quiz)[0];
                                      }
                                      else{
                                        $count_q_type = 0;
                                      }

                                      ?>
                                        <div id="add_add_quiz2" class="mb-20">
                                          <div class="row">
                                            <div class="col-md-4 pt-15">
                                              subject # <?php echo $count++ .' | '. $subject_token ?> 
                                              <h4 class="text-dark"> <?php echo $subject ?></h4>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                              <h6><a href="view_add_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>" class="btn btn-primary">View Quiz</a></h6>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                              <h6>Quizzes (<?php echo $count_q_type ?>) </h6>
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
                                        <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
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
