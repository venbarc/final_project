<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title> Quiz Result | Learning E.R.A</title>
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

          <section id="quiz_result" class="quiz_result-section quiz_result-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                          <?php
                          
                          // get urls to be used to display
                          if(isset($_GET['passing']) && isset($_GET['num_ques']) && isset($_GET['quiz_token']) && isset($_GET['subject']) && isset($_GET['quiz_title']) && isset($_GET['quiz_description']) && isset($_GET['subject_token']))
                          {
                            $quiz_token = $_GET['quiz_token'];
                            $subject= $_GET['subject'];
                            $quiz_title = $_GET['quiz_title'];
                            $quiz_description = $_GET['quiz_description'];
                            $num_ques = $_GET['num_ques'];
                            $passing = $_GET['passing'];
                            $subject_token = $_GET['subject_token'];

                            ?>
                              <div class="row">
                                <div class="col-md-1">
                                  <a href="quiz.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                  <br>
                                </div>
                                <div class="col-md-11">
                                  <h2 class="pb-35">Quiz Result | <?php echo $subject ?></h22>
                                </div>
                              </div>
                            <?php

                            // show result table 
                            $sql_get_result = "select * from quiz_result where student_email='$email' and quiz_token='$quiz_token'";
                            $res_get_result = mysqli_query($conn, $sql_get_result);
                            
                            if($res_get_result->num_rows > 0)
                            {
                              echo'
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col"> Professors Name </th>
                                      <th scope="col"> Quiz Title </th>
                                      <th scope="col"> Quiz Description </th>
                                      <th scope="col"> # Questions </th>
                                      <th scope="col"> # Correct Answers </th>
                                      <th scope="col"> # Wrong Answers </th>
                                      <th scope="col"> Unanswered </th>
                                      <th scope="col"> Added Score </th>
                                      <th scope="col"> Your Score %</th>
                                      <th scope="col"> Passing Score </th>
                                      <th scope="col"> Verdict </th>
                                      <th scope="col"> Date Finished</th>
                                    </tr>
                                  </thead>
                              ';
                              while($row = $res_get_result->fetch_assoc())
                              {
                                $prof_name = $row['prof_name'];
                                $student_email = $row['student_email'];
                                $subject = $row['subject'];
                                $quiz_title = $row['quiz_title'];
                                $quiz_description = $row['quiz_description'];
                                $correct = $row['correct'];
                                $wrong = $row['wrong'];
                                $unanswered = $row['unanswered'];
                                $score = $row['score'];
                                $score_percent = $row['score_percent'];
                                $verdict = $row['verdict'];
                                $date = $row['date'];
                                
                                if($verdict == 'passed')
                                {
                                  $verdict = '<div class="text-success"> <strong> Passed </strong> </div> ';
                                }
                                else{
                                  $verdict = '<div class="text-danger"> <strong> Failed </strong> </div> ';
                                }

                                echo'
                                  <tbody>
                                    <tr>
                                      <td data-label="Professor" class="data">'. $prof_name .'</td>
                                      <td data-label="Quiz Title" class="data">'. $quiz_title .'</td>
                                      <td data-label="Quiz Description" class="data">'. $quiz_description .'</td>
                                      <td data-label="Quiz Description" class="data text-dark"> <strong>'. $num_ques .' </strong></td>
                                      <td data-label="# Correct" class="data text-success"> <strong>'. $correct .'</strong></td>
                                      <td data-label="# Wrong" class="data text-danger"> <strong>'. $wrong .' </strong></td>
                                      <td data-label="# Unanswered" class="data text-secondary"> <strong>'. $unanswered .' </strong></td>
                                      <td data-label="Added Score" class="data text-success"> <strong>+'. $score .'</strong></td>
                                      <td data-label="Your Score %" class="data text-primary"> <strong> Score <br> '. $score_percent .'%</strong></td>
                                      <td data-label="Passing Score" class="data text-primary"> <strong>Passing <br> '. $passing .'%</strong></td>
                                      <td data-label="Verdict" class="data">'. $verdict .'</td>
                                      <td data-label="Date Finished" class="data">'. $date .'</td>
                                    </tr>
                                  <tbody>
                                  ';
                              
                              }
                                echo'
                                  </table>
                                ';
                            }

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
