<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Subject student | Learning E.R.A</title>
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

          <section id="subject_student" class="subject_student-section subject_student-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">
                        
                        <!-- if from is posted  -->
                        <?php
                        if(isset($_POST['submit_subject_token']))
                        {
                          $subject_token = $_POST['subject_token'];

                          $sql_select_subject = "select * from subject where subject_token='$subject_token' ";
                          $res_select_subject = mysqli_query($conn, $sql_select_subject);

                          if($res_select_subject->num_rows > 0)
                          {
                            while($row = $res_select_subject->fetch_assoc())
                            {
                              $prof_email = $row['prof_email'];
                              $prof_name = $row['prof_name'];
                              $subject = $row['subject'];
                              $subject_token = $row['subject_token'];

                              $sql_exist = "select * from prof_class where subject_token='$subject_token' and student_email='$email' ";
                              $res_exist = mysqli_query($conn, $sql_exist);

                              if($res_exist->num_rows > 0)
                              {
                                echo '
                                  <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                    Already added to '.$subject.' class of professor '.$prof_name.'
                                  </div>
                                  ';
                              }
                              else
                              {
                                $sql_insert_student = "insert into prof_class (prof_email, prof_name, student_email, student_fname, student_lname, student_gender, subject, subject_token, image_upload) 
                                values ('$prof_email','$prof_name','$email', '$fname','$lname','$gender','$subject','$subject_token', '$image_upload')";
                                $res_insert_student = mysqli_query($conn, $sql_insert_student);

                                if($res_insert_student)
                                {
                                  echo '
                                    <div class="alert alert-success text-center" role="alert" id="myAlert">
                                      Successfully added to '.$subject.' class of professor '.$prof_name.'.
                                    </div>
                                    ';
                                }
                              }
                              
                            }
                          }
                          else
                          {
                            echo '
                                  <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                    Subject ID does not exist pls try again!
                                  </div>
                                  ';
                          }
                        }
                        else
                        {
                          echo '
                            <div class="alert alert-warning text-center" role="alert" id="myAlert">
                              You need to get subject ID to your professor to be added in the class.
                            </div>
                            ';
                        }

                        // if leave class is pressed 
                        if(isset($_GET['id']))
                        {
                          $id = $_GET['id'];

                          $sql_delete_section = "delete from prof_class where id='$id' ";
                          $res_delete_section = mysqli_query($conn, $sql_delete_section);

                          if($res_delete_section)
                          {
                              ?>
                              <script>
                                location.href = "subject_student.php";
                              </script>
                            <?php
                          }
                          else{
                              echo '
                              <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                  Something went wrong! 
                              </div>';
                          }
                        }
                        
                        ?>

                        <div class="row">
                          <div class="col-md-1">
                            <a href="profile.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                            <br>
                          </div>
                          <div class="col-md-11">
                            <h2><?php echo $fname ?>'s Subject</h2>
                          </div>
                          <div class="col-md-3">
                            <!-- form for sending subject token  -->
                            <form method="post" width="50%">
                              <input type="text" class="form-control" name="subject_token" placeholder="Subject ID here.." > <br>
                              <input type="submit" value="Submit subject id" name="submit_subject_token" class="btn btn-primary">
                            </form>
                          </div>
                        </div> 
                        <br>

                        <!-- view data  -->
                        <?php

                          $count = 1;

                          //======== pending approval============================================================================== 
                          $sql_get_subject_p = "select * from prof_class where student_email='$email' and approval= 0 ";
                          $res_get_subject_p = mysqli_query($conn, $sql_get_subject_p);

                          //======== approved approval============================================================================== 
                          $sql_get_subject_a = "select * from prof_class where student_email='$email' and approval= 1 ";
                          $res_get_subject_a = mysqli_query($conn, $sql_get_subject_a);

                          //======== reject approval============================================================================== 
                          $sql_get_subject_r = "select * from prof_class where student_email='$email' and approval= 2 ";
                          $res_get_subject_r = mysqli_query($conn, $sql_get_subject_r); 

    //======== pending approval============================================================================== 
                          if($res_get_subject_p->num_rows > 0)
                          {
                            while($row = $res_get_subject_p->fetch_assoc())
                            {
                              $subject = $row['subject'];
                              $prof_name = $row['prof_name'];

                              ?>
                                <div id="add_subject_student">
                                  <div class="row mb-20">
                                    <div class="col-md-4">
                                      Subject # <?php echo $count++ ?> <h4 class="text-dark"> <?php echo $subject ?></h4>
                                    </div>
                                    <div class="col-md-4 pt-15">
                                      <h6>Professor <br> (<?php echo $prof_name ?>) </h6>
                                    </div>
                                    <div class="col-md-4 pt-20">
                                      <h5 class="text-warning">Pending professors approval</h5>
                                    </div>
                                    
                                  </div>
                                </div>
                                <br>
                              <?php
                            }
                          }
    //======== approved approval==============================================================================
                          if($res_get_subject_a->num_rows > 0)
                          {
                            while($row = $res_get_subject_a->fetch_assoc())
                            {
                              $subject = $row['subject'];
                              $prof_name = $row['prof_name'];
                              $subject_token = $row['subject_token'];

                              ?>
                                <div id="add_subject_student">
                                  <div class="row mb-20">
                                    <div class="col-md-4">
                                      Subject # <?php echo $count++ ?> <h4 class="text-dark"> <?php echo $subject ?></h4>
                                    </div>
                                    <div class="col-md-4 pt-15">
                                      <h6>Professor <br> (<?php echo $prof_name ?>) </h6>
                                    </div>
                                    <div class="col-md-2 pt-20">
                                      <h6>
                                        <a href="view_class.php?subject_token=<?php echo $subject_token?>&subject=<?php echo $subject ?>" class="btn btn-primary">
                                          View class
                                        </a>
                                      </h6>
                                    </div>
                                    <div class="col-md-2 pt-20">
                                      <h6>
                                        <a onclick="return confirm('Are you sure you want to leave class?')" href="subject_student.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                          Leave class
                                        </a>
                                      </h6>
                                    </div>
                                  </div>
                                </div>
                                <br>
                              <?php
                            }
                          }
    //======== reject approval============================================================================== 
                          if($res_get_subject_r->num_rows > 0)
                          {
                            while($row = $res_get_subject_r->fetch_assoc())
                            {
                              $subject = $row['subject'];
                              $prof_name = $row['prof_name'];

                              ?>
                                <div id="add_subject_student">
                                  <div class="row mb-20">
                                    <div class="col-md-4">
                                      Subject # <?php echo $count++ ?> <h4 class="text-dark"> <?php echo $subject ?></h4>
                                    </div>
                                    <div class="col-md-4 pt-15">
                                      <h6>Professor <br> (<?php echo $prof_name ?>) </h6>
                                    </div>
                                    <div class="col-md-2 pt-20">
                                      <h6 class="text-danger">Rejected Approval</h6>
                                    </div>
                                    <div class="col-md-2 pt-20">
                                      <h6><a onclick="return confirm('Are you sure you want to Delete class?')" href="subject_student.php?id=<?php echo $row['id'] ?>" class="text-danger">Delete</a></h6>
                                    </div>
                                  </div>
                                </div>
                                <br>
                              <?php
                            }
                          }
                          else
                          if(!($res_get_subject_p->num_rows > 0 || $res_get_subject_a->num_rows > 0 || $res_get_subject_r->num_rows > 0))
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
