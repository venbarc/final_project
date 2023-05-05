<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Home | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
      include "head_links.php";
      // phpinfo();
    ?>
  `
  </head>
  <body>

    <?php
      session_start();
      include "connect.php";

      
    ?>

    <!-- ========================= hero1-section-wrapper-2 start ========================= -->
    <section id="home" class="hero1-section-wrapper-2">

      <?php
        include "navbar.php";
      ?>

      <!-- ========================= Home start ========================= -->
      <div class="hero1-section hero1-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-6">
              <div class="hero1-content-wrapper">
                <h3 class="wow fadeInUp" data-wow-delay=".2s">Welcome to Learning E.R.A</h3>
                <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Create Quizzes with a twist!</h2>
                <p class="mb-50 wow fadeInUp" data-wow-delay=".6s">
                  Make quizzes more fun with a twist! Add unique elements like surprising facts, humorous questions, or twist endings.
                  Captivate your audience and provide a memorable experience with a quiz that tests knowledge and adds creativity.
                </p>

                <?php 
                  if(isset($_SESSION['user_id']))
                  {
                    $user_id = $_SESSION['user_id'];
                    $sql = "select * from users where id = '$user_id' ";
                    $res = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_assoc($res);

                    $user_type = $user['user_type'];

                    if($user_type == 'prof')
                    {
                      ?>
                        <div class="buttons">
                          <a href="add_quiz.php"  class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Create your quiz here</a>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                        <div class="buttons">
                          <a href="quiz.php"  class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">View your quiz here</a>
                        </div>
                      <?php
                    }
                    
                  }
                  else
                  {
                    ?>
                      <div class="buttons">
                        <a href="register.php"  class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".7s">Join Here</a>
                      </div>
                    <?php
                  }
                ?>
                
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero1-image">
                <!-- other half of the page here  -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ========================= Home end ========================= -->

    </section>
    <!-- ========================= hero1-section-wrapper-2 end ========================= -->

    <!-- ========================= feature start ========================= -->
    <section id="features" class="feature-section feature-style-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-11">
            <div class="row">
              <div class="col-xl-7 col-lg-10 col-md-9">
                <div class="section-title mb-60">
                  <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Features that we provide</h3>
                  <p class="wow fadeInUp" data-wow-delay=".4s">
                    Interactive Quiz Creation: Featuring Multiple Choice Questions, Scoring System, 
                    Random Question Generation, User Accounts, Responsive Design, and Create Quiz Game!</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                  <div class="icon">
                    <i class="far fa-id-card"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Course Management</h5>
                    <p>In this feature you can create a subject that you can manage your students. It also provides a Subject Id to be provided to students for easy joining.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                  <div class="icon">
                    <i class="fas fa-tools"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Create Quiz</h5>
                    <p>This Feature is where the user(professor side) can Manage the course with the extra tools that you can use, The user can change text sizes, text colors, upload image, and resize image.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                  <div class="icon">
                  <i class="fas fa-award"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Badges</h5>
                    <p>This feature provides badges to student who got the top score in a quiz.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".8s">
                  <div class="icon">
                    <i class="fa fa-history"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Progress Report</h5>
                    <p>In this feature user can view their previous quizzes.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".8s">
                  <div class="icon">
                    <i class="far fa-file-excel"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Item analysis</h5>
                    <p>In this feature the professor will see the most missed question to know where the students mostly lack.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-feature wow fadeInUp" data-wow-delay=".8s">
                  <div class="icon">
                    <i class="fa fa-print"></i>
                  </div>
                  <div class="content">
                    <h5 class="mb-25">Summary Report</h5>
                    <p>This feature allows the user to generate their Summary reports.</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
        </div>
      </div>
      <div class="feature-img wow fadeInLeft" data-wow-delay=".2s">
        <img src="assets/img/feature/feature-bg.png" alt="">
      </div>
    </section>
		<!-- ========================= feature end ========================= -->

    <!-- ========================= Goal start ========================= -->
    <section id="goal" class="goal-section goal-style-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="goal-image wow fadeInLeft" data-wow-delay=".3s">
              <img src="assets/img/goal/goal-bg.png" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="goal-content-wrapper">
              <div class="section-title mb-40">
                <h3 class="mb-25 wow fadeInUp" data-wow-delay=".4s">"Our Goal is to make learning visually attractive and fun"</h3>
                <p class="wow fadeInUp" data-wow-delay=".5s">
                  Our goal is to revolutionize the traditional approach to learning by incorporating visually attractive and fun-filled elements.
                  By doing so, we aim to create engaging and entertaining learning experiences that transform the way people learn. With a focus on 
                  visual appeal and enjoyable interactions, we strive to make education more accessible and enjoyable for all.  
              </div>
              <br>

              <h3 class="wow fadeInUp" data-wow-delay="1s">Major features</h3>

              <br>
              <div class="row goal-content2-wrapper">
                <div class="col-sm-4 wow fadeInUp" data-wow-delay=".6s">
                  <div class="icon">
                    <i class="fas fa-check" style="margin: 15px auto;"></i> 
                  </div>
                  <h6> Creative Quiz Games </h6>
                </div>
                <div class="col-sm-4 wow fadeInUp" data-wow-delay=".7s">
                  <div class="icon">
                    <i class="fas fa-check" style="margin: 15px auto;"></i> 
                  </div>
                  <h6> Student Monitoring</h6>
                </div>
                <div class="col-sm-4 wow fadeInUp" data-wow-delay=".8s">
                  <div class="icon">
                    <i class="fas fa-check" style="margin: 15px auto;"></i> 
                  </div>
                  <h6> Downloadable Data</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- =========================  oal end ========================= -->


		<!-- ========================= team start ========================= -->
		<section id="team" class="team-section team-style-1">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
            <div class="section-title text-center mb-60">
              <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Our Team</h3>
              <p class="wow fadeInUp" data-wow-delay=".4s">
                "Introducing our members, the mastermind behind Learning ERA, a website revolutionizing the way teachers 
                engage their students through interactive quiz games and making learning a fun experience."
              </p>
            </div>
          </div>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".3s">
              <div class="image">
                <!-- <img src="assets/img/team/team1.jpeg" alt=""> -->
              </div>
              <div class="info">
                <h6>Lyza E. Cedilla</h6>
                <p>Project Manager | Researcher</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="fab fa-google"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".4s">
              <div class="image">
                <!-- <img src="assets/img/team/team2.jpeg" alt=""> -->
              </div>
              <div class="info">
                <h6>Imeren Micaella A. Beo</h6>
                <p>Editor | Researcher</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="fab fa-google"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".6s">
              <div class="image">
                <!-- <img src="assets/img/team/team3.jpeg" alt=""> -->
              </div>
              <div class="info">
                <h6>Benedict O. Barcebal</h6>
                <p>Full Stack Developer</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="fab fa-google"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-10">
            <div class="single-team wow fadeInUp" data-wow-delay=".8s">
              <div class="image">
                <!-- <img src="assets/img/team/team4.jpeg" alt=""> -->
              </div>
              <div class="info">
                <h6>Marie Jean Mendova</h6>
                <p>UI Designer | Researcher</p>
                <ul class="socials">
                  <li>
                    <a href="#0"> <i class="lni lni-facebook-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="lni lni-instagram-filled"></i> </a>
                  </li>
                  <li>
                    <a href="#0"> <i class="fab fa-google"></i> </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- ========================= team end ========================= -->

    <script>
      //Version 1 of Sticky navbar (hero1)
            window.onscroll = function () {
                var header_navbar = document.querySelector(".hero1-section-wrapper-2 .header");
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
