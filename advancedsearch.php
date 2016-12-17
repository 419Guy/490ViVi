<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<?php
	//run sesssion as the user logged in
	session_start();
	$username = $_SESSION['username'];
?>

    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login to your account" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
	<title>Textbook Advanced Search</title>
    </head>


    <body>
        <div class="container">
            <header>
                <h1><span>Textbook Advanced Search</span><?php echo"  $username";?></h1>
            </header>
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
			<div id="login" class="animate form" >     
                        <form  action="booksearchmq.php" method="POST" autocomplete="on"> 
                                <h1>Advanced Search</h1> 
                                <p> 
                  <label for="title" class="title"> Textbook Title </label>
                     <input id="title" name="title" type="text" placeholder="The Foot Book"/>
                                </p>
                                <p> 
                          <label for="author" class="author"> Author </label>
                     <input id="author" name="author" type="text" placeholder="Dr.Seuss" /> 
                                </p>
				
					
             
			<label for="isbn13" class="isbn13"> ISBN-13 </label>
                     <input id="isbn13" name="isbn13" type="text" placeholder="1234567890123"/>
                                </p>
			<label for="publisher" class="publisher"> Publisher </label>
                     <input id="publisher" name="publisher" type="text" placeholder="McGraw-Hill"/>

			</p>
<!--	<p>
<label for="course" class="course"> NJIT Course </label>
                     <input id="course" name="course" type="text" placeholder="IT490"/>
	                               
                             </p> -->

			<p class="login button"> 
                                    <input type="submit" value="Search" /> 
								</p>
                              <p class="change_link">
                                                                        Return to homepage?                                                                    <a href="postlogin.php">Return</a>
<!--if user is logged in, page will return to postlogin, else it will return to index.html which is for users not logged in -->
                                                                </p>
   
                            </form>
			</div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html
