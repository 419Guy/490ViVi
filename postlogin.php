<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 lt-ie10"><![endif]-->
<!--[if IE 9]><html class="ie9 lt-ie10"><![endif]-->
<!--[if gt IE 9]><!--><html lang="en"><!--<![endif]-->

<?php
//create a session with username
//if you try to access this page without logging in, will be redirected
  session_start();
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header ("Location:index.php");

  }
  $username = $_SESSION['username'];
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="MobileOptimized" content="320">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title-->
    <title>NJIT Textbook Hub</title>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7COpen+Sans:300,400" rel="stylesheet">

    <!-- Framework/libraries/Plugins/style CSS start-->
    <link href="css/separate-css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/separate-css/animate.min.css" rel="stylesheet" type="text/css">
    <link href="css/separate-css/swiper.min.css" rel="stylesheet" type="text/css">
    <link href="css/separate-css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <!-- Framework/libraries/Plugins/style CSS end-->
    <!-- Favicon-->
     </head>
  <body>
    <!-- Page-wrapper start-->
    <div class="page-wrapper">
      <!-- start of overlay block. If you want to change color/opacity see main.css-->
      <div class="page-wrapper-overlay"></div>
      <!-- header start-->
      <header class="block_main-header">
        <!-- start of countdown block, how change this date see js (function countdownInit)-->
        <div class="block_main-header__countdown col-xs-12 col-sm-4 col-md-4">
         <div class="block_main-header__countdown col-xs-12 col-sm-4 col-md-4">
         <a href="logout.php">
      <button type="submit" class="block_main-footer__form-button animated fadeInUp"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text"> Logout</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
      </a>
       </div>
        <div class="block_main-header__countdown col-xs-12 col-sm-4 col-md-4">
          <a href="profile.php"><button type="submit" class="block_main-footer__form-button animated fadeInDown"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text">Profile</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
    	  </a>
		</div>
        
        <div class="block_main-header__countdown col-xs-12 col-sm-4 col-md-4">
         <a href="booktosell.php">
      <button type="submit" class="block_main-footer__form-button animated fadeInUp"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text"> Books to Sell</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
      </a>
       </div>
       <div class="block_main-header__countdown col-xs-12 col-sm-4 col-md-4">
          <a href="phpBB3" target="_blank"><button type="submit" class="block_main-footer__form-button animated fadeInDown"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text"> Forum</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
    </a>
       </div>
        </div>
        <!-- end of countdown block-->
        <!-- start of "logotype"/caption block-->
        <div class="block_main-header__banner col-xs-12 col-sm-6 col-md-6">
          <div class="block_main-header__banner-logo">
          <a href="index.php">
            <img class="img-responsive" src="images/into-loader.png
"></a>
          </div>
          <div class="block_main-header__banner-titles">
           
            <p class="block_main-header__banner-slogan">NJIT Textbook Hub</p>
          </div>
        </div>
        <!-- end of "logotype"/caption block-->
      </header>
      <!-- header end-->
     
      <!-- main footer start-->
      <div class="block_main-footer custom-container">
        <!-- footer subscribe form start-->
        <!-- subscribe form container start-->
        <div class="block_main-footer__form-container custom-container-centred">
       
          <form method="post" action="search-result.php" name="searchform" class="block_main-footer__form">

            <div class="block_main-footer__form-input-container col-xs-12 col-sm-12">
              <input type="text" name="title" placeholder="Enter Book Title Here" class="block_main-footer__form-input" required>
            </div>
            <div class="block_main-footer__form-button-container col-xs-12  col-sm-2">
              <button type="submit" class="block_main-footer__form-button"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text">  Search</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
            </div>
          </form>

        <a href="advancedsearch.php" style="color:white">Advanced Search</a><br><br>

	<form action= "course-search-resultmq.php" method="post" name="coursesearchform" class="block_main-footer__form">

            <div class="block_main-footer__form-input-container col-xs-12 col-sm-12">
              <input type="text" name="course" placeholder="Enter Course Here" class="block_main-footer__form-input" required>
            </div>
            <div class="block_main-footer__form-button-container col-xs-12  col-sm-2">
              <button type="submit" class="block_main-footer__form-button"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text">  Search</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
            </div>

    </form>

    <form action= "profilesearch.php" method="post" name="profilesearch" class="block_main-footer__form">

            <div class="block_main-footer__form-input-container col-xs-12 col-sm-12">
              <input type="text" name="username" placeholder="Enter Username Here" class="block_main-footer__form-input" required>
            </div>
            <div class="block_main-footer__form-button-container col-xs-12  col-sm-2">
              <button type="submit" class="block_main-footer__form-button"> <span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-normal block_main-footer__form-button__text-active"><span class="block_main-footer__form-button__text">  Search</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-error"> <span class="block_main-footer__form-button__text">  Error</span></span><span class="block_main-footer__form-button__text-container block_main-footer__form-button__text-success"> <span class="block_main-footer__form-button__text">  Success </span></span></button>
   	        </div>
    </form>


        <!-- footer subscribe form end-->
      </div>
      <!-- main footer end-->
      <!-- Page-wrapper end-->
    </div>

    <!-- Scripts/libraries/Plugins JS start-->
    <script src="js/separate-js/jquery.min.js"></script>
    <script src="js/separate-js/swiper.jquery.min.js"></script>
    <script src="js/separate-js/jquery.ajaxchimp.min.js"></script>
     <script src="js/main.js"></script>
    <!-- Scripts/libraries/Plugins JS end-->
  </body>

</html>
