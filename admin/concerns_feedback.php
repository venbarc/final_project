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
    Concerns Feedback | LEARNING ERA
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

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-3">
              <h5 class="mb-0">Concerns Feedback</h5>
            </div>
            <div class="card-body p-3 pb-0">
                <?php
                  
                  if(isset($_GET['id']))
                  {
                    $id = $_GET['id'];

                    // if admin feed back is posted 
                    if(isset($_POST['submit_feedback']))
                    {
                      $admin_feedback = $_POST['admin_feedback'];

                      $stmt_update = $conn->prepare("update concerns set admin_feedback = ? where id = ?");
                      $stmt_update->bind_param('si', $admin_feedback, $id);
                      $stmt_update->execute();
                      
                      if($stmt_update->affected_rows > 0)
                      {
                        ?>
                          <script>
                            location.href = "concerns_feedback.php?id=<?php echo $id ?>";
                          </script>
                        <?php
                      }
                    }
                    // if undo is posted
                    if(isset($_POST['undo']))
                    {
                      $stmt_update = $conn->prepare("update concerns set admin_feedback = '' where id = ?");
                      $stmt_update->bind_param('i', $id);
                      $stmt_update->execute();
                      
                      if($stmt_update->affected_rows > 0)
                      {
                        ?>
                          <script>
                            location.href = "concerns_feedback.php?id=<?php echo $id ?>";
                          </script>
                        <?php
                      }
                    }

                    $stmt = $conn->prepare("select * from concerns where id = ? ");
                    $stmt->bind_param('i', $id);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $row = mysqli_fetch_assoc($res);

                    $email = $row['email'];
                    $concern_title = $row['concern_title'];
                    $concern_msg = $row['concern_msg'];
                    $admin_feedback = $row['admin_feedback'];
                    $date = $row['date'];

                    $placeholder = "";
                    
                    if(empty($admin_feedback))
                    {
                      $placeholder = "Enter Feedback here...";
                      echo'
                      <div class="row">
                        <div class="col-md-6">
                          <h2 class="text-dark mb-3"> '. $concern_title .'</h2>
                          <h6>Concern by : '. $email .'</h6>
                          <h6 class="text-danger mb-5"> '. $date .'</h6>
                          <p class="mb-5">'. $concern_msg .'</p>
                        </div>
                        <div class="col-md-6 mb-5">
                          <form method="post">
                            <textarea  name="admin_feedback" rows="15" placeholder="'.$placeholder.'" class="responsive_textarea"required></textarea>
                            <input type="submit" name="submit_feedback" value="Submit" class="btn btn-success mt-2" onclick="return confirm(\'Are you sure you want to submit feedback ?\')">
                          </form>
                        </div>
                      </div>
                    ';
                    }
                    else
                    {
                      $placeholder = "";
                      echo'
                      <div class="row">
                        <div class="col-md-6">
                          <h2 class="text-danger mb-3"> '. $concern_title .'</h2>
                          <h6>Concern by : '. $email .'</h6>
                          <h6 class="text-danger mb-5"> '. $date .'</h6>
                          <p class="mb-5">'. $concern_msg .'</p>
                        </div>
                        <div class="col-md-6 mb-5">
                          <h3 class="text-success">Feedback Completed</h3>
                          <form method="post">
                            <textarea  name="admin_feedback" rows="15" placeholder="'.$placeholder.'" class="responsive_textarea" readonly>
                            '.$admin_feedback.'
                            </textarea>
                            <input type="submit" name="undo" value="Undo feedback" class="btn btn-danger mt-2" onclick="return confirm(\'Are you sure you want to undo?\')">
                          </form>
                        </div>
                      </div>
                    ';
                    }
                    $stmt->close();
                    
                  }
                ?>
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