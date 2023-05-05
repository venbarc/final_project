<!DOCTYPE html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Import Question | Learning E.R.A</title>
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
            $special = $user['special'];

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
                                    //Get subject_token and subject 
                                    if(isset($_GET['subject']) && isset($_GET['subject_token']) && isset($_GET['quiz_title']) && isset($_GET['quiz_token']))
                                    {
                                        $subject = $_GET['subject'];
                                        $subject_token = $_GET['subject_token'];
                                        $quiz_token_url = $_GET['quiz_token'];
                                        $quiz_title = $_GET['quiz_title'];


                                        echo'
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a href="view_quiz.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_title='.$quiz_title.'&quiz_token='.$quiz_token_url.'"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                                    <br>
                                                </div>
                                                <div class="col-md-5 mb-20">
                                                    <h3  class="text-primary">'. $subject.' | <span class="text-dark"> Question Bank </span></h3>
                                                </div>  
                                            </div>
                                        ';

                                        //if import is pressed
                                        if(isset($_POST['import']))
                                        {
                                            $import = $_POST['import'];

                                            foreach($import as $imports)
                                            {
                                                // select the specific question first
                                                $stmt = $conn->prepare("select * from quiz where id = ? ");
                                                $stmt->bind_param('s', $imports); 
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                $row = mysqli_fetch_assoc($res);

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
                                                $stmt->close();   

                                                $stmt = $conn->prepare("insert into quiz (prof_email, subject, subject_token, question, opt1, opt2, 
                                                opt3, opt4, answer, image, text_tool, color_tool, img_tool, quiz_token) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                $stmt->bind_param('ssssssssssssss', $email, $subject, $subject_token, $question, $opt1, $opt2, 
                                                $opt3, $opt4, $answer, $image, $text_tool, $color_tool, $img_tool, $quiz_token_url);

                                                $stmt->execute();

                                                if($stmt->affected_rows > 0)
                                                {
                                                   $success = true;
                                                }
                                                $stmt->close();
                                            }

                                            if($success)
                                            {
                                                echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                                                            Successfully Imported question.
                                                        </div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                                                            Something went wrong pls try again.
                                                        </div>';
                                            }

                                        }

                                        
                                        ?>
                                            <?php
                                                $stmt = $conn->prepare("select * from quiz_type where subject_token = ? and quiz_token != ?");
                                                $stmt->bind_param('ss', $subject_token, $quiz_token_url);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                
                                                if($res->num_rows > 0)
                                                {
                                                    echo'
                                                        <form method="post">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-30">
                                                                    <button class="btn btn-primary">
                                                                        All Questions
                                                                    </button>
                                                                </div>
                                                    ';
                                                    while($row = $res->fetch_assoc())
                                                    {

                                                        $quiz_title = $row['quiz_title'];
                                                        $quiz_token = $row['quiz_token'];

                                                        echo '
                                                            <div class="col-md-2 mb-30">
                                                                <button type="submit" name="filter" value="'.$quiz_token.'" class="btn btn-primary">
                                                                    '.$quiz_title.'
                                                                </button>
                                                            </div>
                                                        </form>
                                                        ';
                                                       
                                                    }
                                                    echo'
                                                    </div>
                                                    ';
                                                }
                                                $stmt->close();

                                                //if filter is posted
                                                if(isset($_POST['filter']))
                                                {
                                                    $filter = $_POST['filter'];

                                                    $stmt = $conn->prepare("select * from quiz where quiz_token = ? and subject_token = ?");
                                                    $stmt->bind_param('ss', $filter, $subject_token);
                                                    $stmt->execute();
                                                    $res = $stmt->get_result();
                                                    $count = 1;

                                                    if($res->num_rows > 0)
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
                                                                        <th scope="col">Import</th>
                                                                    </tr>
                                                                </thead>
                                                        <?php
                                                        while($row = $res->fetch_assoc())
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
                                                                        <td>
                                                                            <!-- START FORM FOR IMPORT  -->
                                                                            <form method="post">
                                                                                <input type="checkbox" name="import[]" value="<?php echo $row['id']; ?>" id="question_<?php echo $row['id']; ?>" class="btn-check" <?php echo isset($_POST['select_all'])? "checked" : "" ?>>
                                                                                <label class="btn btn-outline-primary" for="question_<?php echo $row['id']; ?>">Import</label>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                </tbody>
                                                            <?php   
                                                        }
                                                        ?>  
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <input type="submit" value="Import" class="btn btn-success mt-10 mb-10">
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <input type="submit" name="select_all" value="Select All" class="btn btn-success mt-10 mb-10">
                                                                                    </div>
                                                                                </div>

                                                                            </form>
                                                                            <!-- END FORM FOR IMPORT  -->
                                                            </table>
                                                        <?php
                                                    }
                                                    $stmt->close();
                                                }
                                                else
                                                {
                                                    $stmt = $conn->prepare("select * from quiz where quiz_token != ? and subject_token = ?");
                                                    $stmt->bind_param('ss', $quiz_token_url, $subject_token);
                                                    $stmt->execute();
                                                    $res = $stmt->get_result();
                                                    $count = 1;

                                                    if($res->num_rows > 0 )
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
                                                                        <th scope="col">Import</th>
                                                                    </tr>
                                                                </thead>
                                                        <?php
                                                        while($row = $res->fetch_assoc())
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
                                                                            <td>
                                                                                <!-- START FORM FOR IMPORT  -->
                                                                                <form method="post">
                                                                                    <input type="checkbox" name="import[]" value="<?php echo $row['id']; ?>" id="question_<?php echo $row['id']; ?>" class="btn-check" <?php echo isset($_POST['select_all'])? "checked" : "" ?>>
                                                                                    <label class="btn btn-outline-primary" for="question_<?php echo $row['id']; ?>">Import</label>
                                                                                    
                                                                            </td>
                                                                    </tr>
                                                                </tbody>
                                                            <?php
                                                            
                                                        }
                                                        ?>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <input type="submit" value="Import" class="btn btn-success mt-10 mb-10">
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <input type="submit" name="select_all" value="Select All" class="btn btn-success mt-10 mb-10">
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </form>
                                                                                <!-- START FORM FOR IMPORT  -->

                                                            </table>
                                                        <?php
                                                    }
                                                    $stmt->close();
                                                    
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
