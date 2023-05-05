<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>View Add Quiz | Learning E.R.A</title>
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

          <section id="view_add_quiz" class="view_add_quiz-section view_add_quiz-style-1">
            <div class="container"> 
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <?php
                                //get Url subject and subject token
                                if(isset($_GET['subject']) && isset($_GET['subject_token']))
                                {
                                    $subject = $_GET['subject'];
                                    $subject_token = $_GET['subject_token'];

                                    // Add quiz 
                                    if(isset($_POST['submit_add_quiz']))
                                    {
                                        $prof_email = $user['email'];
                                        $fname = $user['fname'];
                                        $lname = $user['lname'];
                                        $full_name = $fname .' '. $lname;

                                        $quiz_title = $_POST['quiz_title'];
                                        $quiz_description = $_POST['quiz_description'];
                                        $quiz_time = $_POST['quiz_time'];
                                        $num_ques = $_POST['num_ques'];
                                        $passing = $_POST['passing'];

                                        $quiz_token = 'quiz-'. rand(1000000,9000000);

                                        $sql_insert_quiz = "insert into quiz_type (prof_email, prof_name, quiz_title, quiz_description, quiz_time, num_ques, passing, subject, subject_token, quiz_token, publish_stat) values 
                                        ('$prof_email','$full_name','$quiz_title','$quiz_description','$quiz_time', '$num_ques', '$passing', '$subject','$subject_token', '$quiz_token','Unpublished') ";
                                        $res_insert_quiz = mysqli_query($conn, $sql_insert_quiz);

                                        if($res_insert_quiz)
                                        {
                                            echo '
                                                <div class="alert alert-success text-center" role="alert" id="myAlert">
                                                    Successfully Added Quiz in '. $subject .' 
                                                </div>';
                                        }
                                    }

                                    // get quiz token first 
                                    $sql_get_quizt = "select * from quiz_type";
                                    $res_get_quizt = mysqli_query($conn, $sql_get_quizt);

                                    if($res_get_quizt->num_rows > 0)
                                    {
                                      while($row = $res_get_quizt->fetch_assoc())
                                      {
                                        $quiz_token = $row['quiz_token'];
                                        $quiz_title = $row['quiz_title'];
                                        $quiz_description = $row['quiz_description'];
                                        
                                        // edit quiz 
                                        if(isset($_POST['submit_edit_quiz_'. $quiz_token]))
                                        {

                                          $edit_quiz_title = $_POST['edit_quiz_title'];
                                          $edit_quiz_description = $_POST['edit_quiz_description'];
                                          $edit_quiz_time = $_POST['edit_quiz_time'];
                                          $edit_num_ques = $_POST['edit_num_ques'];
                                          $edit_passing = $_POST['edit_passing'];

                                          //update quiz
                                          $sql_update_quiz = "update quiz_type set quiz_title='$edit_quiz_title', 
                                          quiz_description='$edit_quiz_description', quiz_time='$edit_quiz_time', passing = '$edit_passing', 
                                          num_ques='$edit_num_ques' where quiz_token='$quiz_token' ";
                                          $res_update_quiz = mysqli_query($conn, $sql_update_quiz);

                                          if($res_update_quiz)
                                          {
                                            echo '
                                            <div class="alert alert-success text-center" role="alert" id="myAlert">
                                                Successfully Edited ' .$subject. ' quiz!
                                            </div>';
                                          }
                                        }

                                        // publish status 
                                        if(isset($_POST['publish' . $quiz_token]))
                                        {
                                          $sql_update_publish = "update quiz_type set publish_stat = 1 where quiz_token = '$quiz_token' ";
                                          $res_update_publish = mysqli_query($conn, $sql_update_publish);
                                          
                                          if($res_update_publish)
                                          {
                                            echo '
                                            <div class="alert alert-success text-center" role="alert" id="myAlert">
                                                Successfully Published ' .$quiz_title. ' | '. $quiz_description.' !
                                            </div>';
                                          }
                                        }
                                        // unpublish status 
                                        if(isset($_POST['unpublish'. $quiz_token]))
                                        {
                                          $sql_update_unpublish = "update quiz_type set publish_stat = 0 where quiz_token = '$quiz_token' ";
                                          $res_update_unpublish = mysqli_query($conn, $sql_update_unpublish);
                                          
                                          if($res_update_unpublish)
                                          {
                                            echo '
                                            <div class="alert alert-success text-center" role="alert" id="myAlert">
                                                Successfully Unpublished ' .$quiz_title. ' | '. $quiz_description.' !
                                            </div>';
                                          }

                                        }
                                        
                                      }
                                    }

                                    //get id and Delete quiz type
                                    if(isset($_GET['id']))
                                    {
                                        $id = $_GET['id'];
                                        $quiz_token = $_GET['quiz_token'];

                                        $sql_delete_qt = "delete from quiz_type where id ='$id' ";
                                        $res_delete_qt = mysqli_query($conn, $sql_delete_qt);

                                        if($res_delete_qt)
                                        {
                                            $sql_delete_quiz = "delete from quiz where quiz_token='$quiz_token' ";
                                            $res_delete_quiz = mysqli_query($conn, $sql_delete_quiz);

                                            $sql_delete_res = "delete from quiz where quiz_token='$quiz_token' ";
                                            $res_delete_res = mysqli_query($conn, $sql_delete_res);

                                            echo'
                                                <script>
                                                    location.href = "view_add_quiz.php?subject='.$subject.'&subject_token='.$subject_token.'";
                                                </script>
                                            ';
                                        }
                                        else
                                        {
                                            echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                                                      Something went wrong, pls try again!
                                                  </div>';
                                        }
                                    }
                                }
                                

                            ?>
        
                            <div class="row">
                              <div class="col-md-1">
                                <a href="add_quiz.php"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                <br>
                              </div>
                              <div class="col-md-11">
                                <button class="btn btn-primary mb-30" id="view_add_quiz" data-toggle="modal" data-target="#edit_modal7">
                                  + Add Quiz to <?php echo $subject ?>
                                </button>
                              </div>
                            </div>

                            <?php
                                //count all published quiz
                                $sql_count_quiz_pub = "select count(*) from quiz_type where prof_email='$email' and subject_token='$subject_token' and publish_stat = 1 ";
                                $res_count_quiz_pub = mysqli_query($conn, $sql_count_quiz_pub);
                                if($res_count_quiz_pub)
                                {
                                  $count_quiz_pub = mysqli_fetch_array($res_count_quiz_pub)[0];
                                }
                                else{
                                  $count_quiz_pub = 0;
                                }
                                //count all unpublished quiz
                                $sql_count_quiz_unpub = "select count(*) from quiz_type where prof_email='$email' and subject_token='$subject_token' and publish_stat = 0 ";
                                $res_count_quiz_unpub = mysqli_query($conn, $sql_count_quiz_unpub);
                                if($res_count_quiz_unpub)
                                {
                                  $count_quiz_unpub = mysqli_fetch_array($res_count_quiz_unpub)[0];
                                }
                                else{
                                  $count_quiz_unpub = 0;
                                }

                                // Get data from quiz type 
                                $sql_get_qtype = "select * from quiz_type where prof_email='$email' and subject_token='$subject_token' ";
                                $res_get_qtype = mysqli_query($conn, $sql_get_qtype);
                                $count = 1;

                                if($res_get_qtype->num_rows > 0)
                                {
                                    echo '
                                    <div class="row">
                                      <div class="col-md-4">
                                        <h3 class="pb-20">'.$subject.' Quizzes </h3>
                                      </div>
                                      <div class="col-md-4 pt-10">
                                        <h6 class="pb-20 text-success"> <i class="fas fa-check"></i> Published ('.$count_quiz_pub.')</h6>
                                      </div>
                                      <div class="col-md-4 pt-10">
                                        <h6 class="pb-20 text-secondary"> <i class="fas fa-lock"></i> Unpublished ('.$count_quiz_unpub.')</h6>
                                      </div>
                                    </div>
                                    ';

                                    while($row = $res_get_qtype->fetch_assoc())
                                    {
                                        $subject = $row['subject'];
                                        $subject_token = $row['subject_token'];

                                        $quiz_title = $row['quiz_title'];
                                        $quiz_description = $row['quiz_description'];
                                        $quiz_time = $row['quiz_time'];
                                        $num_ques = $row['num_ques'];
                                        $passing = $row['passing'];
                                        $quiz_token = $row['quiz_token'];

                                        //count all quiz_type to specific user (prof)
                                        $sql_count_qt = "select count(*) from quiz where prof_email='$email' and subject_token='$subject_token' and quiz_token='$quiz_token' ";
                                        $res_count_qt = mysqli_query($conn, $sql_count_qt);

                                        if($res_count_qt)
                                        {
                                          $count_qt = mysqli_fetch_array($res_count_qt)[0];
                                        }
                                        else{
                                          $count_qt = 0;
                                        }

                                        ?>
                                          <div id="view_add_quiz2" class="mb-20">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <?php echo  $quiz_description  .' | <span class="text-danger"> Duration : '. $quiz_time .' minutes </span> | <span class="text-primary">Items ('. $num_ques .')</span>'?> 
                                                <h4 class="text-dark"> <?php echo $quiz_title?></h4>
                                                <p class="text-success"> Passing | <?php echo $passing ?> %</p>
                                              </div>
                                              <div class="col-md-2 pt-15">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal8_<?php echo $quiz_token ?>">
                                                  Edit
                                                </button>
                                              </div>
                                              <div class="col-md-2 pt-15">
                                                <h6>
                                                  <a class="btn btn-primary" href="view_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title?>&quiz_token=<?php echo $quiz_token ?>">
                                                    Questions Banks (<?php echo $count_qt ?>) 
                                                  </a>
                                                </h6>
                                              </div>
                                              <div class="col-md-2 pt-15">
                                                <h6>
                                                  <a class="btn btn-primary" href="create_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title ?>&quiz_token=<?php echo $quiz_token ?>">
                                                    Add Question
                                                  </a>
                                                </h6>
                                              </div>
                                              <div class="col-md-2 pt-15">
                                                <form method="post">
                                                  <!-- publish form  -->
                                                  <?php
                                                    $sql_publish = "select * from quiz_type where quiz_token='$quiz_token' and publish_stat = 1";
                                                    $res_publish = mysqli_query($conn, $sql_publish);

                                                    if($res_publish->num_rows > 0) 
                                                    {
                                                      ?>
                                                        <h5 class="text-success mb-3">Published <i class="fas fa-check"></i></h5>
                                                        <button type="submit" name="unpublish<?php echo $quiz_token ?>"  class="btn btn-warning" onclick="return confirm('Are you sure you want to Unpublish this ?')">
                                                          Unpublish 
                                                        </button>
                                                      <?php
                                                    }
                                                    else
                                                    {
                                                      ?>
                                                        <h5 class="text-secondary mb-3">Unpublished <i class="fas fa-lock"></i></h5>
                                                        <button type="submit" name="publish<?php echo $quiz_token ?>"  class="btn btn-warning" onclick="return confirm('Are you sure you want to Publish this ?')">
                                                          Publish 
                                                        </button>
                                                      <?php
                                                    }
                                                  ?>
                                                </form>
                                              </div>
                                              <div class="col-md-2 pt-15">
                                                <h6>
                                                  <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')" href="view_add_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&quiz_token=<?php echo $quiz_token?>&id=<?php echo $row['id']?>">
                                                    Delete 
                                                  </a>
                                                </h6>
                                              </div>
                                            </div>
                                          </div>

                                        <?php
                                      // =============== important placement inside while loop =======================================
                                          ?>
                                            <!--================================ Start view_add_quiz.php ======================================== -->
                                              <!-- Edit Modal 8 button starts here  -->
                                              <div class="modal fade" id="edit_modal8_<?php echo $quiz_token ?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal8_<?php echo $quiz_token ?>_label" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title text-primary" id="edit_modal8Label">Edit Quiz</h5>
                                                          </div>

                                                          <form method="post">
                                                              <div class="modal-body">
                                                                  <div class="row">
                                                                      <div class="col-12">
                                                                          <!-- Quiz Title -->
                                                                          <label class="label-form pb-10" for="quiz_title">Quiz Title</label>
                                                                          <input class="form-control mb-20" type="text" name="edit_quiz_title" id="quiz_title" value="<?php echo $quiz_title ?>" required>
                                                                          <!-- Quiz Description -->
                                                                          <label class="label-form pb-10" for="quiz_desc">Quiz Description</label>
                                                                          <input class="form-control mb-20" type="text" name="edit_quiz_description" id="quiz_desc" value="<?php echo $quiz_description ?>" required>
                                                                          <!-- Quiz Time(In minutes) -->
                                                                          <label class="label-form pb-10" for="quiz_time">Quiz Time(In minutes)</label>
                                                                          <input class="form-control mb-20" type="number" name="edit_quiz_time" id="quiz_time" value="<?php echo $quiz_time ?>" min="1" required>
                                                                          <!-- # of Questions -->
                                                                          <label class="label-form pb-10" for="num_ques"># of Questions</label>
                                                                          <input class="form-control mb-20" type="number" name="edit_num_ques" id="num_ques" value="<?php echo $num_ques ?>" min="1" required >
                                                                          <!-- passing score  -->
                                                                          <label class="label-form pb-10" for="passing">Passing Score (1-100) %</label>
                                                                          <input class="form-control mb-20" type="number" name="edit_passing" id="passing" value="<?php echo $passing?>" min="1" max="100" required>
                                                                      </div>

                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                  <button type="submit" name="submit_edit_quiz_<?php echo $quiz_token ?>" class="btn btn-primary">Edit</button>
                                                              </div>

                                                          </form>

                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- Modal 8 button End here  -->
                                          <!--================================ End view_add_quiz.php ======================================== -->
                                          <?php

                                    }
                                }
                                else
                                {
                                    echo '
                                            <br>
                                            <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                                        ';
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Form and Submit buttons are inside modals (should be outside loops) -->
            <!-- add quiz modals are here  -->
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
