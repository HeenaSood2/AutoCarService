<?php
session_start();

// if(isset($_SESSION['user'])){
//   // echo '<script>alert('.$serviceCenter.')</script>'
//   echo '<script>alert("if");</script>';
//   echo '<script> document.getElementById("loginBTN").style.display=none;</script>';
//   echo '<script>document.getElementById("userBTN").style.display=block;</script>';

// }
// else{
//   echo "<script>alert('else');</script>";
//   echo '<script>document.getElementById("loginBTN").style.display=block;</script>';
//   echo '<script>document.getElementById("userBTN").style.display=none;</script>';
  
// }

$conn=mysqli_connect("localhost","root","","car_service")or die("Can't Connect to Database");
$carUser=mysqli_query($conn, "SELECT * FROM `car_users`");
$carUser=mysqli_num_rows($carUser);
 $serviceCenter=mysqli_query($conn, "SELECT * FROM `service_center`");
 $serviceCenter=mysqli_num_rows($serviceCenter);
 $clientServed=mysqli_query($conn, "SELECT * FROM `slot_booking`");
 $clientServed=mysqli_num_rows($clientServed);
 $date=date("Y-m-d");
 $dailyClient=mysqli_query($conn, "SELECT * FROM `slot_booking` where date='$date'");
 $dailyClient=mysqli_num_rows($dailyClient);

?>
<!DOCTYPE html>
<html >

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <title>Auto car service</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google fonts -->
  <link href="//fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">

</head>

<body>
<!-- header -->
<header id="site-header" class="fixed-top">
  <section class="w3l-header-4">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <h1><a class="navbar-brand" href="home.php"><span class="fa fa-car" aria-hidden="true"></span>
            AUTO CAR SERVICE</span>
          </a></h1>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa icon-expand fa-bars"></span>
          <span class="fa icon-close fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home </a>
            </li>
            <li class="nav-item @@about__active">
              <a class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item @@services__active">
              <a class="nav-link" href="#footer">Feedback</a>
            </li>
            <li class="nav-item ml-3">
              <a href="#footer" class="btn btn-outline-primary btn-style mr-2">Contact Us</a>
              <li class="nav-item ml-3">
                <!-- <button id="loginBTN" name="loginBTN" class="btn btn-outline-primary btn-style mr-2">Login</button> -->
                  <?php 
                  if(isset($_SESSION['user'])){
                    $umail=$_SESSION['user'];
                    $U=mysqli_query($conn, "SELECT * FROM `car_users` where email= '$umail' ");
                    $U=mysqli_fetch_assoc($U);
                     echo '<a id="sCenter" href="serviceCenters.php" name="sCenter" class="btn btn-outline-primary btn-style mr-2">Service Center</a>';
                  echo '<button id="userBTN" name="userBTN"  class="btn btn-outline-primary btn-style mr-2" >'. $U['username'].'</button>';
                 
                }
                else{
                  echo '<a id="loginBTN" href="login.php" name="loginBTN" class="btn btn-outline-primary btn-style mr-2">Login</a>';
                }
                   ?>
                    
                 
              </li>
            </li>
          </ul>
        
      </nav>
    </div>
  </section>
</header>
<!-- //header -->

<!-- banner section -->
<section id="home" class="w3l-banner py-5">
    <div class="container py-lg-5 py-md-4">
        <div class="row align-items-center py-lg-4 py-md-3 ">
            <div class="col-lg-6 col-sm-12 ">
                <h3 class="mb-md-4 mb-3 ">We Share The Pride In Your Ride</h3>
                <p style="text-align: justify;">True care in auto care, always make your car smile and create your  moments with your good car. Try us once you will never go anywhere again.</p>
                <div class="mt-sm-5 mt-4">
                    <a class="btn btn-primary btn-style" href="#about"> About Us </a>
                </div>
            </div>
             <div class="col-lg-5 offset-lg-1 col-md-8 col-sm-10 mt-lg-0 mt-md-5 mt-4">
                <!-- <div class="banner-form-w3">
                     banner form 
                    <form action="#" method="post">
                        <h5 class="mb-4">Request a call back</h5>
                        <div class="form-style-w3ls">
                            <input placeholder="Your Name" name="name" type="text" required="">
                            <input placeholder="Your Email" name="email" type="email" required="">
                            <input placeholder="Contact Number" name="number" type="text" required="">
                            <button class="btn btn-style btn-primary w-100"> Send request</button>
                        </div>
                    </form>
                     //banner form 
                </div> -->
            </div> 
        </div>
    </div>
</section>
<!-- //banner section -->
<!-- home page about section -->
<section class="w3l-index3" id="about">
    <div class="midd-w3 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="assets/images/about.jpg" alt="" class="radius-image img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-md-5 mt-4 align-self">
                    <h3 class="title-big">We value our clients and offer a personal, professional service.</h3>
                    <p class="mt-4" style="text-align: justify;">
Our website is user friendly for the users and we are providing all the facilities which users and car service providers want from us to make their task easy and also can save their time. If anyone faces any issue regarding the website or if users are finding difficulty to use our website they can directly contact us through email or contact. As of now we don’t have any unhappy users or customers till now.  
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //home page about section -->
<!-- /bottom-grids-->
<section class="w3l-bottom-grids-6 py-5" id="services">
    <div class="container py-lg-5 py-md-4">
        
        <h3 class="title-big mb-md-5 mb-4 text-center">Our Services</h3>
        <div class="grids-area-hny main-cont-wthree-fea row">
            <div class="col-lg-4 col-md-6 grids-feature">
                <div class="area-box">
                   
                    <span class="fa fa-map-marker"></span>
                    <h4><a href="#feature" class="title-head">Tracking User</a></h4>
                    <p style="text-align: justify;">Stuck somewhere?Need help? Request for the service through our website by choosing your best service center and get services.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-md-0 mt-4">
                <div class="area-box">
                    <span class="fa fa-money"></span>
                    <h4><a href="#feature" class="title-head">Digital Payment</a></h4>
                    <p style="text-align: justify;">Pay your bills in online mode using UPI's and net banking and also accept the payments directly into the bank account.</p>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-lg-0 mt-4">
                <div class="area-box">
                    <span class="fa fa-wechat"></span>
                    <h4><a href="#feature" class="title-head">Chat-Box</a></h4>
                    <p style="text-align: justify;">We provide one on one interaction between car service providers and users which makes it easy to chat and share thier intricacies.  .</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //bottom-grids-->
<!-- stats -->
<section class="w3l-stats py-lg-5 py-4" id="stats">
    <div class="gallery-inner container py-md-5 py-4">

        <h6 class="title-small text-center">Our Statistics</h6>
        <h3 class="title-big mb-md-5 mb-5 text-center">Learn about Our Success</h3>
        <div class="row stats-con">
            <div class="col-md-3 col-6 stats_info counter_grid">
                <span class="fa fa-car"></span>
                <p class="counter"><?php echo $carUser?></p>
                <h4>Registered Users</h4>
            </div>
            <div class="col-md-3 col-6 stats_info counter_grid1">
              <span class="fa fa-wrench"></span>
                <p class="counter"><?php echo $serviceCenter?></p>
                <h4>Service Centers</h4>
            </div>
            <div class="col-md-3 col-6 stats_info counter_grid mt-md-0 mt-5">
                <span class="fa fa-users"></span>
                <p class="counter"><?php echo $clientServed?></p>
                <h4>Clients served</h4>
            </div>
            <div class="col-md-3 col-6 stats_info counter_grid2 mt-md-0 mt-5">
                
                <span class="fa fa-cogs"></span>
                <p class="counter"><?php echo $dailyClient?></p>
                <h4>Daily services</h4>
            </div>
        </div>
    </div>
</section>
<!-- //stats -->

<!-- testimonials -->
<section class="w3l-clients" id="clients">
	<!-- /grids -->
	<div class="cusrtomer-layout py-5">
		<div class="container py-lg-5 py-md-4">
			<!-- /grids -->
			<div class="row testimonial-row">
			  <div class="col-lg-4 heading align-self">
				  <h6 class="title-small">Client Testimonials</h6>
				  <h3 class="title-big mb-md-5 mb-4">What our customers are saying</h3>
			  </div>
  
				<div id="owl-demo1" class="col-lg-8 owl-two owl-carousel owl-theme mb-md-3 mb-sm-5 mb-4">
				<?php
        $displayFeedback=mysqli_query($conn, "SELECT * FROM `ourfeedback` ORDER by id DESC LIMIT 6")or die("Failed to query time slots". mysqli_error());
      while($display=mysqli_fetch_assoc($displayFeedback)){
              echo '	<div class="item">
						<div class="testimonial-content">
							<div class="testimonial">
							  <blockquote>
								  <q>'. $display["feedback"].'</q>
							  </blockquote>
								<div class="testi-des">
								
									<div class="peopl align-self">
										<h3>'. $display["name"].'</h3>
									
									</div>
								</div>
							</div>
						</div>
					</div>
	';
      }
    ?>
    	</div>
		<!-- /grids -->
	</div>
	<!-- //grids -->
  </section>
  <!-- //testimonials -->
  
    <!-- //forms -->
     <!-- footer -->
     <section class="w3l-footer-29-main" id="footer" >
      <div class="footer-29 py-5">
        <div class="container pb-lg-3">
          <div class="row footer-top-29">
            <div class="col-lg-4 col-md-6 footer-list-29 footer-1 mt-md-4">
              <h6 class="footer-title-29">Contact Us</h6>
              <ul>
                <li>
                  <p><span class="fa fa-map-marker"></span> Car Servicing, JAIPUR ,RAJASTHAN</p>
                </li>
                <li><a href="tel:+91-1234567890"><span class="fa fa-phone"></span> +91-8385806909</a></li>
                <li><a href="mailto:gowthamisetty57@gmail.com" class="mail"><span class="fa fa-envelope-open-o"></span>
                    gowthamisetty57@gmail.com</a></li>
              </ul>
              <div class="main-social-footer-29">
                <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
                <a href="https://twitter.com/home?lang=en" class="twitter"><span class="fa fa-twitter"></span></a>
                <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
                <a href="https://www.linkedin.com/in/gowthami-a-g-132a46192/" class="linkedin"><span class="fa fa-linkedin"></span></a>
              </div>
            </div>
           
          <div class="banner-form-w3 " >
            
           <form action="#" method="post">
               <h5 class="mb-4" >Give Us Feedback</h5>
               <div class="form-style-w3ls">
      <form action="" method="post">
                   <input placeholder="Your Name" name="fname" type="text" required="" style="border:1px solid black;"><br>
                   <textarea id="desc" name="desc" rows="4" cols="37" placeholder="Your feedback.." style="border:1px solid black;border-radius: 5px;"></textarea>
                <br> <br>  <button class="btn btn-style btn-primary w-100" id="feedback" name="feedback"> Submit</button>
                </form>
               </div>
           </form>
            
       </div>





          <div class="row bottom-copies">
            <p class="copy-footer-29 col-lg-8">Car Servicing. Design by Heena Gowthami Abhijeet </p>
            <!-- <ul class="list-btm-29 col-lg-4">
             
            </ul> -->
          </div>
        </div>
      </div>
    <!-- // footer -->

    <script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->

    <script src="assets/js/theme-change.js"></script><!-- theme switch js (light and dark)-->

    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
          type: 'inline',

          fixedContentPos: false,
          fixedBgPos: true,

          overflowY: 'auto',

          closeBtnInside: true,
          preloader: false,

          midClick: true,
          removalDelay: 300,
          mainClass: 'my-mfp-zoom-in'
        });

        $('.popup-with-move-anim').magnificPopup({
          type: 'inline',

          fixedContentPos: false,
          fixedBgPos: true,

          overflowY: 'auto',

          closeBtnInside: true,
          preloader: false,

          midClick: true,
          removalDelay: 300,
          mainClass: 'my-mfp-slide-bottom'
        });
      });
    </script>
    <!-- magnific popup -->

    <script src="assets/js/owl.carousel.js"></script>
    <!-- script for tesimonials carousel slider -->
    <script>
      $(document).ready(function () {
        $("#owl-demo1").owlCarousel({
          loop: true,
          margin: 20,
          nav: false,
          responsiveClass: true,
          responsive: {
            0: {
              items: 1,
              nav: false
            },
            736: {
              items: 1,
              nav: false
            },
            1000: {
              items: 2,
              nav: false,
              loop: false
            }
          }
        })
      })
    </script>
    <!-- //script for tesimonials carousel slider -->

    <!--/MENU-JS-->
    <script>
      $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
          $("#site-header").addClass("nav-fixed");
        } else {
          $("#site-header").removeClass("nav-fixed");
        }
      });

      //Main navigation Active Class Add Remove
      $(".navbar-toggler").on("click", function () {
        $("header").toggleClass("active");
      });
      $(document).on("ready", function () {
        if ($(window).width() > 991) {
          $("header").removeClass("active");
        }
        $(window).on("resize", function () {
          if ($(window).width() > 991) {
            $("header").removeClass("active");
          }
        });
      });
    </script>
    <!--//MENU-JS-->

    <!-- disable body scroll which navbar is in active -->
    <script>
      $(function () {
        $('.navbar-toggler').click(function () {
          $('body').toggleClass('noscroll');
        })
      });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!--bootstrap-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- //bootstrap-->
    </body>

    </html>
    <?php

  if(isset($_POST['feedback']))
       {

  $fname=$_POST['fname'];
  $feed=$_POST['desc'];
  $selectFeedback=mysqli_query($conn, "select name from `ourfeedback` where name='$fname'");
  $count=mysqli_num_rows($selectFeedback);
 if($count>=1){
  $UpdateFeedback=mysqli_query($conn, "Update `ourfeedback` SET feedback= '$feed' where name='$fname'");
  echo '<script>alert("data updated successfully");</script>';

}
 else{

  $insertFeedback=mysqli_query($conn, "INSERT INTO `ourfeedback`( `name`, `feedback`) VALUES ('$fname','$feed')");

  if($insertFeedback){
    echo '<script>alert("Feedback added successfully");</script>';

  }  
 }
}
?>