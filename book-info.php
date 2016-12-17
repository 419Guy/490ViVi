<?php
include('session2.php');

?>

<!doctype html>
<html class="fixed">
	
<head>
        
		<!-- Basic -->
		<meta charset="UTF-8">
        	<title>Book Info</title>
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
		<!-- src="assets/vendor/modernizr/modernizr.js" this is for script tag -->
		<script>
<!--Scripts -->

	function amazon(){
		  var bookstore_url = document.getElementById("bookstore_url").value;
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var element = document.getElementById("url_links");
				JSON.parse(xhttp.responseText).forEach(function(url_name){
					var para = document.createElement("a");
					var br = document.createElement("br");
					var node = document.createTextNode("Amazon");
					para.appendChild(node);
					para.setAttribute('href', url_name);
					element.appendChild(para);
					element.appendChild(br);
				});
			}
		  };
		  /*****
		  		CHANGE THE URL TO YOUR URL LOCATION
		  *****/
		  xhttp.open('POST','amazon.php',true);
		  xhttp.setRequestHeader('Content-Type', 'application/json');
		  xhttp.send(bookstore_url);
		  return false;
		}
		
		function barnesAndNobels(){
		  var bookstore_url = document.getElementById("bookstore_url").value;
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var element = document.getElementById("url_links");
				JSON.parse(xhttp.responseText).forEach(function(url_name){
					var para = document.createElement("a");
					var br = document.createElement("br");
					var node = document.createTextNode("B&N");
					para.appendChild(node);
					para.setAttribute('href', url_name);
					element.appendChild(para);
					element.appendChild(br);
				});
			}
		  };
		  /*****
		  		CHANGE THE URL TO YOUR URL LOCATION
		  *****/
		  xhttp.open('POST','ban.php',true);
		  xhttp.setRequestHeader('Content-Type', 'application/json');
		  xhttp.send(bookstore_url);
		  return false;
		}
		
		function albris(){
		  var bookstore_url = document.getElementById("bookstore_url").value;
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var element = document.getElementById("url_links");
				JSON.parse(xhttp.responseText).forEach(function(url_name){
					var para = document.createElement("a");
					var br = document.createElement("br");
					var node = document.createTextNode("Albris");
					para.appendChild(node);
					para.setAttribute('href', url_name);
					element.appendChild(para);
					element.appendChild(br);
				});
			}
		  };
		  /*****
		  		CHANGE THE URL TO YOUR URL LOCATION
		  *****/
		  xhttp.open('POST','albris.php',true);
		  xhttp.setRequestHeader('Content-Type', 'application/json');
		  xhttp.send(bookstore_url);
		  return false;
		}



</script>
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
				<a href="index.php" class="logo">
						<img src="assets/images/logo.png" class="img-responsive" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					
			
					<span class="separator"></span>
			
					
			<a href="index.php"><button class="btn btn-primary">HOME</button></a>
           <a href="contact-us.php"><button class="btn btn-primary">Contact Us</button></a>
					<span class="separator"></span>
			
					
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
<?php
include('db.php');
if(isset($_POST['pricecheck'])){
	$title = $_POST['title'];
	$isbn = $_POST['isbn'];
	$search_sql = "select distinct title1, author, year, publisher, isbn, price1a, price1b, price1c from textbooks where `title1` like '%".$title."%' and isbn='$isbn'";
	$course_sql = "select course from textbooks where `title1` like '%".$title."%' and isbn='$isbn'";

}else{
$title = $_SESSION['title'];
$author = $_SESSION['author'];
$isbn = $_SESSION['isbn13'];
$publisher = $_SESSION['publisher'];

$sql = "select distinct title1, author, year, publisher, isbn, price1a, price1b, price1c from textbooks";

 $conditions = array();

                if($title !=""){
                        $conditions[] = "`title1` LIKE '%".$title."%'";
                }
                if($author != ""){
                        $conditions[] = "`author` LIKE '%".$author."%'";
                }
                if($isbn != ""){
                        $conditions[] = "`isbn` LIKE '%".$isbn."%'";
                }
                if($publisher !=""){
                        $conditions[] = "`publisher` LIKE '%".$publisher."%'";
                }
                                $search_sql = $sql;
                if (count($conditions) > 0){
                        $search_sql.= " WHERE " . implode( ' AND ', $conditions);
                }





$course_sql = "select course from textbooks where `title1` like '%".$title."%'";


}

$result2=mysqli_query($db,$search_sql);
$result3=mysqli_query($db,$course_sql);
?>

			<div class="inner-wrapper">
				

				<section role="main" class="content-body">
					
                     <h1 style="text-align:center; color:#2e241a; font-weight:900; text-decoration:underline;">Search Result</h1>
					<!-- start: page -->
						<div class="row">

							<div class="col-xs-12">
                            
								<section class="panel">
                          

<?php
	$booktitle;
	$isbn;
	$coursenum;
 while($rows2=mysqli_fetch_array($result3)){
	$coursenum=$rows2['course'];}
        while($rows=mysqli_fetch_array($result2)){
		//$coursenum=$rows['course'];	
?>
									
										
                                           <div class="panel-body">
                                           <div class="col-xs-12 col-md-12">
                                           <h3 style="text-align:center; font-weight:900;"><?php echo $rows['title1'];?></h3>
                                           </div>
                                           <div class="row">
				<div class="col-xs-12 col-md-6 text-center">
                                <h3><?php $booktitle = $rows['author']; echo "Author(s): ". $rows['author'];?></h3>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                </div>

                                </div>
                                <div class="row">
                                <div class="col-xs-12 col-md-6 text-center">
                                <h3><?php echo "Year: ".$rows['year'];?></h3>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                <h3><?php echo "NJIT New Buy Price: ".$rows['price1a'];?></h3>
                                </div>
							</div>
                                            
								<div class="row">
                                <div class="col-xs-12 col-md-6 text-center">
                                <h3><?php echo "Format: ". $rows['type1a'];?></h3>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                <h3><?php echo "NJIT Used Buy Price: ".$rows['price1b'];?></h3>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 text-center">
                                <h3><?php echo "Publisher: ".$rows['publisher'];?></h3>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                <h3><?php echo "NJIT Rent Price: ".$rows['price1c'];?></h3>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 text-center">
                                <h3><?php $isbn=$rows['isbn']; echo "ISBN(s): ". $rows['isbn'];?></h3>
                                </div>
<?php
};
?>
                                <div class="col-xs-12 col-md-6">
  <?php
                                        $query = "select * from booksale where title1 = '$title' and isbn = '$isbn'";
                                       if(!mysqli_query($db, $search_sql)){
        echo "Error message: ".mysqli_error($db);
}
 
                                        $result=mysqli_query($db,$query); 
					$count = mysqli_num_rows($result);
					if($count != 0){
                                      while($row=mysqli_fetch_array($result)){

?>
				<h3><?php echo "User ".$row['username'] . " Sales Price:  ".$row['saleprice'];}}?>	</h3>
                                </div>
							</div>
                            			
                    
<input type="text" style="display: none" name="bookstore_url" id="bookstore_url" size="130"
value="<?php
include('db.php');
$query2 = "select Book_Info from Course where Call_Num='$coursenum'";
$result=mysqli_query($db,$query2);
while($rows=mysqli_fetch_array($result)){
        $bookstore_url = $rows['Book_Info'];
        echo htmlentities($bookstore_url);
};

?>"/>

                <br>
                        <button id="bookstoreReq" onclick="amazon()">Amazon</button>
                        <button id="bookstoreReq" onclick="barnesAndNobels()">B&N</button>
                        <button id="bookstoreReq" onclick="albris()">Albris</button>
						       <div style="text-align: left; font-size: 150%; margin: 30px;" id="url_links">
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
