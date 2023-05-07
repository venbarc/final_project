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
    LEARNING ERA | ADMIN
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
        <!-- database  -->
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Database Manager</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <!-- database table here  -->

                    <?php
                      // database
                      $sql = "SELECT table_name 'Table Name',
                      round(((data_length + index_length) / 1024 / 1024), 2) 'Table Size (MB)'
                      FROM information_schema.TABLES
                      WHERE table_schema = 'final_project'
                      ORDER BY `Table Size (MB)` DESC";
                      $result = mysqli_query($conn, $sql);

                      // Prepare data for chart
                      $data = array();
                      while ($row = mysqli_fetch_assoc($result)) 
                      {
                          $data[] = array($row['Table Name'], floatval($row['Table Size (MB)']));
                      }

                      // script 
                      ?>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {packages: ['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Table Name');
                                data.addColumn('number', 'Table Size (MB)');
                                data.addRows(<?php echo json_encode($data); ?>);

                                var options = {
                                  title: 'Table Sizes in MB database',
                                  legend: {position: 'none'},
                                  chartArea: {width: '80%', height: '80%'},
                                  hAxis: {title: 'Table Name'},
                                  vAxis: {
                                      title: 'Table Size (MB)',
                                      viewWindow: {
                                          min: 0
                                      }
                                  },
                                  colors: ['#444']
                                };

                                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>

                      <div id="chart_div" style="width: 100%; height: 500px;"></div>
                      
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- professor  -->
        <div class="row">
          <div class="col-12">
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
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Gender</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Contact</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Specialization</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date Registered</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Edit</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
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
                        $gender = $row['gender'];
                        $contact = $row['contact'];
                        $special = $row['special'];
                        $image_upload = $row['image_upload'];
                        $date_reg = $row['date_reg'];

                        $activation = $row['activation'];
                        
                        //if image is empty
                        if(empty($image_upload))
                        {
                          $image_upload = 'No image';
                        }
                        else
                        {
                          $image_upload = '<img src="../'.$image_upload.'" class="avatar avatar-sm me-3 border-radius-lg">';
                        }
                        // if contact is empty 
                        if(empty($contact))
                        {
                          $contact = '<span class="text-danger font-weight-bold text-xl">---</span>';
                        }
                        else{
                          $contact = $row['contact'];
                        }
                        // if special is empty 
                        if(empty($special))
                        {
                          $special = '<span class="text-danger font-weight-bold text-xl">---</span>';
                        }
                        else{
                          $special = $row['special'];
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
                            '.$gender.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$contact.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$special.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$date_reg.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            <a href="edit_user.php?id='.$id.'" class="align-middle text-center text-sm pt-3 text-primary">Edit</a>
                          </td>
                          ';
                          if($activation == 1)
                          {
                            echo'
                            <td class="align-middle text-center text-sm pt-3">
                              <a href="disable_user.php?id='.$id.'" onclick="return confirm(\' Are you sure you want to disable this record? \')" class="align-middle text-center text-sm pt-3 text-danger">
                                Disable
                              </a>
                            </td>
                            ';
                          }
                          else if($activation == 2)
                          {
                            echo'
                            <td class="align-middle text-center text-sm pt-3">
                              <a href="enable_user.php?id='.$id.'" onclick="return confirm(\' Are you sure you want to enable this record? \')" class="align-middle text-center text-sm pt-3 text-success">
                                Enable
                              </a>
                            </td>
                            ';
                          }
                        echo'  
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
        <!-- students  -->
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
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Gender</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Contact</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Specialization</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date Registered</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Edit</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
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
                        $gender = $row['gender'];
                        $contact = $row['contact'];
                        $special = $row['special'];
                        $image_upload = $row['image_upload'];
                        $date_reg = $row['date_reg'];

                        $activation = $row['activation'];
                        
                        //if image is empty
                        if(empty($image_upload))
                        {
                          $image_upload = 'No image';
                        }
                        else
                        {
                          $image_upload = '<img src="../'.$image_upload.'" class="avatar avatar-sm me-3 border-radius-lg">';
                        }
                        // if contact is empty 
                        if(empty($contact))
                        {
                          $contact = '<span class="text-danger font-weight-bold text-xl">---</span>';
                        }
                        else{
                          $contact = $row['contact'];
                        }
                        // if special is empty 
                        if(empty($special))
                        {
                          $special = '<span class="text-danger font-weight-bold text-xl">---</span>';
                        }
                        else{
                          $special = $row['special'];
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
                            '.$gender.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$contact.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$special.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            '.$date_reg.'
                          </td>
                          <td class="align-middle text-center text-sm pt-3">
                            <a href="edit_user.php?id='.$id.'" class="align-middle text-center text-sm pt-3 text-primary">Edit</a>
                          </td>
                          ';
                          if($activation == 1)
                          {
                            echo'
                            <td class="align-middle text-center text-sm pt-3">
                              <a href="disable_user.php?id='.$id.'" onclick="return confirm(\' Are you sure you want to disable this record? \')" class="align-middle text-center text-sm pt-3 text-danger">
                                Disable
                              </a>
                            </td>
                            ';
                          }
                          else if($activation == 2)
                          {
                            echo'
                            <td class="align-middle text-center text-sm pt-3">
                              <a href="enable_user.php?id='.$id.'" onclick="return confirm(\' Are you sure you want to enable this record? \')" class="align-middle text-center text-sm pt-3 text-success">
                                Enable
                              </a>
                            </td>
                            ';
                          }
                        echo'  
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