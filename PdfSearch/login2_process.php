<?php
ob_start();
session_start();

if( isset($_SESSION['user']))
{
 	header("Location: index_sub.php");
	//exit;
}

require_once('connection.php');
error_reporting(E_ALL & ~E_NOTICE);
@mysql_select_db($database_localhost,$localhost);

/************************EOF SIGNUP*******************************/

if(isset($_POST['btn-signup'] , $_POST['uname'] , $_POST['email'] , $_POST['pass'])) //BOF isset($_POST['btn-signup']
{
	 $uname = trim($_POST['uname']);
	 $email = trim($_POST['email']);
	 $upass = trim($_POST['pass']);
	 
	 $uname = strip_tags($uname);
	 $email = strip_tags($email);
	 $upass = strip_tags($upass);
	 
	 //echo $uname.'<br/>';
	 //echo $upass.'<br/>';
	 
	 // password encrypt using SHA256();
	 $password = hash('sha256', $upass);
	 
	 // check email exist or not
	 $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
	 $result = mysql_query($query) or die(mysql_error());
	  
	 $count = mysql_num_rows($result); // if email not found then proceed
	 
	 if ($count==0) 
	 {
		  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$uname','$email','$password')";
		  $res = mysql_query($query) or die(mysql_error());
		  
		  if ($res) 
		  {
			$errTyp = "success";
			$errMSG = "successfully registered, you may login now";
		  } 
		  else 
		  {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later..."; 
		  } 
	 }
	 else 
	 {
		  $errTyp = "warning";
		  $errMSG = "Sorry email already in use ..."; 
	 }
 
} //EOF isset($_POST['btn-signup']

/************************EOF SIGNUP*******************************/




/************************BOF LOGIN*******************************/
if(isset($_POST['btn-login'] , $_POST['emailLogin'] , $_POST['passLogin'])) 
{
  $email = $_POST['emailLogin'];
  $upass = $_POST['passLogin'];
  
  //echo $email.'<br/>';
  //echo $upass.'<br/>';
 
  $email = strip_tags(trim($email));
  $upass = strip_tags(trim($upass));
  
  $password = hash('sha256', $upass); // password hashing using SHA256
  
  $res = mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
  
  $row = mysql_fetch_array($res);
  
  $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
  
  if( $count == 1 && $row['userPass'] == $password ) 
  {
   	$_SESSION['user'] = $row['userId'];
	$_SESSION['userName'] = $row['userName'];
   	header("Location: index_sub.php");
  }
  else
  {
	$errTyp = "danger";
   	$errMSG = "Wrong Credentials, Try Again...";
  }
}
/************************EOF LOGIN*******************************/
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
              <li><a href="#"><i class="fa fa-check-circle"></i> Register</a></li>
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
            <ul class="horiz-nav pull-right">
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
                <li ><a href="index_sub.php">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li class="active"><a href="login2_process.php">Register as Judge </a></li>
    
        
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
  <!-- Start Page Header -->
  <div class="parallax page-header" style="background-image:url(images/bg_2.jpg);">
  		<div class="container">
        	<div class="row">
            	<div class="col-md-12">
  					<h1>e-Library - SLJI</h1>
        		</div>
           </div>
       </div>
  </div>
  <!-- End Page Header -->
  </div>
  <!-- Start Content -->
  <div class="main" role="main">
      <div id="content" class="content full">
        	<div class="container">
          		<div class="page">
        			<div class="row">
              			<div class="col-md-4 col-sm-4">
            				<div class="alert alert-default fade in" align="justify">
            					<h4 align="left">SlJI Net - Sri Lanka Judges' Institute's Online Legal Information Network</h4>
								<p>Welcome to Sri Lanka's first Judges' Online database of Legal Information. 
SLJI Net provides access to a subject wise collection of important case law and legal information only to Judges of Sri Lanka.</br>
SLJI Net is intended to be support tool for user friendly database to Judges to have subject wise easy access to reported and unreported judgments of the Supreme Court, Court of Appeal and High Court of Sri Lanka and Acts, foreign judgments, reports and articles. </br>
SLJI Net has been exclusively created for Judges of Sri Lanka to have a subject wise legal database by the Research Division of the Sri Lanka Judges' Institute, No. 80, Ministry of Justice New Building, Colombo 12.
 </p>
                         </div>
            			</div>
                        
                        <!-- **************** BOF Login Form **************** -->
              			<div class="col-md-4 col-sm-4 login-form">
                        	<h3>Login</h3>
                        	<form action="login2_process.php" method="post">
                        		<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-user"></i></span>
  									<input type="text" class="form-control" placeholder="Username" name="emailLogin">
								</div>
                             <br>
                        		<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
  									<input type="password" class="form-control" placeholder="Password" name="passLogin">
								</div>
                             <div class="checkbox">
                             	<input type="checkbox"> Remember Me!
                             </div>
                             <button type="submit" class="btn btn-primary" name="btn-login" >Login Now</button>
                     		</form>
            			</div>
                        <!-- **************** EOF Login Form **************** -->
                        
                        
                        <!-- **************** BOF Registration Form **************** -->
              			<div class="col-md-4 col-sm-4 register-form">
                        	<h3>Register</h3>
                            
                            <?php
                               if ( isset($errMSG) ) 
                               {
                            ?>
                                <div class="form-group">
                                        <div class="alert alert-<?php echo($errTyp=="success")?"success":$errTyp;?> ">
                                			<span class="glyphicon glyphicon-info-sign"></span>
                                            <?php echo $errMSG; ?>
                                        </div>
                                </div>           
                            <?php
                               }
                            ?>
                            
                        	<form action="login2_process.php" method="post">
                        		<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-user"></i></span>
  									<input type="text" name="uname" class="form-control" placeholder="Username">
								</div>
                             <br>
                        		<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
  									<input type="email" name="email" class="form-control" placeholder="Email">
								</div>
                             <br>
                        		<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
  									<input type="password" name="pass" class="form-control" placeholder="Password">
								</div>
                             <br>
                        		<!--<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-refresh"></i></span>
  									<input type="password" class="form-control" placeholder="Repeat Password">
								</div>
                             <br>-->
                             <button type="submit" class="btn btn-primary" name="btn-signup" >Register Now</button>
                     		</form>
                            
            			</div>
                        <!-- **************** EOF Registration Form **************** -->
                        
          			</div>
        		</div>
      		</div>
    	</div>
  </div>
  
  <!-- Start Site Footer -->
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