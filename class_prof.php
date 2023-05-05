<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>View Section | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

   
    <?php
      include "head_links.php";

      // email set up /////////////////////////////////////////////////
      require 'PHPMailer-master/src/PHPMailer.php';
      require 'PHPMailer-master/src/SMTP.php';
      require 'PHPMailer-master/src/Exception.php';
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

          <section id="class_prof" class="class_prof-section class_prof-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <?php
                              //======================= get urls subject and subject_token for counts ==============
                              if(isset($_GET['subject']) && isset($_GET['subject_token']))
                              {
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];

                                //===========count all students to approved =================
                                $sql_count_student = "select count(*) from prof_Class where prof_email='$email' and subject_token='$subject_token' and approval = 1 ";
                                $res_count_student = mysqli_query($conn, $sql_count_student);
                                if($res_count_student)
                                {
                                  $count_student = mysqli_fetch_array($res_count_student)[0];
                                }
                                else{
                                  $count_student = 0;
                                }

                                //===========count all students pending =================
                                $sql_count_student_pending = "select count(*) from prof_Class where prof_email='$email' and subject_token='$subject_token' and approval = 0 ";
                                $res_count_student_pending = mysqli_query($conn, $sql_count_student_pending);
                                if($res_count_student_pending)
                                {
                                  $count_pending = mysqli_fetch_array($res_count_student_pending)[0];
                                }
                                else{
                                  $count_pending = 0;
                                }
                              }

                              //===========================if delete is pressed====================== 
                              if(isset($_GET['id']) && isset($_GET['subject']) && isset($_GET['subject_token']))
                              {
                                $id = $_GET['id'];
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];

                                $sql_del_stud = "delete from prof_class where id='$id'";
                                $res_del_stud = mysqli_query($conn, $sql_del_stud);

                                if($res_del_stud)
                                {
                                  echo'
                                    <script>
                                      location.href = "class_prof.php?subject='.$subject.'&subject_token='.$subject_token.'";
                                    </script>
                                  ';
                                }
                              }

                              //======================== approvals here =================================
                              if(isset($_GET['id_accept']) && isset($_GET['student_email']))
                              {
                                $id_accept = $_GET['id_accept'];
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];
                                $student_email = $_GET['student_email'];

                                $sql_accept = "update prof_class set approval = 1 where id='$id_accept' ";
                                $res_accept = mysqli_query($conn, $sql_accept);

                                if($res_accept)
                                {
                                  echo'
                                    <script>
                                      location.href = "class_prof.php?subject='.$subject.'&subject_token='.$subject_token.'";
                                    </script>
                                  ';
                                }

                                //SMTP settings
                                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;

                                // mails and pass mails 
                                $mail->Username = 'eduplaymaker@gmail.com';
                                $mail->Password = 'dsgadbydpiddscef';

                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                                $mail->setFrom('eduplaymaker@gmail.com', 'Class Approval');
                                // users email 
                                $mail->addAddress($student_email);
                                $mail->isHTML(true);
                                $mail->Subject = 'Class Approval';
                                $mail->Body = '
                                <div style="border-radius: 1%; border: 5px dashed #28a745; padding: 5%; text-align: center; margin: 0 10%;">
                                    <h1 style="color: #28a745;"> 
                                        Class Approved by Professor: 
                                    </h1> 
                                    <h2>
                                      '.$full_name.' <br>
                                      <span style="color: #007bff; text-decoration: underline; font-weight: 600; font-size: 26px;"> 
                                      '. $email .' <br>
                                      </span> 
                                      Subject: '.$subject.'
                                    </h2>
                                </div>
                                ';
                                $mail->send();
                                
                              }
                              else
                              if(isset($_GET['id_reject']) && isset($_GET['student_email']))
                              {
                                $id_reject = $_GET['id_reject'];
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];
                                $student_email = $_GET['student_email'];

                                $sql_reject = "update prof_class set approval = 2 where id='$id_reject' ";
                                $res_reject = mysqli_query($conn, $sql_reject);

                                if($res_reject)
                                {
                                  echo'
                                    <script>
                                      location.href = "class_prof.php?subject='.$subject.'&subject_token='.$subject_token.'";
                                    </script>
                                  ';
                                }

                                //SMTP settings
                                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;

                                // mails and pass mails 
                                $mail->Username = 'eduplaymaker@gmail.com';
                                $mail->Password = 'dsgadbydpiddscef';

                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                                $mail->setFrom('eduplaymaker@gmail.com', 'Class Approval');
                                // users email 
                                $mail->addAddress($student_email);
                                $mail->isHTML(true);
                                $mail->Subject = 'Class Approval';
                                $mail->Body = '
                                <div style="border-radius: 1%; border: 5px dashed #dc3545; padding: 5%; text-align: center; margin: 0 10%;">
                                    <h1 style="color: #dc3545;"> 
                                        Class Rejected by Professor: 
                                    </h1> 
                                    <h2>
                                      '.$full_name.' <br>
                                      <span style="color: #007bff; text-decoration: underline; font-weight: 600; font-size: 26px;"> 
                                      '. $email .' <br>
                                      </span> 
                                      Subject: '.$subject.'
                                    </h2>
                                </div>
                                ';
                                $mail->send();
                              
                              }
                            
                            ?>

                            <div class="row">
                              <div class="col-md-1">
                                <a href="subject_prof.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <br>
                              </div>
                              <div class="col-md-8">
                                  <h3> <span class="text-primary"> Students</span> | <?php echo $subject .' ('. $count_student .')'?></h3> 
                                  <br>
                                  <a href="history_subj_prof.php?subject=<?php echo $subject ?>&subject_token=<?php echo $subject_token ?>" class="btn btn-primary mb-20">
                                    View Quizzes in <?php echo $subject ?>
                                  </a>
                                  <!-- search button and queries  -->
                                  <?php
                                  // Check if the form is submitted
                                  if (isset($_POST['search_btn'])) 
                                  {
                                    $search_query = $_POST['search_query'];
                                    $sql_get_student = "SELECT * FROM prof_class WHERE prof_email='$email' AND 
                                    subject_token='$subject_token' AND approval = 1 AND (student_email LIKE '%$search_query%' 
                                    OR student_fname LIKE '%$search_query%' OR student_lname LIKE '%$search_query%'
                                    OR score LIKE '%$search_query%' OR student_gender LIKE '%$search_query%'
                                    )";
                                  }
                                  else
                                  {
                                    $sql_get_student = "SELECT * FROM prof_class WHERE prof_email='$email' AND 
                                    subject_token='$subject_token' AND approval = 1 order by score desc";
                                  }

                                  $res_get_student = mysqli_query($conn, $sql_get_student);
                                  ?>

                                  <!-- HTML form for the search bar -->
                                  <form method="POST" action="">
                                      <div class="input-group mb-3">
                                          <!-- input bar  -->
                                          <input type="text" class="form-control" name="search_query" style="margin-right:2%;" placeholder="Search">
                                          <!-- search and back button  -->
                                          <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" name="search_btn">
                                              <i class="fas fa-search"></i>
                                              Search
                                            </button>
                                            <button type="submit" name="back" class="btn btn-secondary">Back</button>
                                          </div>
                                      </div>
                                  </form>

                                  <!-- Button to print the data -->
                                  <div class="no-print mb-4">
                                      <button onclick="window.print()" class="btn btn-danger">Download</button>
                                  </div>
                                  <!-- style for print  -->
                                  <style>
                                      @media print {
                                          body * {
                                            visibility: hidden;
                                          }
                                          .table-print, .table-print * {
                                            visibility: visible;
                                          }
                                          .table-print {
                                            position: absolute;
                                            left: 0;
                                            top: 0;
                                          }
                                          table tr td:nth-child(7), 
                                          table tr th:nth-child(7), 
                                          table tr td:nth-child(8), 
                                          table tr th:nth-child(8) {
                                            display: none;
                                        }
                                      }
                                  </style>

                                  <!-- display results  -->
                                  <?php
                                    if($res_get_student->num_rows > 0)
                                    {
                                      echo'
                                        <table class="table table-print">
                                          <thead>
                                            <tr>
                                              <th colspan="8">
                                                <h4 class="text-center">'. $subject .' Class</h4> 
                                              </th>
                                            </tr>
                                            <tr>
                                              <th scope="col"> Profile </th>
                                              <th scope="col"> First Name </th>
                                              <th scope="col"> Last Name </th>
                                              <th scope="col"> Gender </th>
                                              <th scope="col"> Scores </th>
                                              <th scope="col"> Badges </th>
                                              <th scope="col"> Remove </th>
                                              <th scope="col"> View </th>
                                            </tr>
                                          </thead>
                                            ';
                                          while($row = $res_get_student->fetch_assoc())
                                          {
                                            $image_upload = $row['image_upload'];
                                            $student_email = $row['student_email'];
                                            $student_fname = $row['student_fname'];
                                            $student_lname = $row['student_lname'];
                                            $student_gender = $row['student_gender'];

                                            $score = $row['score'];
                                            $badges = $row['badges'];

                                            // for badges 
                                            if(empty($badges))
                                            {
                                              $badges = '--';
                                            }
                                            else
                                            {
                                              $badges = '<img src="'.$badges.'" width="60" height="auto">';
                                            }
                                            // for score 
                                            if($score === 0)
                                            {
                                              $score = 0;
                                            }
                                            else
                                            {
                                              $score = $row['score'];
                                            }

                                            echo'
                                            <tbody>
                                              <tr>
                                                  <td data-label="Profile" class="img">
                                                  ';
                                                    if(empty($image_upload))
                                                    {
                                                      ?>
                                                        <img src="assets/img/profile/default-profile.png" class="class_prof_img">
                                                        <div class="mt-2"> <strong><?php echo $student_email ?></strong> </div> 
                                                      <?php
                                                    }
                                                    else
                                                    {
                                                      ?>
                                                        <img src="<?php echo $image_upload ?>" class="class_prof_img">
                                                        <div class="mt-2"> <strong><?php echo $student_email ?></strong> </div> 
                                                      <?php
                                                    }
                                                  echo'
                                                  </td>
                                                  <td data-label="First Name" class="data">'. $student_fname .'</td>
                                                  <td data-label="Last Name" class="data">'. $student_lname .'</td>
                                                  <td data-label="Gender" class="data">'. $student_gender .'</td>
                                                  <td data-label="Score" class="data">'. $score .'</td>
                                                  <td data-label="Badges" class="data">'. $badges .'</td>
                                                  <th data-label="Remove" class="data">
                                                    <a onclick="return confirm(\'Are you sure you want to delete this?\')" href="class_prof.php?subject='.$subject.'&subject_token='.$subject_token.'&id='.$row['id'].'" class="text-danger">
                                                      Remove
                                                    </a>
                                                  </th>
                                                  <th data-label="View" class="data">
                                                    <a href="view_student.php?email='.$row['student_email'].'&subject_token='.$subject_token.'&subject='.$subject.'" class="text-primary">
                                                      View
                                                    </a>
                                                  </th>
                                              </tr>
                                            </tbody>

                                              ';
                                          }
                                            
                                        echo '</table>';
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

                              <div class="col-md-3 pt-10">
                                <h5 style="color:orange">Pending Request (<?php echo $count_pending ?>)</h5>
                                    <?php

                                      $sql_select_stud = "select * from prof_class where prof_email='$email' and subject_token='$subject_token' and approval = 0 ";
                                      $res_select_stud = mysqli_query($conn, $sql_select_stud);

                                      if($res_select_stud->num_rows > 0)
                                      {
                                        while($row = $res_select_stud->fetch_assoc())
                                        {
                                          $student_email = $row['student_email'];
                                          $image_upload = $row['image_upload'];

                                          if(empty($image_upload))
                                          {
                                            $image_upload = 'assets/img/profile/default-profile.png';
                                          }
                                          else
                                          {
                                            $image_upload = $row['image_upload'];
                                          }

                                          ?>
                                          <div class="row pt-10">
                                            <div class="col-sm-6 pb-10">
                                              <img src="<?php echo $image_upload?>" style="width: 60px; height:60px; border-radius:100%;">
                                            </div>
                                            <div class="col-sm-3 bg-success d-flex justify-content-center align-items-center pt-10 pb-10">
                                              <a href="class_prof.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&id_accept=<?php echo $row['id']?>&student_email=<?php echo $student_email ?>" onclick="return confirm('Are You sure you want to accept ?')">
                                                <i class="fas fa-check fa-lg text-white"></i>
                                              </a>
                                            </div>
                                            <div class="col-sm-3 bg-danger d-flex justify-content-center align-items-center pt-10 pb-10">
                                              <a href="class_prof.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&id_reject=<?php echo $row['id']?>&student_email=<?php echo $student_email ?>" onclick="return confirm('Are You sure you want to reject ?')">
                                                <i class="fas fa-times fa-lg text-white"></i>
                                              </a>
                                            </div>
                                            <div class="col-sm-12">
                                              <p class="text-secondary pt-20"><strong><?php echo $student_email ?></strong></p>
                                            </div>
                                          </div>
                                          <?php
                                        }
                                      }
                                      else
                                      {
                                        ?>
                                          <br>
                                          <h5 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No pending request </h5>
                                        <?php
                                      }
                                    
                                    ?>
                                  </div>
                              
                            </div>
                            <br>

                            

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
