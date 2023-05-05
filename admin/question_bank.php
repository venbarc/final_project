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
    QUESTION BANK | LEARNING ERA
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
                <h6 class="text-white text-capitalize ps-3">Question Bank</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <?php
                  // select all questions in quiz db 
                  $sql_quiz = "select * from quiz";
                  $res_quiz = mysqli_query($conn, $sql_quiz);
                  $count = 1;

                  if($res_quiz->num_rows > 0)
                  {
                    echo'
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Professors Email</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Subject</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Subject ID</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Question</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Option 1</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Option 2</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Option 3</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Option 4</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Answer</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Image</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Text Tools</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Color Tools</th>
                          <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Image Tools</th>
                        </tr>
                      </thead>
                    <tbody>
                    ';
                    while($row = $res_quiz->fetch_assoc())
                    {
                      $id = $row['id'];
                      $prof_email = $row['prof_email'];
                      $subject = $row['subject'];
                      $subject_token = $row['subject_token'];
                      $question = $row['question'];
                      $opt1 = $row['opt1'];
                      $opt2 = $row['opt2'];
                      $opt3 = $row['opt3'];
                      $opt4 = $row['opt4'];
                      $answer = $row['answer'];
                      $image = $row['image'];
                      $text_tool = $row['text_tool'];
                      $color_tool = $row['color_tool'];
                      $img_tool = $row['img_tool'];
                      
                      //if image is empty
                      if(empty($image))
                      {
                        $image = 'No image';
                      }
                      else
                      {
                        $image = $row['image'];
                      }
                      
                      echo'
                      <tr>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$count++.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$prof_email.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$subject.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$subject_token.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$question.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$opt1.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$opt2.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$opt3.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$opt4.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$answer.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$image.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$text_tool.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$color_tool.'
                        </td>
                        <td class="align-middle text-center text-sm pt-3">
                          '.$img_tool.'
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