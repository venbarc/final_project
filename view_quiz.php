    <!DOCTYPE html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>View Quiz | Learning E.R.A</title>
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
                                        $quiz_token = $_GET['quiz_token'];
                                        $quiz_title = $_GET['quiz_title'];

                                        //add quiz questions to display db
                                        if(isset($_POST['add']))
                                        {
                                            $add = $_POST['add'];

                                            foreach($add as $adds)
                                            {
                                                // select the specific question first
                                                $stmt = $conn->prepare("select * from quiz where id = ? ");
                                                $stmt->bind_param('i', $adds); 
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

                                                $stmt = $conn->prepare("insert into quiz_display (prof_email, subject, subject_token, question, 
                                                opt1, opt2, opt3, opt4, answer, image, text_tool, color_tool, img_tool, quiz_token, quiz_id) 
                                                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                $stmt->bind_param('ssssssssssssssi', $email, $subject, $subject_token, $question, 
                                                $opt1 ,$opt2, $opt3, $opt4, $answer, $image, $text_tool, $color_tool, $img_tool, 
                                                $quiz_token, $adds);

                                                $stmt->execute();

                                                if($stmt->affected_rows > 0)
                                                {
                                                   $success = true;
                                                }
                                                $stmt->close();
                                            }
                                            // message 
                                            if($success)
                                            {
                                                echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                                                            Successfully Added questions.
                                                        </div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                                                            Something went wrong pls try again.
                                                        </div>';
                                            }

                                        }
                                        //remove quiz questions to display db
                                        if(isset($_POST['remove']))
                                        {
                                            $remove = $_POST['remove'];

                                            foreach($remove as $removes)
                                            {
                                                // select the specific question first
                                                $stmt = $conn->prepare("delete from quiz_display where quiz_id = ? ");
                                                $stmt->bind_param('i', $removes); 
                                                $stmt->execute();

                                                if($stmt->affected_rows > 0)
                                                {
                                                   $success = true;
                                                }
                                                
                                                $stmt->close();
                                            }
                                            // message 
                                            if($success)
                                            {
                                                echo '<div class="alert alert-success text-center" role="alert" id="myAlert">
                                                            Successfully removed questions.
                                                        </div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                                                            Something went wrong pls try again.
                                                        </div>';
                                            }
                                        }
                                        //get id and Delete quiz
                                        if(isset($_GET['id']))
                                        {
                                            $id = $_GET['id'];

                                            $sql_delete_quiz = "delete from quiz where id ='$id' ";
                                            $res_delete_quiz = mysqli_query($conn, $sql_delete_quiz);

                                            $sql_delete_quiz2 = "delete from quiz_display where quiz_id ='$id' ";
                                            $res_delete_quiz2 = mysqli_query($conn, $sql_delete_quiz2);

                                            if($res_delete_quiz)
                                            {
                                                echo'
                                                    <script>
                                                        location.href = "view_quiz.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_title='.$quiz_title.'&quiz_token='.$quiz_token.'";
                                                    </script>
                                                ';
                                            }
                                            else
                                            {
                                                echo '<div class="alert alert-danger text-center" role="alert" id="myAlert">
                                                            Something went wrong, pls try again!
                                                        </div>';
                                            }
                                        }

                                        //count all questions in quiz db
                                        $sql_count_quiz = "Select count(*) from quiz where subject='$subject' and subject_token ='$subject_token' and quiz_token='$quiz_token' and prof_email='$email' ";
                                        $res_count_quiz = mysqli_query($conn, $sql_count_quiz);

                                        if($res_count_quiz)
                                        {
                                            $count_quiz = mysqli_fetch_array($res_count_quiz)[0];
                                        }
                                        else{
                                            $count_quiz = 0;
                                        }

                                        //count all questions in quiz display db
                                        $sql_count_quiz_dis = "Select count(*) from quiz_display where subject='$subject' and subject_token ='$subject_token' and quiz_token='$quiz_token' and prof_email='$email' ";
                                        $res_count_quiz_dis = mysqli_query($conn, $sql_count_quiz_dis);

                                        if($res_count_quiz_dis)
                                        {
                                            $count_quiz_dis = mysqli_fetch_array($res_count_quiz_dis)[0];
                                        }
                                        else{
                                            $count_quiz_dis = 0;
                                        }

                                        echo'
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="pb-25">Question Bank</h2>
                                            </div>
                                            <div class="col-md-3 mt-3 mb-20">
                                                <a href="import_question.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_token='.$quiz_token.'&quiz_title='.$quiz_title.'" class="btn btn-success">
                                                    <i class="fas fa-file-import"></i> &nbsp; Import Question
                                                </a>
                                            </div>
                                            <div class="col-md-3 mt-3 mb-20">
                                                <a href="hard_copy.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_token='.$quiz_token.'&quiz_title='.$quiz_title.'" class="btn btn-dark">
                                                    <i class="fas fa-file"></i> &nbsp; Generate Hard Copy
                                                </a>
                                            </div>
                                        </div>
                                        ';

                                        echo'
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <a href="view_add_quiz.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_token='.$quiz_token.'"><h2><i class="text-primary fa fa-chevron-circle-left"></i></h2></a>
                                                    <br>
                                                </div>
                                                <div class="col-md-5 mb-20">
                                                    <h3 class="text-primary">'. $subject.' | <span class="text-dark">'. $quiz_title .' ('.$count_quiz.') </span></h3>
                                                </div>  
                                                <div class="col-md-3 mb-20">
                                                    <a href="display_ques.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_token='.$quiz_token.'&quiz_title='.$quiz_title.'" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i> &nbsp; View Displayed Questions ('.$count_quiz_dis.')
                                                    </a>
                                                </div>
                                                <div class="col-md-3 mb-20">
                                                    <a href="most_mistake.php?subject='.$subject.'&subject_token='.$subject_token.'&quiz_token='.$quiz_token.'&quiz_title='.$quiz_title.'" class="btn btn-danger">
                                                        <i class="fas fa-file-excel"></i> &nbsp; Most Mistaken Questions
                                                    </a>
                                                </div>
                                            </div>
                                        ';
                                        
                                        ?>
                                            <?php
                                                //get subject data for specific prof 
                                                $sql_subject_data = "select * from quiz where subject='$subject' and  subject_token='$subject_token' and quiz_token='$quiz_token' and prof_email='$email' ";
                                                $res_subject_data = mysqli_query($conn, $sql_subject_data);
                                                $count = 1;

                                                if($res_subject_data->num_rows > 0) 
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
                                                                <th scope="col">Edit </th>
                                                                <th scope="col">Delete</th>
                                                                <th scope="col">Add</th>
                                                            </tr>
                                                        </thead>
                                                    <?php
                                                    while($row = $res_subject_data->fetch_assoc())
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
                                                                    <td data-label="Question" class="limit-length" title="<?php echo $question ?>">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$question.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 1" class="limit-length" title="<?php echo $opt1 ?>">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt1.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 2" class="limit-length" title="<?php echo $opt2 ?>">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt2.'</'.$text_tool.'>'; ?>    
                                                                    </td>
                                                                    <td data-label="Option 3" class="limit-length" title="<?php echo $opt3 ?>">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt3.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Option 4" class="limit-length" title="<?php echo $opt4 ?>">
                                                                        <?php echo '<'.$text_tool.' style="color:'.$color_tool.'">'.$opt4.'</'.$text_tool.'>'; ?>
                                                                    </td>
                                                                    <td data-label="Answer" class="limit-length" title="<?php echo $answer ?>">
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
                                                                    <td data-label="Edit">
                                                                        <?php
                                                                            //get quiz id from row of quiz db
                                                                            $quiz_id = $row['id'];

                                                                            $sql_get_add_ques = "select * from quiz_display where quiz_id='$quiz_id' ";
                                                                            $res_get_add_ques = mysqli_query($conn, $sql_get_add_ques);

                                                                            if($res_get_add_ques->num_rows > 0)
                                                                            {
                                                                                ?>
                                                                                    <a onclick="return confirm('Remove to added questions to edit.')">
                                                                                        <h6 class="text-secondary"><i class="fas fa-edit"></i></h6>
                                                                                    </a>
                                                                                <?php
                                                                            }   
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <a href="edit_quiz.php?subject=<?php echo $subject ?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title?>&quiz_token=<?php echo $quiz_token?>&id=<?php echo $row['id']?>">
                                                                                        <h6 class="text-primary"><i class="fas fa-edit"></i></h6>
                                                                                    </a>
                                                                                <?php
                                                                            } 
                                                                        
                                                                            
                                                                        ?>
                                                                    </td>
                                                                    <td data-label="Delete">
                                                                        <a onclick="return confirm('Are you sure you want to delete this?')" href="view_quiz.php?subject=<?php echo $subject ?>&subject_token=<?php echo $subject_token?>&quiz_title=<?php echo $quiz_title?>&quiz_token=<?php echo $quiz_token?>&id=<?php echo $row['id']?>">
                                                                            <h6 class="text-danger"><i class="fas fa-trash"></i></h6>
                                                                        </a>
                                                                    </td>
                                                                    <td data-label="Add">
                                                                        <!-- START FORM FOR IMPORT  -->
                                                                        <form method="post">
                                                                       
                                                                        <?php
                                                                            //get quiz id from row of quiz db
                                                                            $quiz_id = $row['id'];
                                                                            $sql_get_add_ques = "select * from quiz_display where quiz_id='$quiz_id' ";
                                                                            $res_get_add_ques = mysqli_query($conn, $sql_get_add_ques);

                                                                            if($res_get_add_ques->num_rows > 0)
                                                                            {
                                                                                ?>
                                                                                    <input type="checkbox" name="remove[]" value="<?php echo $row['id']; ?>" id="question_<?php echo $row['id']; ?>" class="btn-check" <?php echo isset($_POST['select_all']) ? "checked" : "" ?>>
                                                                                    <label class="btn btn-outline-danger" for="question_<?php echo $row['id']; ?>">
                                                                                        <i class="fas fa-minus"></i>
                                                                                    </label>
                                                                                <?php
                                                                            }   
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <input type="checkbox" name="add[]" value="<?php echo $row['id']; ?>" id="question_<?php echo $row['id']; ?>" class="btn-check" <?php echo isset($_POST['select_all']) ? "checked" : "" ?>>
                                                                                    <label class="btn btn-outline-success" for="question_<?php echo $row['id']; ?>">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </label>
                                                                                <?php
                                                                            }
                                                                        
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        <?php
                                                    }
                                                    ?>                      <div class="row">
                                                                                <div class="col-md-11">
                                                                                    <input type="submit" value=" + Add or Remove --" class="btn btn-warning mt-10 mb-10">
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <input type="submit" name="select_all" value="Select all" class="btn btn-success mt-10 mb-10">
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                        <!-- END FORM FOR IMPORT  -->
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
