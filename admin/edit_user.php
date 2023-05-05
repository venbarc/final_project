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
    EDIT USER | LEARNING ERA
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

                <?php
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];

                        $sql_edit = "select * from users where id = '$id' ";
                        $res_edit = mysqli_query($conn, $sql_edit);
                        $row = mysqli_fetch_assoc($res_edit);

                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        $special = $row['special'];

                        // if update button in pressed 
                        if(isset($_POST['update_user']))
                        {
                          $fname = $_POST['fname'];
                          $lname = $_POST['lname'];
                          $email = $_POST['email'];
                          $contact = $_POST['contact'];
                          $special = $_POST['special'];

                          $sql_update_user = "update users set fname='$fname',
                          lname='$lname', email='$email', contact='$contact', special ='$special' where id='$id' ";
                          $res_update_user = mysqli_query($conn, $sql_update_user);

                          if($res_update_user)
                          {
                            echo'<div class="scs"> Successfully Updated.</div>';
                          }
                        }

                        ?>
                        <form method="post" style="padding: 0 10%;">

                            <div class="row">
                                <!-- first name  -->
                                <div class="col-md-4">
                                    <label class="form-label" for="fname">First Name</label>
                                    <input class="form-control" type="text" name="fname" id="fname" value="<?php echo $fname ?>" required>
                                </div>
                                <!-- Last name  -->
                                <div class="col-md-4">
                                    <label class="form-label" for="lname">Last Name</label>
                                    <input class="form-control" type="text" name="lname" id="lname" value="<?php echo $lname ?>" required>
                                </div>
                                <!-- email name  -->
                                <div class="col-md-4">
                                    <label class="form-label" for="email">Email </label>
                                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email ?>" required>
                                </div>
                                <!-- contact name  -->
                                <div class="col-md-6">
                                    <label class="form-label" for="contact">Contact </label>
                                    <input class="form-control" type="contact" minlength="11" maxlength="11" name="contact" id="contact" value="<?php echo (isset($contact) && !empty($contact)) ? htmlspecialchars($contact) : ''; ?>" placeholder="Add Contact">
                                </div>
                                <!-- Specialization name  -->
                                <div class="col-md-6">
                                    <label class="form-label" for="special">Specialization </label>
                                    <input class="form-control" type="text" name="special" id="special" value="<?php echo (isset($special) && !empty($special)) ? htmlspecialchars($special) : ''; ?>" placeholder="Add Specialization">
                                </div>
                                <!-- //submit and cancel btns  -->
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary mt-5 mb-5" value="Update User" name="update_user">
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php" class="btn btn-danger mt-5 mb-5"> Cancel </a>
                                </div>
                            </div>
                            

                        </form>
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