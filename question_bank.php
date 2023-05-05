<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Question banks | Learning ERA</title>
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

          <section id="question" class="question-section question-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">
                            

                            <?php

                                $prof_email = $user['email']; 

                                //if delete is pressed
                                if(isset($_GET['id']))
                                {
                                  $id = $_GET['id'];
                                  $subject_token = $_GET['subject_token'];

                                  $sql_delete_section = "delete from subject where prof_email='$prof_email' and id='$id' ";
                                  $res_delete_section = mysqli_query($conn, $sql_delete_section);

                                  if($res_delete_section)
                                  {
                                    $sql_delete_quiz = "delete from quiz where prof_email='$prof_email' and subject_token='$subject_token'";
                                    $res_delete_quiz = mysqli_query($conn, $sql_delete_quiz);

                                  ?>
                                    <script>
                                      location.href = "question_bank.php";
                                    </script>
                                  <?php
                                  }
                                  else
                                  {
                                    echo '
                                    <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                     Something went wrong. pls try again!
                                    </div>
                                    ';
                                  }
                                }

                                ?>
                                  <div class="row">
                                    <div class="col-md-1">
                                      <a href="create_quiz.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                      <br>
                                    </div>
                                    <div class="col-md-11">
                                      <h2>Question Bank</h2>
                                    </div>
                                  </div>
                                <?php

                                //get subject name from db
                                $sql_get_section = "select * from subject where prof_email='$prof_email' ";
                                $res_get_section = mysqli_query($conn, $sql_get_section);
                                $count = 1;

                                if($res_get_section->num_rows > 0)
                                {
                                  while($row = $res_get_section->fetch_assoc())
                                  {
                                      $subject = $row['subject'];
                                      $subject_token = $row['subject_token'];

                                      //count all questions in quiz to specific user (prof)
                                      $sql_count_quiz = "Select count(*) from quiz where  subject_token='$subject_token' and prof_email='$email'";
                                      $res_count_quiz = mysqli_query($conn, $sql_count_quiz);
                                      if($res_count_quiz)
                                      {
                                          $count_quiz = mysqli_fetch_array($res_count_quiz)[0];
                                      }

                                      ?>
                                        <div id="add_question2" class="mb-20">
                                          <div class="row">
                                            <div class="col-md-6">
                                              Question Bank # <?php echo $count++ ?> <h4 class="text-dark"> 
                                                <?php echo $subject ?></h4>
                                            </div>
                                            <div class="col-md-2">
                                              <h6><a href="view_quiz.php?subject=<?php echo $row['subject'] .'&subject_token='. $row['subject_token'] ?>" class="text-primary">Manage</a></h6>
                                            </div>
                                            <div class="col-md-2">
                                              <h6><a href="question_bank.php?id=<?php echo $row['id'] .'&subject_token='. $subject_token ?>" class="text-danger">Delete</a></h6>
                                            </div>
                                            <div class="col-md-2">
                                              <h6>Questions (<?php echo $count_quiz ?>) </h6>
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
