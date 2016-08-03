<?php
 ob_start();
 session_start();
 
 require_once('connection.php');
 error_reporting(E_ALL & ~E_NOTICE);
 @mysql_select_db($database_localhost,$localhost);

 if( isset($_SESSION['user'], $_SESSION['userName']) ) 
 {
	  //echo 'loggedin';
	   
	  //header("Location: index.php");
	  //exit;
	
	 // select loggedin users detail
	 $res = mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	 $userRow = mysql_fetch_array($res);

 }
           
           
?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Judges Institute - Sri Lanka</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<link href="plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css">
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link href="colors/color.css" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->
</head>
<body class="home">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body">
  <!-- Start Site Header -->
  <header class="site-header">
    <div class="top-header hidden-xs">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6">
           
            <ul class="horiz-nav pull-left">
              <li class="dropdown"><a data-toggle="dropdown"><i class="fa fa-user"></i> Login/Signin <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">My Profile</a></li>
                  <li><a href="logout.php">My Sign-out</a></li>
                </ul>
              </li>
              <li><a href="login2_process.php"><i class="fa fa-check-circle"></i> Register</a></li>
              </ul>   
          </div>
          <div class="col-md-8 col-sm-6">
            <div style="font-style:oblique; color:#FFF; margin-left:10px; font-size:15px; width: 50%;
float: left; margin-top: 5px; ">
			  <?php 
              if( isset($_SESSION['userName']) ) 
              {
                  echo 'Welcome - '.$_SESSION['userName']; 
              }
              ?>
             </div>
            <ul class="horiz-nav pull-right" style="margin-top: 5px; ">
                  <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                 <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="middle-header">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-8 col-xs-8">
            <h1 class="logo"> <a href="index.html"><img src="images/logo.jpg" alt="Judges Institute"></a> </h1>
          </div>
          <div class="col-md-8 col-sm-4 col-xs-4">
              <div class="contact-info-blocks hidden-sm hidden-xs">
                  <div>
                      <i class="fa fa-phone"></i> Our Library
                    <span>+94 11 254 1193</span>
                </div>
                  <div>
                      <i class="fa fa-envelope"></i> Email Us
                    <span>info@judgesinstitute.lk</span>
                </div>
                  <div>
                      <i class="fa fa-clock-o"></i> Working Hours
                    <span>08:30 to 17:00</span>
                </div>
             </div>
              <a href="#" class="visible-sm visible-xs menu-toggle"><i class="fa fa-bars"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="main-menu-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navigation">
              <ul class="sf-menu">
                <li class="active"><a href="index.html">Home</a> </li>
                <li><a href="#">About Us</a></li>
                <li><a href="login2_process.php">Register as Judge </a></li> <!-- ******** Changed ******** -->
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End Site Header -->
  <!-- Site Showcase -->
  <div class="site-showcase">
    <div class="slider-mask overlay-transparent"></div>
    <!-- Start Hero Slider -->
    <div class="hero-slider flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-pause="yes">
      <ul class="slides">
        <li class=" parallax" style="background-image:url(images/bg.jpg);">
        </li> 
        <li class="parallax" style="background-image:url(images/bg_1.jpg);">
        </li>
      </ul>
    </div>
    <!-- End Hero Slider --> 
    
    <!-- Site Search Module -->
    <div class="site-search-module">
      <div class="container">
        <div class="site-search-module-inside">
          
		  <form action="searchResultFilesList.php" method="post" target="_self"> <!-- ***************Changed*************** -->
            <div class="form-group">
              <div class="row">
                <div class="col-md-2">
					<select name="propery contract type" class="form-control input-lg selectpicker">
                      <option selected>SLJI e-Library</option>
                      <!--<option>Acts Database</option>
                      <option>Gazettes Database</option>-->
                    </select>
                </div>
                <div class="col-md-3">
                    <!--<select name="propery type catdropdown" class="form-control input-lg selectpicker catdropdown">-->
					<select name="catdropdown" class="form-control input-lg selectpicker catdropdown">	<!-- ***************Changed catdropdown*************** -->
                        <option value="0">Select Category</option>
						<option value="1">All</option>
                      	<option value="2">Acts</option>
                      	<option value="3">Cases</option>
                      	<option value="4">Legislation</option>
                      	<option value="5">Journals</option>
                      	<option value="6">New Law Reports</option>
						<option value="7">Sri Lanka Law Reports</option>
                        <option value="8">Circulars</option>
                        <option value="9">Gazettes</option>
                    </select>
                </div>
                <div class="col-md-3">
                <!--<input type="text" id="search" name="search" class="form-control input-lg" placeholder="search*">-->
				<input type="text" id="search" name="searchTextBox" class="form-control input-lg" placeholder="search*"> <!-- ***************Changed searchTextBox*************** -->
                   <!-- <select name="location" class="form-control input-lg selectpicker">
                        <option selected>Location</option>
                      <option>New York</option>
                    </select> -->
                </div>
                <div class="col-md-2"> 
					<button type="submit" class="btn btn-primary btn-block btn-lg" name="searchBtn"><i class="fa fa-search"></i> Search</button> <!-- ***************Changed searchBtn*************** -->
				</div>
                <div class="col-md-2"><a href="#" id="ads-trigger" class="btn btn-default btn-block"><i class="fa fa-plus"></i><span>Advanced</span></a></div>
              </div>
              <div class="row hidden-xs hidden-sm">
                <div class="col-md-2">
                  <label>Acts</label>
                    <select name="beds" class="form-control input-lg selectpicker">
                      <option>Years</option>
                      <option>2016</option>
                      <option>2015</option>
                      <option>2014</option>
                      <option>2013</option>
                      <option>2012</option>
                      <option>2011</option>
                      <option>2010</option>
                      <option>2009</option>
                      <option>2008</option>
                      <option>2007</option>
                    </select>
                </div>
                <div class="col-md-2">
                  <label>NLR</label>
                    <select name="beds" class="form-control input-lg selectpicker">
                      <option>Any</option>
                      
                      <option>2015</option>
                      <option>2014</option>
                      <option>2013</option>
                      <option>2012</option>
                      <option>2011</option>
                      <option>2010</option>
                      <option>2009</option>
                      <option>2008</option>
                      <option>2007</option>
                    </select>
                </div>
                <div class="col-md-3">
                  <label>Unreported Judgments</label>
                    <select name="beds" class="form-control input-lg selectpicker">
                    <option>Any</option>
                      <option>2016</option>
                      <option>2015</option>
                      <option>2014</option>
                     
                    </select>
                </div>
                <div class="col-md-3">
                  <label>SLR & NLR</label>
                    <select name="beds" class="form-control input-lg selectpicker">
                       <option>Any</option>
                       <option>2016</option>
                      <option>2015</option>
                      <option>2014</option>
                      <option>2013</option>
                      <option>2012</option>
                      <option>2011</option>
                      <option>2010</option>
                      <option>2009</option>
                      <option>2008</option>
                      <option>2007</option>
                    </select>
                </div>
              <!--<div class="col-md-2">
                  <label>Min Area (Sq Ft)</label>
                  <input type="text" class="form-control input-lg" placeholder="Any">
                </div>
                <div class="col-md-2">
                  <label>Max Area (Sq Ft)</label>
                  <input type="text" class="form-control input-lg" placeholder="Any">
                </div> -->
              </div>
            </div>
          </form>
		  
		  
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- Start Content -->
   <div class="main" role="main">

  <!--Start Site Footer-->
  <footer class="site-footer">
      <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-6 footer-widget widget">
                <h3 class="widgettitle">Chairman Message</h3>
                  <ul>
                      <li>
                        The Sri Lanka Judges' Institute is now 23 years old. These 23 years have coincided with many significant changes in the legal system of this country. The Judges' Institute amidst host of challenges including physical and financial resources provided its services in training Judges to contribute to those developments in the judicial system assisted by the Ministry of Justice and Funding agencies.
                      </li>
                      
                  </ul>
              </div>
            <div class="col-md-3 col-sm-6 footer-widget widget">
                <h3 class="widgettitle">Useful Links</h3>
               <ul>
                <li><a href="#">Supreme Court of Sri Lanka</a></li>
                <li><a href="#">Court of Appeals - Sri Lanka</a></li>
                <li><a href="#">Attorney General Department</a></li>
                <li><a href="#">Ministry of Justice</a></li>
               </ul>
           </div>
            <div class="col-md-3 col-sm-6 footer-widget widget">
                <h3 class="widgettitle">Our Institute</h3>
               <ul>
                <li>The Sri Lanka Judges' Institute was established by an Act of Parliament titled "Sri Lanka Judges' Institute Act" No. 46 of 1985. The Board appoints the Institute's Director and such other officers and servants, in its necessary for carrying out the objects of the Institute and to exercise disciplinary control </li>
                
               </ul>
           </div>
            <div class="col-md-3 col-sm-6 footer-widget widget">
                <h3 class="widgettitle">Latest Unreported Judgements</h3>
               	<p>Please subscribe us & we will send the email unreported judgements & other latest update of E-Library</p>
               	<form method="post" id="newsletterform" name="newsletterform" class="newsletter-form" action="mail/newsletter.php">
                  	<input type="email" name="nl-email" id="nl-email" placeholder="Enter your email" class="form-control">
                  	<input type="submit" name="nl-submit" id="nl-submit" class="btn btn-primary btn-block btn-lg" value="Subscribe">
               	</form>
              	<div class="clearfix"></div>
              	<div id="nl-message"></div>
           </div>
       </div>
   </div>
  </footer>
  <footer class="site-footer-bottom">
    <div class="container">
      <div class="row">
        <div class="copyrights-col-left col-md-6 col-sm-6">
          <p>&copy; 2016 Judges Institute. All Rights Reserved</p>
        </div>
        <div class="copyrights-col-right col-md-6 col-sm-6">
          <div class="social-icons">
              <a href="" target="_blank"><i class="fa fa-facebook"></i></a>
             <a href="" target="_blank"><i class="fa fa-twitter"></i></a>
             <a href="" target="_blank"><i class="fa fa-pinterest"></i></a>
             <a href="" target="_blank"><i class="fa fa-google-plus"></i></a>
             <a href="" target="_blank"><i class="fa fa-youtube"></i></a>
             <a href="#"><i class="fa fa-rss"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Site Footer -->
  <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>
<script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin --> 
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script> <!-- Owl Carousel --> 
<script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider --> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/waypoints.js"></script> <!-- Waypoints --> 
<script src="js/init.js"></script> <!-- All Scripts -->
<!--[if lte IE 9]><script src="js/script_ie.js"></script><![endif]-->
</body>
</html>