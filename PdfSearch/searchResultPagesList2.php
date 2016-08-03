<?php
 //ob_start();
 session_start();
 
 require_once('connection.php');
 error_reporting(E_ALL & ~E_NOTICE);
 @mysql_select_db($database_localhost,$localhost);

 if( isset($_SESSION['user'],$_SESSION['userName']) ) 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="pdfjs/web/ui_utils.js"></script>
<script src="pdfjs/web/text_layer_builder.js"></script>
  
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
                <li class="active"><a href="index_sub.html">Home</a> </li>
                <li><a href="#">About Us</a></li>
                <li><a href="login2_process.php">Register as Judge </a></li>
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
  </div>
 
<?php
require_once('FPDF/fpdf.php');
require_once('FPDI/fpdi.php');
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
@mysql_select_db($database_localhost,$localhost);

include('class.pdf2text.php');

if( isset($_GET['catdropdown'],$_GET['fName'],$_GET['sText']) )
{
	$category = $_GET['catdropdown'];
	$fileN = $_GET['fName'];
	$text = $_GET['sText'];
	/*echo 'catdropdown = '.$category.'</br>';
	echo 'fName = '.$fileN.'</br>';
	echo 'sText = '.$text.'</br>';*/
	
} //EOF isset($_GET['catdropdown'],$_GET['fName'],$_GET['sText'])

?>
 
<!-- Start Content -->
<div class="main" role="main">

  <div align="Center">
  <form action="index_sub.php" method="post"></br>
      <input class="backBtn btn btn-primary " name="backBtn" type="submit" value="Back To Search" />
  </form>
  </div>

  <div align="left" style="margin-left: 145px;">
  <?php
      search_data($text,$category,$fileN);
  ?>
  </div>

<?php

/***************Functions******************/

function search_data($term,$cat,$fileN) 
{
     $term = @mysql_real_escape_string($term);
     
	 if($cat == '1') // if all
	 {
		 $query = "SELECT * FROM pdf_data_with_page_ctgry WHERE (CONCAT(pdf_contents) LIKE '%".$term."%') AND name = '".$fileN."' "; 
	 }
	 else
	 {
		 $query = "SELECT * FROM pdf_data_with_page_ctgry WHERE (CONCAT(pdf_contents) LIKE '%".$term."%' ) AND category = '".$cat."' AND name = '".$fileN."' "; 
	 }
	 
     $result = @mysql_query($query) or die("Couldn't return = ". mysql_error());
	 
	 if( @mysql_num_rows($result) > 0)
	 {   
         echo '<h4>Result found for "<strong><font color="#398CD5">'.$term.'</font></strong>" in</h4><br>';
		 
		 if($cat == '1')
		 {
			echo '<h5>----- All -----</h5>';
			echo '<h4>'.$fileN.'</h4></br>';
		 }
		 if($cat == '2')
		 {
			 echo '<h5>----- Acts -----</h5>';
			 echo '<h4>'.$fileN.'</h4></br>';
			 $dir = "acts/";
		 }
		 else if($cat == '6')
		 {
			 echo '<h5>----- NLR -----</h5>';
			 echo '<h4>'.$fileN.'</h4></br>';
			 $dir = "nlrs/";
		 }
		 else if($cat == '7')
		 {
			 echo '<h5>----- SLR -----</h5>';
			 echo '<h4>'.$fileN.'</h4></br>';
			 $dir = "slrs/";
		 }
		 $array = array();
		 $array2 = array();
		 
		 while($row = @mysql_fetch_array($result)) 
		 {		
		 		//print_r($row);
				//MySQL is going to return the rows to you in order of relevance (descending).
				
				//echo '<p><a href="http://127.0.0.1:8000/PdfSearch/'.$row['filename'].'" target="_blank">'. $row['filename']. '</a></p>';
				$fileOrigname = str_replace("_"," ",$row['filename']); //Wijemunige_David_Singho_and_Others_vs_1-slrs.pdf
				$tmp = explode(' ', $fileOrigname);
				
				//$fileOrigname = end($tmp);
				//001-NLR-NLR V 01-UDUMA  LEBBE et al  v. SEYADU ALIet al 1.pdf
				
				$size = count($tmp) - 1;
				
				$last_word = array_pop($tmp);
				$first_chunk = implode(' ', $tmp);
				
				$subDir = $row['category'];
				
				if($subDir == "2")
				{
					$subDir = 'acts/';
				}
				else if($subDir == "6")
				{
					$subDir = 'nlrs/';
				}
				else if($subDir == "7")
				{
					$subDir = 'slrs/';
				}
				$fileOrigname = $first_chunk.'.pdf';
			    
				echo '<ol>';
				
				//echo '<p>'. $fileOrigname.'</p>';
				
				echo '<p><a href="http://127.0.0.1:8000/PdfSearch/pdfs/'.$subDir.$fileOrigname.'#page='.$row['page'].'" target="_blank">Page '.$row['page'].'</a></p>';
				
				?>
				<div id="sentences" style="margin-left:35px">
                <?php
				$paragraph = $row['pdf_contents'];
				//echo $paragraph. '</br>';
				$arrayOrig  = explode(' ', $paragraph);
				$array  = array_map('strtolower', $arrayOrig);
				//print_r($array);
				//echo '</br> term ='.$term;
				$termOrig = $term;
				
				$term = strtolower($termOrig);
				$array2 = explode(' ', $term);
				//echo 'array2 array =  </br>';
				//echo '</br>';
				//print_r($array2); //Array ( [0] => Appeal [1] => No. [2] => 58/2011 )
				//echo '</br>';
				//echo count($array2); //3
				
				
				//**********BOF For sentence search************
				if( count($array2) > 1 ) //sentence
				{
					/*
					echo "</br>Searched A sentence</br>";
					$keysS = array_keys($array,$array2[0]); //first word of the searched sentence
					$keysE = array_keys($array,$array2[count($array2) -1]); //last word of the searched sentence
					
					print_r($keysS);
					print_r($keysE);
					echo "----</br>";
					$sentance  = '';
					
					foreach ($keysS as &$value) 
					{
						$strt = $value - 4;
						$lastWrdPos = $value + count($array2)-1; //for each start word + (number of words in searched sentence) check that last position is actually last word of searched sentence
						
						//echo 'strt value'.$strt.'</br>';
						//echo 'end value'.$lastWrdPos.'</br>';
						//echo "from the paragraph get strat word ".$array[$strt].'</br>';
						//echo "from the paragraph count and get relevent word ".$array[$lastWrdPos].'</br>';
						
						//echo 'searched sentence last word '.$array2[count($array2)-1].'</br>';
						
							if($array[$lastWrdPos] == $array2[count($array2)-1] )
							{
								echo "Complete string".'</br>';
								//$sentance .= $array[$strt];
								$sub = mb_substr($paragraph, $strt, $lastWrdPos);
								echo $sub.'</br>';
								
								$linkText = '...'.$sub."<font color='#FF0000'>".$term.' '.'</font>';
								$sentance = '';
								
							}
							
						
					}
					foreach ($keysE as &$value) 
					{
						$end = $value + 4;	
					}
					
					//echo 'strt '.$strt .'</br>';
					//echo 'end '.$end .'</br>';
					
					for($x=1; $x<=4; $x++)
					{
						//echo 'value '.$strt . '</br>';
						if(array_key_exists($strt,$array))
						{
							$sentance .= $array[$strt].' ';
						}
						$strt++;
					}
					unset($array2);
					
					$linkText = '...'.$sentance."<font color='#FF0000'>".$term.' '.'</font>';
					$sentance = '';
					$strt++;
					for($x=1; $x<=4; $x++)
					{
						//echo 'value '.$strt . '</br>';
						if(array_key_exists($strt,$array))
						{
							$sentance .= $array[$strt].' ';
						}
						$strt++;
					}
					$linkText .= $sentance.'...</br>';
					echo $linkText;
					$sentance = '';
					*/
					
					//--------------------BOF OLD--------
					
					/*
					$lastPos = 0;
					$positions = array();
					while (($lastPos = strpos($paragraph, $term, $lastPos))!== false) 
					{
						$positions[] = $lastPos;
						$lastPos = $lastPos + strlen($term);
					}
					
					foreach ($positions as $value) 
					{
						//echo $value ."<br />";
						//echo substr($paragraph, $value - 70)."<br />";
						$str = mb_substr ($paragraph , $value - 40 , 80 );
						
						//print_r( str_split($str, $value) );
						echo '...'.$str."...<br />";
					}
					*/
					//--------------------EOF OLD--------
					
				} //EOF if sentence
				//**********EOF For sentence search************
				
				
				//**********BOF For one word search************
				//echo 'Count Array2 '.count($array2[0]).'</br>';
				$keys = array_keys($array,$array2[0]);
				echo 'keys count = '.count($keys).' </br>';
				
				if( (count($keys) >= 1) && (count($array2) == 1) )
				{
					echo "</br>Searched A Word</br>";
					//print_r($keys);
					
					$sentance  = '';
					
					foreach ($keys as &$value) 
					{
						$strt = $value - 4;
						$end = $value + 4;
						//echo 'strt '.$strt .'</br>';
						//echo 'end '.$end .'</br>';
						
						for($x=1; $x<=4; $x++)
						{
							//echo 'value '.$strt . '</br>';
							if(array_key_exists($strt,$array))
							{
								$sentance .= $array[$strt].' ';
							}
							$strt++;
						}
						
						$linkText = '...'.$sentance."<font color='#FF0000'>".$term.' '.'</font>';
						$sentance = '';
						$strt++;
						for($x=1; $x<=4; $x++)
						{
							//echo 'value '.$strt . '</br>';
							if(array_key_exists($strt,$array))
							{
								$sentance .= $array[$strt].' ';
							}
							$strt++;
						}
						$linkText .= $sentance.'...</br>';
						echo $linkText;
						$sentance = '';
						//$isGivingWordResult = true;
						unset($array2);
						
					}//EOF foreach

				} // EOF if one word search
				//**********EOF For one word search************
				
				
				//**********BOF For half the word search************
				
				//if( count($keys) == 0 ) //half the word search
				else
				{
					echo "Searched half Word</br>";

					$lastPos = 0;
					$positions = array();
					
					while( ($lastPos = strpos(strtolower($paragraph), strtolower($term), $lastPos)) !== false )
					{
						//echo '</br>'.$lastPos.'</br>';
						$positions[] = $lastPos;
						//print_r($positions);
						$lastPos = $lastPos + strlen($term);
					}
					
					foreach ($positions as $value) 
					{
						//echo $value ."<br />";
						//echo substr($paragraph, $value - 70)."<br />";
						if(($value - 40) >= 0)
						{
							$str = mb_substr($paragraph , $value - 40 , 80 );
						}
						else //if the word is at the very begin of the paragraph ($value - 40) will give negative position
						{
							$str = mb_substr($paragraph , 0 , 40 );
						}
						//print_r( str_split($str, $value) );
						//echo '...'.$str."...<br />";
						$pieces = explode(strtolower($term), strtolower($str));
						//print_r($pieces); //take last occurance of searched text
						$linkText = '...'.$pieces[count($pieces)-2]."<font color='#FF0000'>".$term.'</font>'.$pieces[count($pieces)-1].'...</br>';
						echo $linkText;
						//echo preg_replace('/\b('.$term.')\b/i', '<font color="#FF0000">'.$i.'</font>', $str).'<br />';
					}
					
				} //EOF if half the word search
				//**********EOF For half the word search************
				
				
				?>
				</div> <!-- EOF <div id="sentences"> -->
				<?php
                echo '<hr>';
				echo '</ol>';
				//print_r($row['id']);
		 }
		 echo '</br>';
	 }
	 else
	 {
		echo '<h4>No matching result.</h4><br>'; 
	 }
}

?>
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
