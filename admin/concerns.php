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
    Concerns | LEARNING ERA
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
              <h5 class="mb-0">User Concerns</h5>
            </div>
            <div class="card-body p-3 pb-0">
              <?php
                // get data of concerns in db 
                $stmt_get_concern = $conn->prepare("select * from concerns");
                $stmt_get_concern->execute();
                $res_get_concern = $stmt_get_concern->get_result();

                if($res_get_concern->num_rows > 0)
                {
                  
                  while($row = $res_get_concern->fetch_assoc())
                  {
                    $email = $row['email'];
                    $concern_title = $row['concern_title'];
                    $concern_msg = $row['concern_msg'];
                    $date = $row['date'];
                    $admin_feedback = $row['admin_feedback'];
                    $status = '';
                    
                    // check if the concerns have a feed back 
                    if(empty($admin_feedback))
                    {
                        $status = ' <span class="badge badge-sm bg-gradient-danger">Unattended</span>';
                    }else{
                        $status = ' <span class="badge badge-sm bg-gradient-success">Completed</span>';
                    }

                    ?>
                      <a href="concerns_feedback.php?id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                        <div class="alert bg-secondary text-white pop-up">
                          <span class="text-md">
                            <div class="row">
                              <div class="col-md-3 fw-bold">
                                 <?php echo $email?>
                              </div>
                              <div class="col-md-3">
                                <span class="text-md fw-bold">Subject </span>: <br> <?php echo $concern_title ?>
                              </div>
                              <div class="col-md-3">
                                <?php echo $date ?>
                              </div>
                              <div class="col-md-3">
                                <?php echo $status ?>
                              </div>
                            </div>
                          </span>
                        </div>
                      </a>
                    <?php
                  }
                }
                else{
                  ?>
                    <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                  <?php
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