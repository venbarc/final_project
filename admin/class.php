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
    CLASS | LEARNING ERA
  </title>

  <?php
    include "../connect.php";
    include "head_links.php"
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
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Classes</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <!-- professor table here  -->
                <?php
                  // select all from prof class db 
                  $sql_prof = "select * from prof_class";
                  $res_prof = mysqli_query($conn, $sql_prof);

                  if($res_prof->num_rows > 0)
                  {
                    echo'
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Professors Email</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Professors Name</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Student Email</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Student First Name</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Student Last Name</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Student Gender</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Subject</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Subject ID</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Approval Status</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Scores</th>
                        </tr>
                      </thead>
                    <tbody>
                    ';
                    while($row = $res_prof->fetch_assoc())
                    {
                      $prof_email = $row['prof_email'];
                      $prof_name = $row['prof_name'];
                      $student_email = $row['student_email'];
                      $student_fname = $row['student_fname'];
                      $student_lname = $row['student_lname'];
                      $student_gender = $row['student_gender'];
                      $subject = $row['subject'];
                      $subject_ID = $row['subject_token'];
                      $image_upload = $row['image_upload'];
                      $approval = $row['approval'];
                      $score = $row['score'];

                        // approval display message 
                      if($approval == 1)
                      {
                        $approval = ' <span class="badge badge-sm bg-gradient-success">Approved</span>';
                      }
                      else
                      if($approval == 0)
                      {
                        $approval = ' <span class="badge badge-sm bg-gradient-warning">Pending</span>';
                      }
                      else{
                        $approval = ' <span class="badge badge-sm bg-gradient-danger">Rejected</span>';
                      }
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
                          '.$prof_email.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$prof_name.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$student_email.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$student_fname.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$student_lname.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$student_gender.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$subject.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$subject_ID.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$approval.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$score.'
                        </td>
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


 <?php
  include "script_links.php";
 ?>
</body>

</html>