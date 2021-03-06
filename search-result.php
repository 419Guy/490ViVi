<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

include('session2.php');

?>

<!doctype html>
<html class="fixed">
	
<head>

		<!-- Basic -->
		<meta charset="UTF-8">
        	<title>Search Result</title>
		<meta name="keywords" content="" />
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />		
        <link rel="stylesheet" href="assets/vendor/select2/select2.css" />		

        <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />	
        	<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />	
            	<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />	
                	<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
                    		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />		
                            <link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />	
                            	<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />	
                                	<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />		
                                    <link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
        <style type="text/css">
            @media only screen and (min-width: 768px) {
        html.fixed .content-body {
		margin-left:0px;
		margin-right:0px;
	}
            }
        
        </style>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="postlogin.php" class="logo">
						<img src="assets/images/logo.png" class="img-responsive" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					
			
					<span class="separator"></span>
			
					
			<a href="postlogin.php"><button class="btn btn-primary">HOME</button></a>
           <a href="contact-us.php"><button class="btn btn-primary">Contact Us</button></a>
					<span class="separator"></span>
			
					
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				

				<section role="main" class="content-body">
					
                     <h1 style="text-align:center; color:#2e241a; font-weight:900; text-decoration:underline;">Search Results</h1>
					<!-- start: page -->
						<div class="row">

							<div class="col-xs-12">
                            
								<section class="panel">
                               
									<header class="panel-heading">
										
						
										<h2 class="panel-title">Search Results</h2>
									</header>
									
<?php

$client = new rabbitMQClient("booksearch.ini","testServer");

        $request = array();
        $request['title'] = $_POST['title'];
	$_SESSION['title'] = $request['title'];
        $request['author'] = $_POST['author'];
        $_SESSION['author'] = $request['author'];
	$request['isbn13'] = $_POST['isbn13'];
	$_SESSION['isbn13'] = $request['isbn13'];
       $request['publisher'] = $_POST['publisher'];
	$_SESSION['publisher'] = $requset['publisher'];
	 $response = $client->send_request($request);
?>									
                                   <div class="panel-body">							<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed mb-none">
										<thead style="background-color:#2e241b; color:White;">
											<tr>
												<th class="text-center">Book Title</th>
		
		<th class="text-center">Author(s)</th>
               <th class="text-center">Publisher</th>
	
		<th class="text-center">ISBN(s)</th>
					
		<th class="text-center">Year</th>
																	
											</tr>
										</thead>
<?php	
	 if($response['returnCode'] == 1){
                echo "Sorry, we could not find the book you wanted\n";
        }else{
?>

<tbody>
											<tr>
	<?php
		foreach($response as $value){
                echo $value;
	?>		
												
											</tr>
										</tbody>
			
<?php
 }
 }

?>

						</table>
								</div>
							</div>
                                            
											
                                            
						
                                            
											
						
											
						
											
						
										
								</section>
							</div>
						</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
					<!-- end: page -->
				</section>
			</div>

			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>		<script src="assets/vendor/style-switcher/style.switcher.js"></script>		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>		<script src="assets/vendor/select2/select2.js"></script>		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>		<script src="assets/vendor/fuelux/js/spinner.js"></script>		<script src="assets/vendor/dropzone/dropzone.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>		<script src="assets/vendor/codemirror/mode/css/css.js"></script>		<script src="assets/vendor/summernote/summernote.js"></script>		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>		<script src="assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<!-- Analytics to Track Preview Website -->		<script>		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)		  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');		  ga('create', 'UA-42715764-8', 'auto');		  ga('send', 'pageview');		</script>

		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.advanced.form.js"></script>
        <script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
	</body>

</html>
