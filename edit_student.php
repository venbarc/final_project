<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Edit students | Learning E.R.A</title>
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
      // get users data from users
        $user_id = $_SESSION['user_id'];
        $sql = "select * from users where id ='$user_id' ";
        $res = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($res);

        $email = $user['email'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $gender = $user['gender'];
        $contact = $user['contact'];
        $address = $user['address'];
        $token = $user['token'];

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

          <!-- ========================= edit_students start ========================= -->
          <section id="edit_students" class="edit_students-section edit_students-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                            <?php
                                if(isset($_GET['id']) && isset($_GET['id2']))
                                {
                                    $id = $_GET['id'];
                                    $id2 = $_GET['id2'];

                                    $sql_select_students = "select * from prof_class where id='$id' ";
                                    $res_select_students = mysqli_query($conn, $sql_select_students);
                                    $row = mysqli_fetch_assoc($res_select_students);

                                    $student_fname = $row['student_fname'];
                                    $student_lname = $row['student_lname'];
                                    $student_email = $row['student_email'];

                                    //if submitted form 
                                    if(isset($_POST['submit_edit_student']))
                                    {
                                        $post_fname = $_POST['post_fname'];
                                        $post_lname = $_POST['post_lname'];
                                        $post_email = $_POST['post_email'];

                                        //update professor class database 
                                        $sql_update_student_profclass = "update prof_class set student_fname='$post_fname', student_lname='$post_lname', student_email='$post_email' where id ='$id' ";
                                        $res_update_student_profclass = mysqli_query($conn, $sql_update_student_profclass);

                                        //update user database 
                                        $sql_update_student_users = "update users set fname='$post_fname', lname='$post_lname', email='$post_email'  where  id ='$id2' ";
                                        $res_update_student_users = mysqli_query($conn, $sql_update_student_users);

                                        if($res_update_student_profclass && $res_update_student_users)
                                        {
                                            ?>
                                                <script>
                                                    location.href = "students.php";
                                                </script>
                                            <?php
                                        }

                                    }

                                }
                            ?>
                            <form action="" method="post" class="edit_student_form">

                                <div class="row">

                                    <div class="col-md-11">
                                        <h2>Edit Student</h2>
                                    </div>
                                    <div class="col-md-1 pb-20">
                                        <h1> <a href="students.php" class="text-danger"> x</a></h1>
                                    </div>

                                    <!-- First and Last Name -->
                                    <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".6s">
                                        <label class="form-label" for="email"><strong>First Name</strong></label>
                                        <input type="test" class="form-control" value="<?php echo $student_fname ?>" name="post_fname" required>
                                    </div>
                                    <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".7s">
                                        <label class="form-label" for="password"><strong>Last Name</strong></label>
                                        <input type="text" class="form-control" value="<?php echo $student_lname ?>"  name="post_lname" required>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="col-md-12 mb-3 wow fadeInUp" data-wow-delay=".8s">
                                        <label class="form-label" for="email"><strong>Email Address</strong></label>
                                        <input type="email" class="form-control" value="<?php echo $student_email ?>"  name="post_email" required>
                                    </div>
                                    
                                    <input type="submit" value="Edit Student" class="btn btn-primary wow fadeInUp" data-wow-delay="1s" name="submit_edit_student">

                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>

  

          </section>
          <!-- ========================= edit_students end ========================= -->

        </section>
        <!-- ========================= hero2-section-wrapper-2 start ========================= -->

        
      <script>
        //=====================Version 2 of Sticky navbar (hero2)==========================================
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
