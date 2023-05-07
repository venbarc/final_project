<!DOCTYPE html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title> Most Mistaken questions | Learning E.R.A</title>
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

            <section id="most_mistake" class="most_mistake-section most_mistake-style-1">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section-title mb-60">

                                <h2 class="pb-25 text-danger">Most Mistaken Questions</h2>

                                <?php
                                    //Get subject_token and subject 
                                    if(isset($_GET['subject']) && isset($_GET['subject_token']) && isset($_GET['quiz_title']) && isset($_GET['quiz_token']))
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
                                                    <h3  class="text-primary">'. $subject .' | <span class="text-dark">'. $quiz_title .'</span> </h3>
                                                </div>
                                            </div>
                                        ';

                                        // query for most mistaken question 
                                        $sql_get_question = "SELECT * FROM quiz_display WHERE prof_email='$email' AND quiz_token='$quiz_token' ORDER BY incorrect_count DESC";
                                        $res_get_question = mysqli_query($conn, $sql_get_question);
                                        
                                        $ques = array();
                                        $data = array();
                                        $data2 = array(); // array to store correct count
                                        $numeric = array(); // array to store numeric labels

                                        // if there is a result 
                                        if($res_get_question->num_rows > 0)
                                        {
                                            $count = 1;
                                            while($row = $res_get_question->fetch_assoc()) 
                                            {
                                                $question = $row['question'];
                                                $incorrect_count = $row['incorrect_count'];
                                                $correct_count = $row['correct_count'];

                                                $ques[] = $question;
                                                $data[] = $incorrect_count;
                                                $data2[] = $correct_count;
                                                $numeric[] = $count++; // add numeric label
                                            }

                                            ?>
                                                <!-- bar chart  -->
                                                <canvas id="myChart"></canvas>
                                                <!-- margin bottom  -->
                                                <div class="mb-5"></div>
                                                <!-- table  -->
                                                <table table="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Question</th>
                                                            <th scope="col"># of Mistakes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $count = 1;
                                                        for ($i = 0; $i < count($ques); $i++) {
                                                            echo '<tr>';
                                                                echo '<td data-label="#">' . $count++ . '</td>';
                                                                echo '<td data-label="Question">' . $ques[$i] . '</td>';
                                                                echo '<td data-label="# of Mistakes">' . $data[$i] . '</td>';
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <!-- script for the bar chart  -->
                                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                                <script>
                                                    var ctx = document.getElementById('myChart').getContext('2d');
                                                    var myChart = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: <?php echo json_encode($numeric); ?>, // use numeric labels
                                                            datasets: [{
                                                                label: '# of Mistakes',
                                                                data: <?php echo json_encode($data); ?>,
                                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                                borderWidth: 1
                                                            }, {
                                                                label: '# of Correct Answers',
                                                                data: <?php echo json_encode($data2); ?>,
                                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: 
                                                        {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true,
                                                                    title: {
                                                                        display: true,
                                                                        text: 'Number of wrong and correct answers',
                                                                        font: 
                                                                        {
                                                                            size: 16,
                                                                            weight: 'bold',
                                                                            family: 'Arial'
                                                                        }
                                                                    }
                                                                },
                                                                x: {
                                                                    title: {
                                                                        display: true,
                                                                        text: 'Questions Numbers',
                                                                        font: 
                                                                        {
                                                                            size: 16,
                                                                            weight: 'bold',
                                                                            family: 'Arial'
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    onClick: function(event, legendItem, legend) {
                                                                        var index = legendItem.datasetIndex;
                                                                        var ci = this.chart;
                                                                        var meta = ci.getDatasetMeta(index);

                                                                        meta.hidden = meta.hidden === null ? !ci.data.datasets[index].hidden : null;

                                                                        ci.update();
                                                                    },
                                                                    labels: {
                                                                        usePointStyle: true
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            <?php
                                        }
                                        else // if no result
                                        {
                                            ?>
                                            <h3 style="color: white; background: rgb(0,0,0,0.5); text-align: center; padding: 20px;">
                                                No Records
                                            </h3>
                                            <?php
                                        }
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
