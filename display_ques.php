<!DOCTYPE html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>View Display questions | Learning E.R.A</title>
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
        else{
            header("Location: login.php");
        }
        
        ?>

            <!-- ========================= hero2-section-wrapper-2 start ========================= -->
            <section id="home" class="hero2-section-wrapper-2">

            <?php
                include "navbar.php";
            ?>

            <section id="view_quiz" class="view_quiz-section view_quiz-style-1">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section-title mb-60">

                                <?php

                                    if(isset($_GET['subject']) && isset($_GET['subject_token']) && isset($_GET['quiz_token']) && isset($_GET['quiz_title']))
                                    {
                                        $subject = $_GET['subject'];
                                        $subject_token = $_GET['subject_token'];
                                        $quiz_token = $_GET['quiz_token'];
                                        $quiz_title = $_GET['quiz_title'];

                                        echo'
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a href="view_quiz.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_title='.$quiz_title.'&quiz_token='.$quiz_token.'"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                                    <br>
                                                </div>
                                                <div class="col-md-11 mb-20">
                                                   <h2>Display Questions</h2>
                                                </div>
                                            </div>
                                        ';

                                        ?>
                                            <?php
                                                //get quiz display data 
                                                $sql_quiz_display = "select * from quiz_display where subject='$subject' and  subject_token='$subject_token' and quiz_token='$quiz_token' and prof_email='$email' ";
                                                $res_quiz_display = mysqli_query($conn, $sql_quiz_display);
                                                $count = 1;

                                                if($res_quiz_display->num_rows > 0)
                                                {
                                                    ?>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Question</th>
                                                                <th scope="col">Option 1</th>
                                                                <th scope="col">Option 2</th>
                                                                <th scope="col">Option 3</th>
                                                                <th scope="col">Option 4</th>
                                                                <th scope="col">Answer</th>
                                                                <th scope="col">Image</th>
                                                            </tr>
                                                        </thead>
                                                    <?php
                                                    while($row = $res_quiz_display->fetch_assoc())
                                                    {
                                                        $question = $row['question'];
                                                        $opt1 = $row['opt1'];
                                                        $opt2 = $row['opt2'];
                                                        $opt3 = $row['opt3'];
                                                        $opt4 = $row['opt4'];
                                                        $answer = $row['answer'];
                                                        $image = $row['image'];

                                                        // Get the tools 
                                                        $text_tool = $row['text_tool'];
                                                        $color_tool = $row['color_tool'];
                                                        $img_tool = $row['img_tool'];
                                                        
                                                        ?>
                                                            
                                                            <tbody>
                                                                <tr>
                                                                    <td data-label="#"><?php echo $count++ ?></td>
                                                                    <td data-label="Question">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$question.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 1">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt1.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 2">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt2.'</'.$text_tool.'>'; ?>    
                                                                    </td>
                                                                    <td data-label="Option 3">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt3.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 4">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt1.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Answer">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$answer.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Image">
                                                                        <?php
                                                                            if(empty($image))
                                                                            {
                                                                                echo 'No image';
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <img src="<?php echo $image ?>" width="<?php echo $img_tool ?>" height="<?php echo $img_tool ?>">
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        <?php
                                                    }
                                                    ?>
                                                    </table>
                                                    <?php

                                                }
                                                else
                                                {
                                                    ?>
                                                        <br>
                                                        <h3 style="color: white; background: rgb(0,0,0,0.4); text-align: center; padding:3%;"> No Records </h3>
                                                    <?php
                                                }
                                            
                                            ?>
                                        
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
