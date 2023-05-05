<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Help Center | Learning E.R.A</title>
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

    <!-- ========================= hero2-section-wrapper-2 start ========================= -->
    <section id="home" class="hero2-section-wrapper-2">

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
          ?>
            <script>
              location.href = "login.php";
            </script>
          <?php
        }

      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero2-section hero2-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-12">
              <div class="hero2-content-wrapper">
                <?php
                  // if submit concern is pressed 
                  if(isset($_POST['submit_concern']))
                  {
                    $concern_msg = $_POST['concern_msg'];
                    $concern_title = $_POST['concern_title'];

                    // insert into concern database 
                    $stmt = $conn->prepare('insert into concerns (email,concern_title, concern_msg) values (?,?,?)');
                    $stmt->bind_param('sss', $email, $concern_title, $concern_msg);
                    $stmt->execute();

                    if($stmt->affected_rows > 0)
                    {
                      echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                              Concern successfully submitted, give us time to check and will be giving feed back thanks.
                            </div>';
                    }
                    else
                    {
                      echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                              Something went wrong pls try again!
                            </div>';
                    }
                    $stmt->close();
                  }
                ?>
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">TELL US YOUR CONCERNS</h2>
                        <form method="post" enctype="multipart/form-data">
                            <!-- concern title input text  -->
                            <input type="text" name="concern_title" class="responsive_textarea mb-2 wow fadeInUp" placeholder="Concern Subject" data-wow-delay=".5s" required>
                            <!-- Concern img  -->
                            <!-- <div class="my-2 py-2">
                              <input class="form-control custom-file-upload" type="file">
                            </div> -->
                            <!-- concern text area  -->
                            <textarea  name="concern_msg" rows="10" id="myTextarea" maxlength="500" placeholder="Enter your Concerns here..." class="responsive_textarea wow fadeInUp" data-wow-delay=".6s" required></textarea>
                            <!-- visually count of total characters -->
                            <div id="charCount"> 500 / 500 </div>
                            <!-- submit concern s -->
                            <input type="submit" name="submit_concern" value="Submit" class="btn btn-primary mt-20 wow fadeInUp" data-wow-delay=".7s" 
                            onclick="return confirm('Are you sure you want to submit your concern? please review cause changes cannot be made.')">
                        </form>
                    </div>  
                    <div class="col-md-5 wow fadeInUp" data-wow-delay="1s">
                        <img src="assets/img/help/help.png" class="responsive-img">
                    </div>
                </div>

                <div class="row pt-100 wow fadeInUp" data-wow-delay=".8s">
                  <div class="col-md-12">
                    <h3>Concerns:</h3>
                    <?php
                      // get data in concern db 
                      $stmt_concern = $conn->prepare("select * from concerns where email  = ? ");
                      $stmt_concern->bind_param('s', $email);
                      $stmt_concern->execute();
                      $res_concern = $stmt_concern->get_result();

                      if($res_concern->num_rows > 0)
                      {
                        echo'<div class="row mb-3">';
                          while($row = $res_concern->fetch_assoc())
                          {
                            $email = $row['email'];
                            $concern_title = $row['concern_title'];
                            $concern_msg = $row['concern_msg'];
                            $date = $row['date'];
                            $admin_feedback = $row['admin_feedback'];

                            // check if admin feedback is empty 
                            if(empty($admin_feedback))
                            {
                              $admin_feedback = '<a href="feedback.php?id='.$row['id'].'" class="btn btn-warning mb-3">
                                                  Pending Feedback
                                                </a>';
                            }
                            else
                            {
                              $admin_feedback = '<a href="feedback.php?id='.$row['id'].'" class="btn btn-primary mb-3">
                                                  View Feedbacks
                                                </a>';
                            }

                            echo'
                                <div class="col-md-12">
                                  <h6 class="text-danger">'.$date.'</h6>
                                  <h4 class="text-dark mb-2">'. $concern_title .'</h4> 
                                  <p class="text-dark mb-2">'. $concern_msg .'</p> 
                                  '.$admin_feedback.'
                                  <div style="border-bottom: 1px solid red;" class="mb-4"></div>
                                </div>
                              
                            ';
                          }
                        echo'</div>';
                      }
                      else{
                        ?>
                          <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                        <?php
                      }
                      $stmt_concern->close();
                    ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- ========================= Home end ========================= -->

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

            //text area 500 length character 
            const textarea = document.getElementById('myTextarea');
            const charCount = document.getElementById('charCount');

            textarea.addEventListener('input', () => {
            const remainingChars = 500 - textarea.value.length;
            charCount.textContent = `${remainingChars}/ 500`;
            });

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
