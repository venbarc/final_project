<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Subject Professor | Learning E.R.A</title>
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

          <section id="subject_prof" class="subject_prof-section subject_prof-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <!-- alert message when professor token pressed -->
                            <div class="alert alert-success text-center" role="alert" id="myAlert2" style="display: none;">
                                Subject ID Copied successfully.
                            </div>

                            <?php
                                //if add subject_prof is posted, execute 
                                if(isset($_POST['submit_add_subject']))
                                {   
                                    $prof_email = $user['email']; 
                                    $prof_fname = $user['fname']; 
                                    $prof_lname = $user['lname']; 
                                    $prof_full_name = $prof_fname .' '. $prof_lname;

                                    $subject = $_POST['add_subject'];
                                    $subject_token = 'subj-'. rand(1000000,9000000);

                                    $sql_insert_subject = "insert into subject (prof_email, prof_name, subject, subject_token) values ('$prof_email','$prof_full_name', '$subject','$subject_token')";
                                    $res_insert_subject = mysqli_query($conn, $sql_insert_subject);

                                    if($res_insert_subject)
                                    {
                                        echo '
                                            <div class="alert alert-success text-center" role="alert" id="myAlert">
                                                Successfully Added Section! 
                                            </div>';
                                    }
                                    else
                                    {
                                        echo '
                                            <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                                Something went wrong, pls try again! 
                                            </div>';
                                    }

                                }

                                //if delete subject is posted get id url and execute 
                                if(isset($_GET['id']))
                                {
                                    $id = $_GET['id'];
                                    $subject_token = $_GET['subject_token'];

                                    $sql_delete_subject = "delete from subject where id='$id' and subject_token='$subject_token' ";
                                    $res_delete_subject = mysqli_query($conn, $sql_delete_subject);

                                    if($res_delete_subject)
                                    {
                                      $sql_delete_quiz = "delete from quiz where subject_token='$subject_token' ";
                                      $res_delete_quiz = mysqli_query($conn, $sql_delete_quiz);

                                      $sql_delete_quiz_display = "delete from quiz_display where subject_token='$subject_token' ";
                                      $res_delete_quiz_display = mysqli_query($conn, $sql_delete_quiz_display);

                                      $sql_delete_quiz_type = "delete from quiz_type where subject_token='$subject_token' ";
                                      $res_delete_quiz_type = mysqli_query($conn, $sql_delete_quiz_type);

                                      $sql_delete_prof_class = "delete from prof_class where subject_token='$subject_token' ";
                                      $res_delete_prof_class = mysqli_query($conn, $sql_delete_prof_class);

                                        ?>
                                        <script>
                                          location.href = "subject_prof.php";
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
                                <button type="submit" class="btn btn-primary mb-30" id="add_subject" data-toggle="modal" data-target="#edit_modal6">
                                  + Add Course Subject 
                                </button>

                                  <?php
                                    $prof_email = $user['email']; 

                                    //get subject name from db
                                    $sql_get_subject = "select * from subject where prof_email='$prof_email' ";
                                    $res_get_subject = mysqli_query($conn, $sql_get_subject);
                                    $count = 1;

                                    if($res_get_subject->num_rows > 0)
                                    {
                                        echo '<h3 class="pb-20"> Subjects </h3>';

                                        while($row = $res_get_subject->fetch_assoc())
                                        {
                                            $subject = $row['subject'];
                                            $subject_token = $row['subject_token'];

                                            //count all students to approved
                                            $sql_count_student = "select count(*) from prof_Class where prof_email='$prof_email' and subject_token='$subject_token' and approval = 1 ";
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

                                            ?>
                                              <div id="add_subject_prof2" class="mb-20">
                                                <div class="row">
                                                  <div class="col-md-4 pt-15">
                                                      subject # <?php echo $count++ .' | '. $subject_token ?> 
                                                    <h4 class="text-dark"> <?php echo $subject ?></h4>
                                                  </div>
                                                  <div class="col-md-2 pt-15">
                                                    <h6>
                                                      <a href="class_prof.php?subject=<?php echo $row['subject'] .'&subject_token='. $subject_token ?>" class="btn btn-primary">
                                                        Manage
                                                      </a>
                                                  </div>
                                                  <div class="col-md-2 pt-15">
                                                      <button class="btn btn-primary" onclick="copyToClipboard('<?php echo addslashes($subject_token) ?>')" title="Copy token to add student to this subject">
                                                        Subject ID
                                                      </button>
                                                    </h6>
                                                  </div>
                                                  <div class="col-md-2 pt-15">
                                                    <h6>
                                                      Students (<?php echo $count_student ?>) 
                                                    </h6>
                                                  </div>
                                                  <div class="col-md-2 pt-15">
                                                    <h6 style="color:orange;">
                                                      Pending (<?php echo $count_pending ?>) 
                                                    </h6>
                                                  </div>
                                                  <div class="col-md-12 pt-15">
                                                    <a href="subject_prof.php?id=<?php echo $row['id'] ?>&subject_token=<?php echo $row['subject_token'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                                                      Delete
                                                    </a>
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

//====================for Copy Link clip board (subject_prof.php)=========================================
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
