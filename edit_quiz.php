<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Edit Quiz | Learning E.R.A</title>
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

        }
        else
        {
        header("Location: login.php");
        }

    ?>

        <!-- ========================= hero2-section-wrapper-2 start ========================= -->
        <section id="home" class="hero2-section-wrapper-2">

          <?php
            include "navbar.php";
          ?>

          <section id="edit_quiz" class="edit_quiz-section edit_quiz-style-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title mb-60">

                           <?php
                            //get url section, section_token, subject and id
                            if(isset($_GET['subject']) && isset($_GET['subject_token']) && isset($_GET['quiz_token']) && isset($_GET['id']))
                            {
                                $subject = $_GET['subject'];
                                $subject_token = $_GET['subject_token'];
                                $quiz_token = $_GET['quiz_token'];
                                $quiz_title = $_GET['quiz_title'];

                                $id = $_GET['id'];

                                //get data from quiz database
                                $sql_get_quiz = "select * from quiz where subject='$subject' and subject_token='$subject_token' and id ='$id'";
                                $res_get_quiz = mysqli_query($conn, $sql_get_quiz);
                                $row = mysqli_fetch_assoc($res_get_quiz);
                                $question = $row['question'];
                                $opt1 = $row['opt1'];
                                $opt2 = $row['opt2'];
                                $opt3 = $row['opt3'];
                                $opt4 = $row['opt4'];
                                $answer = $row['answer'];
                                $image = $row['image'];

                                // tools 
                                $text_tool = $row['text_tool'];
                                $color_tool = $row['color_tool'];
                                $img_tool = $row['img_tool'];

//=======================================================Start if update quiz is posted============================================================//
                                if(isset($_POST['update_question']))
                                {
                                    //posted form form
                                    $post_question = $_POST['question'];
                                    $post_opt1 = $_POST['opt1'];
                                    $post_opt2 = $_POST['opt2'];
                                    $post_opt3 = $_POST['opt3'];
                                    $post_opt4 = $_POST['opt4'];
                                    $post_answer = $_POST['answer'];

                                    //if not posted provide default
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

                                    $update_img_quiz = '';
                                    if(isset($_FILES['update_img_quiz']) && $_FILES['update_img_quiz']['error'] != 4) //if file is empty allow user
                                    {
                                        // upload image code
                                        $upload_ext = strtolower(pathinfo($_FILES['update_img_quiz']['name'], PATHINFO_EXTENSION)); 
                                        $upload_name = 'img-quiz' . rand(100000, 900000) . '.' . $upload_ext; 
                                        $update_img_quiz = 'uploads/' . $upload_name; 
                                        if (!in_array($upload_ext, array('jpg', 'jpeg', 'png'))) 
                                        {
                                            echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Only JPG, JPEG, and PNG files are allowed.</div>';
                                        }
                                        else if ($_FILES['update_img_quiz']['size'] > 5000000) 
                                        {
                                            echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Maximum file size is 5MB.</div>';
                                        }
                                        else if (!move_uploaded_file($_FILES['update_img_quiz']['tmp_name'], $update_img_quiz)) 
                                        {
                                            echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">Error Occurred. Please try again later!</div>';
                                        }
                                    }

                                    // insert data question 
                                    $sql_update_ques = "update quiz set question='$post_question', opt1='$post_opt1', opt2='$post_opt2', opt3='$post_opt3',
                                    opt4='$post_opt4', answer='$post_answer', image='$update_img_quiz', text_tool='$post_text_tool', color_tool ='$post_color_tool', img_tool='$post_img_tool' 
                                    where id='$id' and subject='$subject' ";
                                    $res_update_ques = mysqli_query($conn, $sql_update_ques);

                                    if($res_update_ques)
                                    {
                                        ?>
                                            <script>
                                                location.href= "view_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title?>&quiz_token=<?php echo $quiz_token?>";
                                            </script>
                                        <?php
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
//=======================================================End if update quiz is posted============================================================//
                                
                                ?>
                                <form enctype="multipart/form-data" method="post">
                                    
                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <a href="view_quiz.php?subject=<?php echo $subject?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title?>&quiz_token=<?php echo $quiz_token?>">
                                                        <h2><i class="text-primary fa fa-chevron-circle-left"></i></h2>
                                                    </a>
                                                </div>
                                                <div class="col-md-10">
                                                    <h3 class="text-dark">EDIT - <?php echo $subject .' | <span class="text-primary">'. $quiz_title?> </h3>
                                                </div>
                                            </div>

                                            <!-- Questions -->
                                            <label for="ques" class="form-label"><strong>Question</strong> </label>
                                            <textarea type="text" id="ques" class="form-control" name="question" required><?php echo $question ?></textarea>
                                            <!-- options  -->
                                            <label for="opt1" class="form-label pt-20"><strong>Option 1</strong> </label>
                                            <input type="text" id="opt1" class="form-control" value="<?php echo $opt1 ?>" name="opt1" required>
                                            <label for="opt2" class="form-label pt-20"><strong>Option 2</strong> </label>
                                            <input type="text" id="opt2" class="form-control" value="<?php echo $opt2 ?>" name="opt2" required>
                                            <label for="opt3" class="form-label pt-20"><strong>Option 3</strong> </label>
                                            <input type="text" id="opt3" class="form-control" value="<?php echo $opt3 ?>" name="opt3" required>
                                            <label for="opt4" class="form-label pt-20"><strong>Option 4</strong> </label>
                                            <input type="text" id="opt4" class="form-control" value="<?php echo $opt4 ?>" name="opt4" required>
                                            <!-- answer  -->
                                            <label for="ans" class="form-label pt-20"><strong>Answer</strong> </label>
                                            <input type="text" id="ans" class="form-control" value="<?php echo $answer ?>" name="answer" required>
                                            <!-- image  -->
                                            <label for="add_img" class="form-label pt-20"><strong>Upload New image</strong> 
                                                <input type="file" id="add_img" value="<?php echo $image ?>" name="update_img_quiz">
                                            </label>
                                            
                                            <div class="form-label pt-20"></div> 
                                                <?php 
                                                    if(empty($image))
                                                    {
                                                        echo '<h3 class=" text-secondary pt-25"> No image </h3>';
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                            <img src="<?php echo $image?>" width="300" height="300">
                                                        <?php
                                                    }
                                                ?>
                                            </label>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4 pt-20">
                                                    <h6>Text <span class="text-danger">*</span></h6>
                                                    <!-- tool type 1  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="p" <?php echo ($text_tool == 'p') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>Paragraph</p></div>
                                                    </label>
                                                    <!-- tool type 2  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h1" <?php echo ($text_tool == 'h1') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 1</p></div>
                                                    </label>
                                                    <!-- tool type 3  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h2" <?php echo ($text_tool == 'h2') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 2</p></div>
                                                    </label>
                                                    <!-- tool type 4  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h3" <?php echo ($text_tool == 'h3') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 3</p></div>
                                                    </label>
                                                    <!-- tool type 5  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h4" <?php echo ($text_tool == 'h4') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 4</p></div>
                                                    </label>
                                                    <!-- tool type 6  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h5" <?php echo ($text_tool == 'h5') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 5</p></div>
                                                    </label>
                                                    <!-- tool type 6  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="text_tool" value="h6" <?php echo ($text_tool == 'h6') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p>header 6</p></div>
                                                    </label>
                                                </div>

                                                <div class="col-md-4 pt-20">
                                                    <h6>Color <span class="text-danger">*</span></h6>
                                                    <!-- tool type 1  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#dc3545" <?php echo ($color_tool == '#dc3545') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-danger">Red</p></div>
                                                    </label>
                                                    <!-- tool type 2  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#28a745" <?php echo ($color_tool == '#28a745') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-success">Green</p></div>
                                                    </label>
                                                    <!-- tool type 3  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#007bff" <?php echo ($color_tool == '#007bff') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-primary">Blue</p></div>
                                                    </label>
                                                    <!-- tool type 4  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#ffc107" <?php echo ($color_tool == '#ffc107') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-warning">Orange</p></div>
                                                    </label>
                                                    <!-- tool type 5  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#6c757d" <?php echo ($color_tool == '#6c757d') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-secondary">Gray</p></div>
                                                    </label>
                                                    <!-- tool type 6  -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="black" <?php echo ($color_tool == 'black') ? "checked" : "" ?> >
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-dark">Black</p></div>
                                                    </label>
                                                        <!-- tool type 7 -->
                                                    <label class="rad-label">
                                                        <input type="radio" class="rad-input form-control" name="color_tool" value="#17a2b8" <?php echo ($color_tool == '#17a2b8') ? "checked" : "" ?> > 
                                                        <div class="rad-design"></div>
                                                        <div class="rad-text"><p class="text-info">Sky blue</p></div>
                                                    </label>
                                                </div>

                                                <div class="col-md-4 pt-20">
                                                    <h5>Image size</h5>
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
                                       

                                        <div class="col-md-12 pt-60">
                                            <input type="submit" value="Update Question" class="btn btn-primary" name="update_question">
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

            <!-- Form and Submit buttons are inside modals -->
            <?php
                include "modals.php";
            ?>

          </section>

        </section>
        <!-- ========================= hero2-section-wrapper-2 start ========================= -->
        
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
