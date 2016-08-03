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
                <li><a href="login.html">Register as Judge </a></li>
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
require_once('connection.php');
require_once('FPDF/fpdf.php');
require_once('FPDI/fpdi.php');
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
@mysql_select_db($database_localhost,$localhost);

//Method 4
include('class.pdf2text.php');

if( $_GET['catdropdown'] )
{
	//echo 'catdropdown = '.$_POST['catdropdown'];
	$category = $_GET['catdropdown'];
	$fileN = $_GET['fName'];
	echo 'catdropdown = '.$category.'</br>';
	echo 'fName = '.$fileN.'</br>';
	
	/********************BOF Selected All From Category Dropdown************************/
	/*if($_POST['catdropdown'] == "1")
	{*/
		//echo 'catdropdown in side all';
		$dirs = array_filter(glob('C:/xampp/htdocs/PdfSearch/pdfs/*'), 'is_dir');
		//print_r( $dirs);
		
		foreach($dirs as $item)
		{
			echo $item.'</br>';
			/* $item =
			[0] = C:/xampp/htdocs/PdfSearch/pdfs/acts
			[1] = C:/xampp/htdocs/PdfSearch/pdfs/nlrs
			[2] = C:/xampp/htdocs/PdfSearch/pdfs/slrs
			*/
			
			//foreach (glob("C:/xampp/htdocs/PdfSearch/pdfs/*.pdf") as $filename) //BOF foreach
			foreach (glob($item."/*.pdf") as $filename) //BOF foreach
			{
				$filenameFullPath = $filename;
				//echo "filenameFullPath = ".$filenameFullPath.'</br>';
				
				$filename = basename($filename);
				$version = pdfVersion($filename);

				if($version > 1.4)
				{
					$output = shell_exec( "gswin32c -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=new-file.pdf $filename");
					//$output = shell_exec( "gswin64c -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=new-file.pdf $filename");
				}
				
				$oldFileName = $filename;
				//echo "oldFileName = ".$oldFileName.'</br>';
				
				$fileNewname = str_replace(" ","_",$filename);
				//echo "fileNewname = ".$fileNewname.'</br></br>';
				
				//rename to new name without spaces
				rename("$filenameFullPath", "C:/xampp/htdocs/PdfSearch/$fileNewname");
				
				//$content = shell_exec('C:\xampp\htdocs\PdfSearch\xpdf\bin32\pdftotext '.$fileNewname.' -');
				//echo $content.'</br></br>';
				
				//$pdf = new FPDI();

				//$newFullPath = 'C:/xampp/htdocs/PdfSearch/'.$fileNewname;
				
				$tmp = explode('/', $item);
				$subDir = end($tmp);
				//split_pdf($filename , 'split/');
				split_pdf($fileNewname, '', $subDir);
				
				//rename back to original name with spaces
				rename("C:/xampp/htdocs/PdfSearch/$fileNewname", "$item/$oldFileName");
				
			} //EOF foreach
			
		}//EOF loop sub directory
		
	//} //EOF if($_POST['catdropdown'] == "1")
		
	/********************EOF Selected All From Category Dropdown************************/

}

foreach (glob("C:/xampp/htdocs/PdfSearch/*.pdf") as $filenameSplit) //BOF foreach
{
		//$filenameFullPathSplit = $filenameSplit;
		//echo "filenameFullPathSplit = ".$filenameFullPathSplit.'</br>';
		
		$filenameSplit = basename($filenameSplit);
		//echo "filenameSplit = ".$filenameSplit.'</br>';
		
		if (isset($filename))
		{
			$version = pdfVersion($filename);
		}
		
		
		$tmp = explode('_', $filenameSplit);
		$lastWithpdfext = end($tmp); //1-nlrs.pdf
		
		$tmp = explode('-', $lastWithpdfext);
		$pgNo = $tmp[0];
		
		//echo $lastWithpdfext.'</br>';
		//$pgNumber = split('.',$lastWithpdfext);
		$subDir = explode('.',$tmp[1]);
		$subD = $subDir[0];
		//echo $pgNo.'</br>';
		
		if($subD == "acts")
		{
			$cat = "2";
		}
		else if($subD == "nlrs")
		{
			$cat = "6";
		}
		else if($subD == "slrs")
		{
			$cat = "7";
		}
		
		$contentSplit = shell_exec('C:\xampp\htdocs\PdfSearch\xpdf\bin32\pdftotext '.$filenameSplit.' -');
		//echo $contentSplit.'</br></br>';
		
		$result = store_data($filenameSplit,$contentSplit,$pgNo,$cat);
		
		
} //EOF foreach

?>
 
  <!-- Start Content -->
   <div class="main" role="main">

<div align="Center">
<form action="index_sub.html" method="post">
</br>
    <input class="backBtn btn btn-primary " name="backBtn" type="submit" value="Back To Search" />
</form>
</div>

<div align="left" style="margin-left: 145px;">

<?php

	if($result)
	{
		//echo "pdf text files inserted".'</br></br>';
	}
	else
	{
		//echo "pdf text files already in db table".'</br></br>';
	}
	?>
    
<?php
	$text = $_GET['sText'] ;
	//echo "text = ".$text;
	search_data($text,$category,$fileN);
	/*$var1 = 1;
	header('Location: http://10.12.14.42:8080/PdfSearch/index_sub.html?suc='.$var1.'&trm='.$var2.'&cat='.$var3);
	exit;*/
	
	
/***************Functions******************/
?>
</div>

<?php
function split_pdf($filename, $end_directory = false, $cat)
{
	$end_directory = $end_directory ? $end_directory : './';
	$new_path = preg_replace('/[\/]+/', '/', $end_directory.'/'.substr($filename, 0, strrpos($filename, '/')));
	
	if (!is_dir($new_path))
	{
		// Will make directories under end directory that don't exist
		// Provided that end directory exists and has the right permissions
		mkdir($new_path, 0777, true);
	}
	
	$pdf = new FPDI();
	$pagecount = $pdf->setSourceFile($filename); //How many pages
	
	//Split each page into a new PDF
	for ($i = 1; $i <= $pagecount; $i++)
	{
		$new_pdf = new FPDI();
		$new_pdf->AddPage();
		$new_pdf->setSourceFile($filename);
		//$nb=$pdf->WordWrap($text,120);
		$new_pdf->useTemplate($new_pdf->importPage($i));
		
		try 
		{
			$new_filename = $end_directory.str_replace('.pdf', '', $filename).'_'.$i.'-'.$cat.".pdf";
			$new_pdf->Output($new_filename, "F");
			//echo "Page ".$i." split into ".$new_filename."<br/>\n";
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}	
	}
}


function pdfVersion($filename)
{ 
    $fp = @fopen($filename, 'rb');
 
    if (!$fp) 
	{
        return 0;
    }
 
    /* Reset file pointer to the start */
    fseek($fp, 0);
 
    /* Read 20 bytes from the start of the PDF */
    preg_match('/\d\.\d/',fread($fp,20),$match);
 
    fclose($fp);
 
    if (isset($match[0])) 
	{
        return $match[0];
    } 
	else 
	{
        return 0;
    }
} 

 
function get_text($textfile) 
{
     $text = file_get_contents($textfile);
     return $text;
}


function store_data($filename,$text,$page,$cat) 
{
	   $text = str_replace("'", "''", $text);
	  
	   $query = "INSERT INTO pdf_data_with_page_ctgry(pdf_contents, filename, page, category) VALUES ('{$text}', '{$filename}','{$page}','{$cat}')";
	   
	   @mysql_query($query);
}


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
         echo '<h4>Result found in</h4> <br>';
		
		 if($cat == '1')
		 {
			echo '<h5>----- All -----</h5>';
			echo '<h4>'.$fileN.'</h4>';
		 }
		 if($cat == '2')
		 {
			 echo '<h5>----- Acts -----</h5>';
			 echo '<h4>'.$fileN.'</h4>';
			 $dir = "acts/";
		 }
		 else if($cat == '6')
		 {
			 echo '<h5>----- NLR -----</h5>';
			 echo '<h4>'.$fileN.'</h4>';
			 $dir = "nlrs/";
		 }
		 else if($cat == '7')
		 {
			 echo '<h5>----- SLR -----</h5>';
			 echo '<h4>'.$fileN.'</h4>';
			 $dir = "slrs/";
		 }
		 $array = array();
		 
		 while($row = @mysql_fetch_array($result)) 
		 {		
				//MySQL is going to return the rows to you in order of relevance (descending).
				
				//echo '<p><a href="http://10.12.14.42:8080/PdfSearch/'.$row['filename'].'" target="_blank">'. $row['filename']. '</a></p>';
				$fileOrigname = str_replace("_"," ",$row['filename']);
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
				
				//echo '<p><a href="http://10.12.14.42:8080/PdfSearch/pdfs/'.$subDir.$fileOrigname.'#page='.$row['page'].'&search=%22'.$term.'%22" target="_blank">'. $fileOrigname.'  => page '.$row['page'].'</a></p>';
				echo '<p><a href="http://10.12.14.42:8080/PdfSearch/pdfs/'.$subDir.$fileOrigname.'#page='.$row['page'].'" target="_blank">Page '.$row['page'].'</a></p>';
				
				?>
				<div id="sentences" style="margin-left:35px">
                <?php
				$paragraph = $row['pdf_contents'];
				//echo $paragraph. '</br>';
				$array  = explode(' ', $paragraph);
				
				//print_r($array);
				//echo '</br> term ='.$term;
				
				$keys = array_keys($array,$term);
				
				/**********BOF For half the word search************/
				if(empty($keys))
				{
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
				}
				/**********EOF For half the word search************/
				
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
				}
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
