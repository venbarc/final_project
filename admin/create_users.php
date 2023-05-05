<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
  CREATE USERS | LEARNING ERA  
  </title>

    <?php 
      include "../connect.php";
      include "head_links.php";
    ?>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php
    include "side_navbar.php";
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php
      include "navbar.php";
      include "users_hero.php";
    ?>
   
     <!-- When form is submitted -->
      <?php
        // msg when something happens
        $msg = array();
        
        if(isset($_POST['submit']))
        {
        //POST from Form
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $full_name = $fname .' '. $lname;

          $email = $_POST['email'];
          $password = $_POST['password'];
          $cpassword = $_POST['cpassword'];
          $gender = $_POST['gender'];
          $user_type = $_POST['user_type'];

          $hash = password_hash($password, PASSWORD_DEFAULT);
          $error = false;

          // Check if email address already exists in the database
          $sql = "select email from users where email = '$email' ";
          $res = mysqli_query($conn, $sql);

          if($res->num_rows > 0)
          {
            $msg[] = '<div class="error">
                        Email not Available, pls try again!
                      </div>';
            $error = true;
          }
                  
          if($password != $cpassword)
          {
            $msg[] = '<div class="error">
                        Password and Confirm Password does not match!
                      </div>';
            $error = true;
          }
          else
          if($error != true)
          {
       

            // Insert Data into database
            $sql_insert_user = "insert into users (fname, lname, email, password, gender, user_type) values ('$fname', '$lname', '$email', '$hash', '$gender', '$user_type' )";
            $res_insert_user = mysqli_query($conn, $sql_insert_user);

            if($res_insert_user)
            {
              $msg[] = '<div class="scs">
                          Successfully registered! 
                        </div>';
            }
          }
     

        }
      ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Create User</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">

              <form  method="POST" style="padding: 0 10%; ">
                    <?php
                      foreach($msg as $msg_item)
                      {
                        echo $msg_item;
                      }
                    ?>
                    <div class="row">

                      <!-- First and Last Name -->
                      <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".6s">
                        <label class="form-label" for="email"><strong>First Name</strong></label>
                        <input type="test" class="form-control" placeholder="First Name" name="fname" required>
                      </div>
                      <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".7s">
                        <label class="form-label" for="password"><strong>Last Name</strong></label>
                        <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
                      </div>

                      <!-- Email Address -->
                      <div class="col-md-12 mb-3 wow fadeInUp" data-wow-delay=".8s">
                        <label class="form-label" for="email"><strong>Email Address</strong></label>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required>
                      </div>
                    
                      <!-- password and confirm password -->
                      <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".8s">
                        <label class="form-label" for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" placeholder="Password" minlength="6" name="password" required>
                      </div>
                      <div class="col-md-6 mb-3 wow fadeInUp" data-wow-delay=".8s">
                        <label class="form-label" for="cpassword"><strong>Confirm Password</strong></label>
                        <input type="password" class="form-control" placeholder="Confirm Password" minlength="6" name="cpassword" required>
                      </div>
                      
                      <!-- Gender here -->
                        <div class="wrapper radio-center wow fadeInUp" data-wow-delay=".9s">
                          <input type="radio" name="gender" value="Male" id="option-male" required>
                          <input type="radio" name="gender" value="Female" id="option-female" required>
                            <label for="option-male" class="option option-male">
                              <div class="dot"></div>
                                <span>Male</span>
                            </label>
                            <label for="option-female" class="option option-female">
                              <div class="dot"></div>
                                <span>Female</span>
                            </label>
                        </div>

                      <!-- User Type here -->
                        <div class="wrapper radio-center wow fadeInUp" data-wow-delay=".9s">
                          <input type="radio" name="user_type" value="prof" id="option-prof" required>
                          <input type="radio" name="user_type" value="student" id="option-student" required>
                            <label for="option-prof" class="option option-prof">
                              <div class="dot"></div>
                                <span>Professor</span>
                                </label>
                            <label for="option-student" class="option option-student">
                              <div class="dot"></div>
                                <span>Student</span>
                            </label>
                        </div>
                      
                    </div>
                    
                    <!-- Submit button here -->
                    <div class="text-center mb-12 pb-30 pt-30 wow fadeInUp" data-wow-delay="1s">
                        <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                    </div>

                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  
  </main>
  
<?php
    include "script_links.php";
?>
</body>

</html>