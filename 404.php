<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Error 404 | Learning E.R.A</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css?Version=1" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css?Version=1"/>
    <link rel="stylesheet" href="assets/css/animate.css?Version=1"/>
    <link rel="stylesheet" href="assets/css/lindy-uikit.css?Version=2"/>

    <!-- ========================= Linea Icons Link Library ========================= -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/larform-ui-icons@1.2.2/dist/css/larform-ui-icons.min.css"/>

    <!-- ========================= Font Awesome Link Library ========================= -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" 
    integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <!--My Own CSS-->
    <link rel="stylesheet" href="assets/css/addons.css?Version=4"/>

  </head>
  <body>


    <!-- ========================= hero2-section-wrapper-2 start ========================= -->
    <section id="home" class="hero2-section-wrapper-2">

      <?php
        session_start();
        include "connect.php";
        include "navbar.php";
      ?>

    <!-- ========================= Home start ========================= -->
      <div class="hero2-section hero2-style-2">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-12">
              <div class="hero2-content-wrapper">
                <h5 class="wow fadeInUp text-danger" data-wow-delay=".2s">Something went wrong :( </h5>
                <h2 class="mb-30 wow fadeInUp" data-wow-delay=".4s">Error 404</h2>
                    <h3 class="text-primary"><a href="index.php">Go back to Home Page</a></h3>

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
