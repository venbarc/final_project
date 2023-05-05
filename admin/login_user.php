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
    LOGIN AS USER | LEARNING ERA
  </title>

    <?php
      session_start(); 
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
          ?>
            <script>
              location.href = "../profile.php";
            </script>
          <?php
        }
        else
        {
          
        }

        // if login as user is pressed 
        if(isset($_POST['login_as_user']))
        {
          $password = $_POST['password'];
          
          // check if user id exist on database 
          $stmt_check_user = $conn->prepare("select * from users where password = ? ");
          $stmt_check_user->bind_param('s', $password);
          $stmt_check_user->execute();
          $res_check_user = $stmt_check_user->get_result();
          $row = $res_check_user->fetch_assoc();
          
          if($res_check_user->num_rows == 1)
          {
            $id = $row['id'];
            // start session 
            $_SESSION['user_id'] = $id;
            ?>
              <script>
                location.href = "../profile.php";
              </script>
            <?php
          }
          else{
            ?>
              <div class="error">User ID invalid! pls Try again.</div>
            <?php
          }
          $stmt_check_user->close();
        }
    ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Login as User</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">

              <div class="row">
                <div class="col-md-8">
                  <!-- start (table) -->
                  <div class="container-fluid py-4">
                    <!-- alert message when User ID pressed -->
                    <div class="scs" id="myAlert2" style="display: none;">
                        User ID Copied successfully.
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card my-4">
                          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                              <h6 class="text-white text-capitalize ps-3">Professors</h6>
                            </div>
                          </div>
                          <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                              <!-- professor table here  -->
                              <?php
                                // select all professors 
                                $sql_prof = "select * from users where user_type='prof' ";
                                $res_prof = mysqli_query($conn, $sql_prof);

                                if($res_prof->num_rows > 0)
                                {
                                  echo'
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Profile</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">First name</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Last Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">User ID</th>
                                      </tr>
                                    </thead>
                                  <tbody>
                                  ';
                                  while($row = $res_prof->fetch_assoc())
                                  {
                                    $id = $row['id'];
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $email = $row['email'];
                                    $image_upload = $row['image_upload'];
                                    $password = $row['password'];
                                    
                                    //if image is empty
                                    if(empty($image_upload))
                                    {
                                      $image_upload = 'No image';
                                    }
                                    else
                                    {
                                      $image_upload = '<img src="../'.$image_upload.'" class="avatar avatar-sm me-3 border-radius-lg">';
                                    }
                                    echo'
                                    <tr>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$image_upload.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$fname.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$lname.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$email.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                      ';
                                      ?>
                                        <input class="btn btn-primary" value="<?php echo $password ?>" onclick="copyToClipboard('<?php echo addslashes($password) ?>')" readonly>
                                      <?php
                                echo '</td>
                                    ';
                                    
                                    ?>
                                    <!-- clipboard the password id of user  -->
                                    <script>
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
                                    <?php
                                  }
                                echo'
                                  </tbody>
                                </table>
                                ';
                                }
                              ?>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="card my-4">
                          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                              <h6 class="text-white text-capitalize ps-3">Students</h6>
                            </div>
                          </div>
                          <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                              <!-- professor table here  -->
                              <?php
                                // select all professors 
                                $sql_prof = "select * from users where user_type='student' ";
                                $res_prof = mysqli_query($conn, $sql_prof);

                                if($res_prof->num_rows > 0)
                                {
                                  echo'
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Profile</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">First name</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Last Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">User ID</th>
                                      </tr>
                                    </thead>
                                  <tbody>
                                  ';
                                  while($row = $res_prof->fetch_assoc())
                                  {
                                    $id = $row['id'];
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $email = $row['email'];
                                    $image_upload = $row['image_upload'];
                                    $password = $row['password'];
                                    
                                    //if image is empty
                                    if(empty($image_upload))
                                    {
                                      $image_upload = 'No image';
                                    }
                                    else
                                    {
                                      $image_upload = '<img src="../'.$image_upload.'" class="avatar avatar-sm me-3 border-radius-lg">';
                                    }
                                    echo'
                                    <tr>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$image_upload.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$fname.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$lname.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                        '.$email.'
                                      </td>
                                      <td class="align-middle text-center text-sm pt-3">
                                      ';
                                      ?>
                                        <input class="btn btn-primary" value="<?php echo $password ?>" onclick="copyToClipboard('<?php echo addslashes($password) ?>')" readonly>
                                      <?php
                                echo '</td>
                                    </tr>
                                    ';
                                  }
                                echo'
                                  </tbody>
                                </table>
                                ';
                                }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end  (table)-->
                </div>
                <div class="col-md-4">
                  <!--Start login as user -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                          <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Login as User</h6>
                          </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                          <div class="table-responsive p-0">
                          <form method="post" style="padding: 10% 20%">
                              <input type="text" name="password" class="form-control" placeholder="User ID here..."><br>
                              <input type="submit" value="Login" name="login_as_user" class="btn btn-dark">
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end login as user -->
                </div>
              </div>
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