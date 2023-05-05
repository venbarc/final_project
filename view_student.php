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

          <section id="view_student" class="view_student-section view_student-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">
                            
                            <!-- student info  -->
                            <?php
                                if(isset($_GET['email']) && isset($_GET['subject_token']) && isset($_GET['subject']))
                                {
                                    $email = $_GET['email'];
                                    $subject_token = $_GET['subject_token'];
                                    $subject = $_GET['subject'];

                                    //get only the image
                                    $stmt = $conn->prepare("select * from users where email = ?");
                                    $stmt->bind_param('s', $email);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    $row = mysqli_fetch_assoc($res);
                                    $image_upload = $row['image_upload'];
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $contact = $row['contact'];
                                    $address = $row['address'];

                                    // if image is empty 
                                    if(empty($image_upload))
                                    {
                                        $image_upload = "assets/img/profile/default-profile.png";
                                    }
                                    else{
                                        $image_upload = $row['image_upload'];
                                    }
                                    // if contact and addres is empty 
                                    if(empty($contact))
                                    {
                                        $contact = '<p class="text-danger"> no contact';
                                    }else{ 
                                        $contact = $row['contact']; 
                                    }
                                    if(empty($address))
                                    {
                                        $address = 'no address</p>';
                                    }else{
                                        $address = $row['address'];
                                    }
                                    
                                    echo'
                                    <div class="row">
                                        <div class="col-md-1">
                                            <a href="class_prof.php?subject='.$subject.'&subject_token='.$subject_token.'"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                        </div>
                                        <center>
                                            <div class="col-md-5 mb-20">
                                                <div class="profile-img wow fadeInUp" data-wow-delay=".1s">
                                                    <img src="'.$image_upload.'">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-50">
                                                <div class="profile-img wow fadeInUp" data-wow-delay=".1s">
                                                    <h5>'. $fname .' '. $lname .'</h5>
                                                    '.$email.' <br>
                                                    '.$contact.' | '.$address.'                                                   
                                                </div>
                                            
                                       
                                    ';
                                    ?>
                                            <!-- Badges  -->
                                            <div class="col-md-12 mb-20 mt-20">
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
                                        </center>
                                    <?php

                                    
                                    $stmt->close(); 

                                    // start to get users data 
                                    $stmt = $conn->prepare("select * from quiz_result where student_email = ? and subject_token = ?");
                                    $stmt->bind_param('ss', $email, $subject_token);
                                    $stmt->execute();
                                    $res = $stmt->get_result();

                                    if($res->num_rows > 0)
                                    {
                                        echo'
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                    <tr class="">
                                                        <th scope="col"> Subject </th>
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
                                        while($row = $res->fetch_assoc())
                                        {
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
                                                    <tbody class="">
                                                    <tr class="">
                                                        <td data-label="Professor" class="data">'. $subject .'</td>
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
                                                    </tbody>
                                                    
                                                ';
                                        }
                                            echo'
                                                </table>
                                            </div>
                                            ';
                                    }
                                    else
                                    {
                                        ?>
                                        <br>
                                        <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                                        <?php
                                    }
                                    $stmt->close();
                                    
                                    echo'
                                    </div>
                                    ';
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
