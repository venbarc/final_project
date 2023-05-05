<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>History student | Learning E.R.A</title>
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

          <section id="history_student" class="history_student-section history_student-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <div class="row">
                              <div class="col-md-1">
                                <a href="profile.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <br>
                              </div>
                              <div class="col-md-11">
                                <h3 class="pb-50"> Quizzes History</h3>
                              </div>
                            </div>

                            <?php
                                // get the quiz history in quiz_result db with search
                                if (isset($_POST['search_btn'])) 
                                {
                                  $search_query = $_POST['search_query'];
                                  $sql_get_history = "select * from quiz_result where student_email='$email'
                                  AND (prof_name like '%$search_query%' 
                                  OR subject LIKE '%$search_query%' 
                                  OR quiz_title LIKE '%$search_query%' 
                                  or quiz_description LIKE '%$search_query%' 
                                  or score_percent LIKE '%$search_query%' 
                                  or passing like '%$search_query%' 
                                  or verdict like '%$search_query%' 
                                  or date like '%$search_query%')";
                                }
                                else 
                                {
                                  $sql_get_history = "select * from quiz_result where student_email='$email' ";
                                }

                                $res_get_history = mysqli_query($conn, $sql_get_history);

                                ?>
                                <!-- HTML form for the search bar -->
                                <form method="POST" action="">
                                      <div class="input-group mb-3">
                                          <!-- input bar  -->
                                          <input type="text" class="form-control" name="search_query" style="margin-right:2%;" placeholder="Search" >
                                          <!-- search and back button  -->
                                          <div class="input-group-append">
                                            <button class="btn btn-primary" name="search_btn" type="submit">
                                              <i class="fas fa-search"></i>
                                              Search
                                            </button>
                                            <button type="submit" class="btn btn-secondary">Back</button>
                                          </div>
                                      </div>
                                  </form>
                                <?php

                                if($res_get_history->num_rows > 0)
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
                                                    <th scope="col"> Added Scores </th>
                                                    <th scope="col"> Your Score %</th>
                                                    <th scope="col"> Passing Score </th>
                                                    <th scope="col"> Verdict </th>
                                                    <th scope="col"> Date Finished</th>
                                                </tr>
                                            </thead>
                                    ';
                                    while($row = $res_get_history->fetch_assoc())
                                    {
                                        $prof_name = $row['prof_name'];
                                        $student_email = $row['student_email'];
                                        $subject = $row['subject'];
                                        $quiz_title = $row['quiz_title'];
                                        $quiz_description = $row['quiz_description'];
                                        $num_ques = $row['num_ques'];
                                        $correct = $row['correct'];
                                        $wrong = $row['wrong'];
                                        $unanswered = $row['unanswered'];
                                        $score = $row['score'];
                                        $score_percent = $row['score_percent'];
                                        $passing = $row['passing'];
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
                                                    <td data-label="# Questions" class="data">'. $num_ques .'</td>
                                                    <td data-label="# Correct" class="data text-success"> <strong>'. $correct .'</strong></td>
                                                    <td data-label="# Wrong" class="data text-danger"> <strong>'. $wrong .' </strong></td>
                                                    <td data-label="# Unanswered" class="data text-secondary"> <strong>'. $unanswered .' </strong></td>
                                                    <td data-label="Added Scores" class="data text-success"> <strong>+'. $score .'</strong></td>
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
