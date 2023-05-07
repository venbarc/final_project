<!DOCTYPE html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Preview Quiz | Learning E.R.A</title>
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

            <section id="preview_quiz" class="preview_quiz-section preview_quiz-style-1">
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
                                                <div class="col-md-11 mb-5">
                                                   <h2> Make Hard Copy</h2>
                                                </div>
                                            </div>
                                        ';

                                        ?>
                                        
                                            <?php
                                                //get quiz display data 
                                                $sql_quiz_display = "select * from quiz_display where subject='$subject' and  subject_token='$subject_token' and quiz_token='$quiz_token' and prof_email='$email' ";
                                                $res_quiz_display = mysqli_query($conn, $sql_quiz_display);
                                                $count = 1;

                                                ?>
                                                <div class="row">
                                                    <div class="col-md-10 mb-2">
                                                        <!-- Button to print the data -->
                                                        <button onclick="window.print()" class="btn btn-danger">Download Hard Copy</button>
                                                    </div>
                                                    <div class="col-md-2">

                                                        <!-- checkbox html  -->
                                                        <label class="checkbox-container">
                                                            <input type="checkbox" id="myCheckbox">
                                                            <span class="checkmark"></span>
                                                                View Answer Keys
                                                        </label>
                                                        <!-- checkbox css  -->
                                                        <style>
                                                            /* Hide the default checkbox */
                                                            .checkbox-container input {
                                                            position: absolute;
                                                            opacity: 0;
                                                            cursor: pointer;
                                                            }
                                                            /* Style the checkbox container */
                                                            .checkbox-container {
                                                            display: block;
                                                            position: relative;
                                                            padding-left: 25px;
                                                            margin-bottom: 10px;
                                                            cursor: pointer;
                                                            font-size: 18px;
                                                            }
                                                            /* Style the checkmark */
                                                            .checkmark {
                                                            position: absolute;
                                                            top: 0;
                                                            left: 0;
                                                            height: 20px;
                                                            width: 20px;
                                                            background-color: #fff;
                                                            border: 2px solid #555;
                                                            }
                                                            /* When the checkbox is checked, add a background color to the checkmark */
                                                            .checkbox-container input:checked ~ .checkmark {
                                                            background-color: #555;
                                                            }
                                                            /* Add a pseudo-element to create the checkmark */
                                                            .checkmark:after {
                                                            content: "";
                                                            position: absolute;
                                                            display: none;
                                                            }
                                                            /* Show the checkmark when the checkbox is checked */
                                                            .checkbox-container input:checked ~ .checkmark:after {
                                                            display: block;
                                                            }
                                                            /* Style the checkmark pseudo-element */
                                                            .checkbox-container .checkmark:after {
                                                            left: 6px;
                                                            top: 2px;
                                                            width: 5px;
                                                            height: 10px;
                                                            border: solid white;
                                                            border-width: 0 2px 2px 0;
                                                            transform: rotate(45deg);
                                                            }
                                                        </style>

                                                    </div>
                                                </div>
                                                            
                                                
                                                <!-- style for print  -->
                                                <style>
                                                    @media print {
                                                        body * {
                                                        visibility: hidden;
                                                        }
                                                        .table-print, .table-print * {
                                                        visibility: visible;
                                                        }
                                                        .table-print {
                                                        position: absolute;
                                                        left: 0;
                                                        top: 0;
                                                        }
                                                    }
                                                </style>
                                                <?php

                                                if($res_quiz_display->num_rows > 0)
                                                {
                                                    echo'
                                                    <table class="table table-print">
                                                            <tr>
                                                                <th colspan="2">
                                                                    <h4 class="text-center">
                                                                       '. $subject .' 
                                                                    </h4>
                                                                    <h5 class="text-primary text-center mb-4">
                                                                        '. $quiz_title .'
                                                                    </h5>
                                                                </th>
                                                            </tr>
                                                    ';
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
                                                            <tr>
                                                                <th colspan="2">
                                                                    <!-- question  -->
                                                                    <?php echo ' '.$count++.' .) '.$question.' 
                                                                    <div class="text-success fw-bold answer-key" id="answer-key" style="display:none;">
                                                                        Answer Key : ' . $answer . '
                                                                    </div>'
                                                                    ;?>

                                                                    <!-- image here  -->
                                                                    <?php
                                                                        if(empty($image))
                                                                        {
                                                                            echo ' ';
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                                <img src="<?php echo $image ?>" width="<?php echo $img_tool ?>" height="<?php echo $img_tool ?>">
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">
                                                                    <?php echo 'A.) '.$opt1.'<br>'; ?>
                                                                    <?php echo 'B.) '.$opt2.''; ?>
                                                                </td>
                                                                <td class="text-left">
                                                                    <?php echo ' C.) '.$opt3.'<br>'; ?>
                                                                    <?php echo ' D.) '.$opt4.' '; ?>
                                                                </td>
                                                            </tr>
                                                        <?php

                                                    }
                                                    echo'
                                                    </table>
                                                    ';

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
            // get answer keys when checkbox is checked
            const myCheckbox = document.getElementById("myCheckbox");
            const answerKeys = document.querySelectorAll(".answer-key");
            myCheckbox.addEventListener("change", function() {
                if (this.checked) {
                    answerKeys.forEach(function(answerKey) {
                        answerKey.style.display = "block";
                    });
                } else {
                    answerKeys.forEach(function(answerKey) {
                        answerKey.style.display = "none";
                    });
                }
            });

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
