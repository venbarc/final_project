<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Take Quiz | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
   
    <?php
      include "head_links.php";
    ?>

  </head>

  <body onload="timeout()">

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

          <section id="take_quiz" class="take_quiz-section take_quiz-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">                

                            <?php
                                if(isset($_GET['passing']) && isset($_GET['num_ques']) && isset($_GET['quiz_time']) && isset($_GET['quiz_token']) && isset($_GET['subject']) && isset($_GET['quiz_title']) && isset($_GET['quiz_description']) && isset($_GET['subject_token']))
                                {
                                    $quiz_token = $_GET['quiz_token'];
                                    $subject= $_GET['subject'];
                                    $quiz_title = $_GET['quiz_title'];
                                    $quiz_time = $_GET['quiz_time'];
                                    $num_ques = $_GET['num_ques'];
                                    $passing = $_GET['passing'];
                                    $quiz_description = $_GET['quiz_description'];
                                    $subject_token = $_GET['subject_token'];

                                    // check if already taken the quiz and redirect to quiz.php page 
                                    $sql_check_taken_quiz = "select * from quiz_result where student_email ='$email' and quiz_token='$quiz_token' ";
                                    $res_check_taken_quiz = mysqli_query($conn, $sql_check_taken_quiz);

                                    if($res_check_taken_quiz->num_rows > 0)
                                    {
                                      ?>
                                        <script>
                                          location.href = "quiz.php";
                                        </script>
                                      <?php
                                    }

                                    ?>
                                      <h2>
                                        <script type="text/javascript">
                                            var timeLeft=  <?php echo $quiz_time ?>*60;
                                        </script>
                                        <div style="position:sticky;" id="time" class="text-danger">timeout</div>
                                      </h2>
                                    <?php

                                    echo'
                                      <h2 class="pb-20">'.$subject.' | '.$quiz_title.'</h2>
                                    ';

                                    // get quiz question  
                                    $sql_get_quiz_ques = "select * from quiz_display where quiz_token ='$quiz_token' limit $num_ques";
                                    $res_get_quiz_ques = mysqli_query($conn, $sql_get_quiz_ques);
                                    $count_ques = 1;

                                    if($res_get_quiz_ques->num_rows > 0)  
                                    {
                                      ?> 

                                        <form method="post">

                                        <!-- buttons for previous and next and submit button================================================ -->
                                          <div class="row">
                                            <div class="col-md-6">
                                                <button type="button" id="prev" class="btn btn-primary">Previous</button>
                                                <button type="button" id="next" class="btn btn-primary">Next</button>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="submit-container" style="display:none; text-align: center;">
                                                  <button type="submit" id="submit_id" name="submit_quiz" class="btn btn-primary">
                                                    <h4 class="text-white"> Submit Quiz </h4>
                                                  </button>
                                                </div>
                                            </div>
                                          </div>
                                          <br><br>
                                          
                                          <!-- script for timer ============================================================= -->
                                          <script>
                                              function timeout() {
                                                var minutes = Math.floor(timeLeft / 60);
                                                var seconds = timeLeft % 60;
                                                var mins = checktime(minutes);
                                                var secs = checktime(seconds);

                                                if (timeLeft <= 0) {
                                                    clearTimeout(tm);
                                                    document.getElementById("submit_id").click();
                                                } else {
                                                    document.getElementById("time").innerHTML = mins + ":" + secs;
                                                }
                                                timeLeft--;
                                                var tm = setTimeout(function () { timeout() }, 1000);
                                            }

                                            function checktime(msg) {
                                                if (msg < 10) {
                                                    msg = "0" + msg;
                                                }
                                                return msg;
                                            }
                                            timeout();

                                          </script>
                                         
                                          <!-- wrap thw whole while to display question one by one on the same position -->
                                          <div id="question-container">
                                      <?php

                                            $rows = array();
                                            while ($row = $res_get_quiz_ques->fetch_assoc()) {
                                                $rows[] = $row;
                                            }
                                            
                                            // Durstenfeld shuffle algorithm ========================================== --->
                                            $n = count($rows);
                                            for ($i = $n - 1; $i >= 1; $i--) 
                                            {
                                                $j = mt_rand(0, $i);
                                                $temp = $rows[$i];
                                                $rows[$i] = $rows[$j];
                                                $rows[$j] = $temp;
                                            }
                                            foreach ($rows as $row) 
                                            {
                                              $question = $row['question'];
                                              $opt1 = $row['opt1'];
                                              $opt2 = $row['opt2'];
                                              $opt3 = $row['opt3'];
                                              $opt4 = $row['opt4'];
                                              $answer = $row['answer'];
                                              $image = $row['image'];

                                              // Get the tools 
                                              $text_tool = $row['text_tool'];
                                              $color_tool = $row['color_tool'];
                                              $img_tool = $row['img_tool'];
                                              
                                              ?>
                                                <!-- add question in row to display question one by one  -->
                                                <div class="row question">
                                                  <!-- question  -->
                                                  <div class="col-md-12 pb-25">
                                                    <?php echo '<'.$text_tool.' style=color:'.$color_tool.' >'.$count_ques++ .'. ) '. $question .'</'.$text_tool.'>'?>
                                                    <!-- image  -->
                                                    <?php 
                                                      if(empty($image))
                                                      {
                                                        $image = "";
                                                      }
                                                      else
                                                      {
                                                        echo'
                                                          <img src="'.$image.'" height='.$img_tool.' width='.$img_tool.'>
                                                        ';
                                                      }
                                                     
                                                    ?>
                                                  </div>

                                                  <?php
                                                   // shuffled options -->
                                                   $options = array($opt1, $opt2, $opt3, $opt4);
                                                   shuffle($options);
                                                  ?>
                                                  <!-- options  -->
                                                  <div class="col-md-6">
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input" name="answer[<?php echo $row['quiz_id'] ?>]" value="<?php echo $options[0] ?>">
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><h6>A.) <?php echo $options[0] ?> </h6></div>
                                                    </label>

                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input" name="answer[<?php echo $row['quiz_id'] ?>]" value="<?php echo $options[1] ?>">
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><h6>B.) <?php echo $options[1] ?> </h6></div>
                                                    </label>

                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input" name="answer[<?php echo $row['quiz_id'] ?>]" value="<?php echo $options[2] ?>">
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><h6>C.) <?php echo $options[2] ?> </h6></div>
                                                    </label>

                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input" name="answer[<?php echo $row['quiz_id'] ?>]" value="<?php echo $options[3] ?>">
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><h6>D.) <?php echo $options[3] ?> </h6></div>
                                                    </label>

                                                    <!-- default answer -->
                                                    <input type="radio" name="answer[<?php echo $row['quiz_id'] ?>]" value="default_answer" checked style="display:none;">
                                                  </div>

                                                </div>

                                              <?php
                                              
                                            }
                                      ?>
                                            </div>
                                        </form>
                                      <?php

                                      ?>

                                      <!-- style and script for next and previous ======================================  -->
                                      <style>
                                          #question-container {
                                              position: relative;
                                              height: 100%;
                                          }

                                          .question {
                                              position: absolute;
                                              top: 0;
                                              left: 0;
                                              width: 100%;
                                              height: 100%;
                                              display: none;
                                          }

                                          .question:first-child {
                                              display: block;
                                          }
                                      </style>
                                      <script>
                                          var currentQuestion = 1;
                                          var numQuestions = <?php echo $count_ques-1; ?>; // number of questions, excluding the submit button

                                          document.getElementById("next").addEventListener("click", function() {
                                              if (currentQuestion < numQuestions) {
                                                  document.querySelector(".question:nth-of-type(" + currentQuestion + ")").style.display = "none";
                                                  currentQuestion++;
                                                  document.querySelector(".question:nth-of-type(" + currentQuestion + ")").style.display = "block";
                                              }
                                              if (currentQuestion == numQuestions) {
                                                  document.getElementById("submit-container").style.display = "block";
                                              }
                                          });

                                          document.getElementById("prev").addEventListener("click", function() {
                                              if (currentQuestion > 1) {
                                                  document.querySelector(".question:nth-of-type(" + currentQuestion + ")").style.display = "none";
                                                  currentQuestion--;
                                                  document.querySelector(".question:nth-of-type(" + currentQuestion + ")").style.display = "block";
                                              }
                                              if (currentQuestion < numQuestions) {
                                                  document.getElementById("submit-container").style.display = "none";
                                              }
                                          });

                                      </script>
                                      
                                      <?php

                                    }
                                    
                                    // get professors name and email
                                    $prof_prof_details = "select * from prof_class where subject_token='$subject_token' ";
                                    $res_prof_details = mysqli_query($conn, $prof_prof_details);
                                    $row_pd = mysqli_fetch_assoc($res_prof_details);
                                    $prof_name = $row_pd['prof_name'];
                                    $prof_email = $row_pd['prof_email'];  

                                    // if form is submitted 
                                    if(isset($_POST['submit_quiz']))
                                    {
                                      // initializations 
                                      $score = 0; 
                                      $correct = 0; 
                                      $wrong = 0;
                                      $unanswered = 0;
                                      $incorrect_questions = array(); // create an array to store the incorrect questions

                                      // users answer in form (take_quiz.php)
                                      $answer = $_POST['answer'];

                                      foreach($answer as $question_id => $answer)
                                      {

                                        $sql_get_answer = "select * from quiz_display where quiz_id='$question_id' ";
                                        $res_get_answer = mysqli_query($conn, $sql_get_answer);
                                        $row = mysqli_fetch_assoc($res_get_answer);

                                        // answer from db 
                                        $correct_answer = $row['answer'];

                                        if($answer == 'default_answer') // check if the user did not answer and set a default answer 
                                        {
                                          $unanswered ++ ;
                                        }
                                        else
                                        if($answer == $correct_answer) //check if user answer match the correct answer in db
                                        {
                                          $correct ++;
                                          // increment the Correct count for the question in the database
                                          $sql_increment_count = "update quiz_display set correct_count = correct_count + 1 where quiz_id = '$question_id'";
                                          mysqli_query($conn, $sql_increment_count);
                                        }
                                        else
                                        {
                                          $wrong++;
                                          // increment the incorrect count for the question in the database
                                          $sql_increment_count = "update quiz_display set incorrect_count = incorrect_count + 1 where quiz_id = '$question_id'";
                                          mysqli_query($conn, $sql_increment_count);
                                        }
                                        
                                        if($correct == 0 && $wrong == 0)
                                        {
                                          $verdict = "-";
                                          $passing = 0;
                                        }
                                        else
                                        {
                                          $total_questions = $correct + $wrong + $unanswered;
                                          $score_percentage = ($correct / $total_questions) * 100;

                                          if($score_percentage >= $passing)
                                          {
                                            $verdict = "passed";
                                          }
                                          else{
                                            $verdict = "failed";
                                          }
                                        }
                                        
                                      }
                                      $score = $correct * 100;

                                      // insert data in quiz result 
                                      $sql_insert_result = "insert into quiz_result (prof_email, prof_name, student_email, subject_token, subject, quiz_title, quiz_description, num_ques, quiz_token, correct, wrong, unanswered, score, score_percent, passing, verdict) 
                                      values ('$prof_email','$prof_name','$email','$subject_token','$subject','$quiz_title','$quiz_description','$num_ques', '$quiz_token','$correct','$wrong','$unanswered','$score','$score_percentage','$passing','$verdict') ";
                                      $res_insert_result = mysqli_query($conn, $sql_insert_result);

                                      //update score in prof_class db increment score each correct answer 
                                      $sql_add_score = "update prof_class set score = score + '$score' where student_email='$email' and subject_token = '$subject_token' ";
                                      mysqli_query($conn, $sql_add_score);

                                      if($res_insert_result)
                                      {
                                      ?>
                                        <script>
                                          location.href = "quiz_result.php?passing=<?php echo $passing?>&num_ques=<?php echo $num_ques ?>&quiz_token=<?php echo $quiz_token?>&subject=<?php echo $subject?>&quiz_title=<?php echo $quiz_title?>&quiz_description=<?php echo $quiz_description?>&subject_token=<?php echo $subject_token?>";
                                        </script>
                                      <?php
                                      }

                                      
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
