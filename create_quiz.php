<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Create Quiz | Learning E.R.A</title>
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

        <!-- ========================= hero2-section-wrapper-2 start ========================= -->
        <section id="home" class="hero2-section-wrapper-2">

          <?php
            include "navbar.php";
          ?>

          <section id="create_quiz" class="create_quiz-section create_quiz-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                          <?php
                            // get subject and subject_token ids 
                            if(isset($_GET['subject']) && isset($_GET['subject_token']) && isset($_GET['quiz_title']) && isset($_GET['quiz_token']))
                            {
                              $subject = $_GET['subject'];
                              $subject_token = $_GET['subject_token'];
                              $quiz_title = $_GET['quiz_title'];
                              $quiz_token = $_GET['quiz_token'];
                            }
                           
                            // if form is submitted 
                            if(isset($_POST['submit_quiz'])) // if submit quiz
                            {
                              //posted from form
                              $question = $_POST['question'];
                              $opt1 = $_POST['opt1'];
                              $opt2 = $_POST['opt2'];
                              $opt3 = $_POST['opt3'];
                              $opt4 = $_POST['opt4'];
                              $answer = $_POST['answer'];

                              $upload_img_quiz = '';

                              //if not posted provide default in tools
                              if(isset($_POST['text_tool']))
                              {
                                $post_text_tool = $_POST['text_tool'];
                              }
                              else{
                                $post_text_tool = 'p';
                              }

                              if(isset($_POST['color_tool']))
                              {
                                $post_color_tool = $_POST['color_tool'];
                              }
                              else{
                                $post_color_tool = 'black';
                              }

                              if(isset($_POST['img_tool']))
                              {
                                $post_img_tool = $_POST['img_tool'];
                              }
                              else{
                                $post_img_tool = '100';
                              }
                              

                              if(isset($_FILES['upload_img_quiz']) && $_FILES['upload_img_quiz']['error'] != 4) //if file is empty allow user
                              {
                                // upload image code
                                $upload_ext = strtolower(pathinfo($_FILES['upload_img_quiz']['name'], PATHINFO_EXTENSION)); 
                                $upload_name = 'img-quiz' . rand(100000, 900000) . '.' . $upload_ext; 
                                $upload_img_quiz = 'uploads/' . $upload_name; 
                                if (!in_array($upload_ext, array('jpg', 'jpeg', 'png'))) 
                                {
                                  echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Only JPG, JPEG, and PNG files are allowed.</div>';
                                }
                                else if ($_FILES['upload_img_quiz']['size'] > 5000000) 
                                {
                                  echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Maximum file size is 5MB.</div>';
                                }
                                else if (!move_uploaded_file($_FILES['upload_img_quiz']['tmp_name'], $upload_img_quiz)) 
                                {
                                  echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Error Occurred. Please try again later!</div>';
                                }
                              }

                              // insert data question 
                              $sql_add_ques = "insert into quiz (prof_email, subject, subject_token, question, opt1, opt2, opt3, opt4, answer, image, text_tool, color_tool, img_tool, quiz_token) values 
                              ('$email','$subject','$subject_token','$question','$opt1','$opt2','$opt3','$opt4', '$answer','$upload_img_quiz','$post_text_tool','$post_color_tool','$post_img_tool', '$quiz_token' )" ;
                              $res_add_ques = mysqli_query($conn, $sql_add_ques);

                              if($res_add_ques)
                              {
                                echo '
                                  <div class="alert alert-success text-center" role="alert" id="myAlert">
                                    Successfully added question in '. $subject.'
                                  </div>
                                  ';
                              }
                              else
                              {
                                echo '
                                  <div class="alert alert-danger text-center" role="alert" id="myAlert">
                                    Something went wrong, pls try again!
                                  </div>
                                  ';
                              }

                            }
                            

                          ?>

                          <form method="post" enctype="multipart/form-data">
                            <div class="row">
                              
                              <div class="col-md-6">

                                <div class="row">
                                  <div class="col-md-2">
                                    <a href="view_add_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                    <br>
                                  </div>
                                  <div class="col-md-10">
                                    <h3><?php echo  '<span class="text-primary">'. $subject .'</span> | '. $quiz_title ?></h3>
                                  </div>
                                </div>

                                <br>  
                                  <!-- forms here  -->

                                  <!-- Questions and add image  -->
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label for="ques" class="form-label"><strong>Question</strong> </label>
                                      <textarea type="text" id="ques" class="form-control" placeholder="question here.." name="question" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="add_img" class="form-label pt-20"><strong>Add image</strong> 
                                        <input type="file" id="add_img" value="Upload Photo" name="upload_img_quiz">
                                      </label>
                                    </div>

                                    <!-- options  -->
                                    <div class="col-md-6">
                                      <label for="opt1" class="form-label pt-20"><strong>Option 1</strong> </label>
                                      <input type="text" id="opt1" class="form-control" placeholder="Option 1" name="opt1" required>
                                      <label for="opt2" class="form-label pt-20"><strong>Option 2</strong> </label>
                                      <input type="text" id="opt2" class="form-control" placeholder="Option 2" name="opt2" required>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="opt3" class="form-label pt-20"><strong>Option 3</strong> </label>
                                      <input type="text" id="opt3" class="form-control" placeholder="Option 3" name="opt3" required>
                                      <label for="opt4" class="form-label pt-20"><strong>Option 4</strong> </label>
                                      <input type="text" id="opt4" class="form-control" placeholder="Option 4" name="opt4" required>
                                    </div>

                                    <!-- answer  -->
                                    <div class="col-md-6">
                                      <label for="ans" class="form-label pt-20"><strong>Answer</strong> </label>
                                      <input type="text" id="ans" class="form-control" placeholder="Answer here.." name="answer" required>
                                    </div>

                                  </div>
                                  
                                  <br>
                                  <input type="submit" value="Add Question" class="btn btn-primary" name="submit_quiz">

                              </div>

                              <div class="col-md-6">

                                <div class="row">
                                  <div class="col-md-4 pt-20">
                                    <h6>Text <span class="text-danger">*</span></h6>
                                    <!-- tool type 1  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="p" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>Paragraph</p></div>
                                    </label>
                                    <!-- tool type 2  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h1" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 1</p></div>
                                    </label>
                                    <!-- tool type 3  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h2" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 2</p></div>
                                    </label>
                                    <!-- tool type 4  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h3" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 3</p></div>
                                    </label>
                                    <!-- tool type 5  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h4" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 4</p></div>
                                    </label>
                                    <!-- tool type 6  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h5" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 5</p></div>
                                    </label>
                                    <!-- tool type 6  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h6" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p>header 6</p></div>
                                    </label>
                                  </div>

                                  <div class="col-md-4 pt-20">
                                    <h6>Color<span class="text-danger">*</span></h6>
                                    <!-- tool type 1  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#dc3545" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-danger">Red</p></div>
                                    </label>
                                    <!-- tool type 2  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#28a745" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-success">Green</p></div>
                                    </label>
                                    <!-- tool type 3  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#007bff" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-primary">Blue</p></div>
                                    </label>
                                    <!-- tool type 4  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#ffc107" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-warning">Orange</p></div>
                                    </label>
                                    <!-- tool type 5  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#6c757d" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-secondary">Gray</p></div>
                                    </label>
                                    <!-- tool type 6  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="black" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-dark">Black</p></div>
                                    </label>
                                        <!-- tool type 7 -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#17a2b8" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p class="text-info">Sky blue</p></div>
                                    </label>
                                  </div>

                                  <div class="col-md-4 pt-20">
                                    <h6>Image size</h6>
                                    <!-- tool type 1  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="50" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 50 x 50</p></div>
                                    </label>
                                    <!-- tool type 2  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="100" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 100 x 100</p></div>
                                    </label>
                                    <!-- tool type 3  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="150" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 150 x 150</p></div>
                                    </label>
                                    <!-- tool type 4  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="200" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 200 x 200</p></div>
                                    </label>
                                    <!-- tool type 5  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="250" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 250 x 250</p></div>
                                    </label>
                                    <!-- tool type 6  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="300" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 300 x 300</p></div>
                                    </label>
                                    <!-- tool type 7  -->
                                    <label class="rad-label">
                                        <input type="radio" class="rad-input form-control" name="img_tool" value="350" >
                                        <div class="rad-design"></div>
                                        <div class="rad-text"><p> 350 x 350</p></div>
                                    </label>
                                  </div>
                                </div>

                              </div>
                            </div>

                            

                          </form>

                        </div>
                    </div>
                </div>
            </div>

          </section>

        </section>
        <!-- ========================= hero2-section-wrapper-2 start ========================= -->

    

    <?php
      }
      else
      {
        header("Location: login.php");
      }
    
    ?>
        
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
