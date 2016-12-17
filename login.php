<?php
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './phpBB3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
//include($phpbb_root_path . 'includes/functions.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('');







        $registernow = request_var('redirect','',true);
if ($registernow){
            $username   = request_var('username', '', true);
        $password   = request_var('password', '', true);
            $autologin  = $request->is_set_post('autologin');

    $result = $auth->login($username, $password, $autologin);
if ($result['status'] == LOGIN_SUCCESS)
{
    // Logged in
            header ("Location:postlogin.php");
        die();
}
else
{
    $wrongpass=1 ;// Something went wrong
}}       





$email = request_var('email','',true);
if ($email){
    include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

$username = request_var('username','',true);
$email = request_var('email','',true);
$password = request_var('password','',true);
$password_confirm = request_var('passwordsignup_confirm','',true);
$data = array("username"=>$username,"email"=>$email,"password"=>$password);

// In this example, the $data array should contain the validated input fields for
// username, password, email.
$user_row = array(
    'username'              => $data['username'],
    'user_password'         => phpbb_hash($data['password']),
    'user_email'            => $data['email'],
    'group_id'              => 2, // by default, the REGISTERED user group is id 2
    'user_timezone'         => (float)"1.00",
    'user_lang'             => "en",        // lang
    'user_type'             => USER_NORMAL,
    'user_ip'               => $user->ip,
    'user_regdate'          => time(),
);

if ($password != $password_confirm) {
    $p=1;
}else{
    $p=0;
}
$error = validate_username($user_row['username']);

if ($error) {
    $e = 1;
}else{
    $e = 0;
}

if (!$error and $p==0)
{
    // Register user...
    $user_id = user_add($user_row);
if ($user_id) {
       $sec=1;
   } else{
        $sec=0;
   }
}
}

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration Form with HTML5 and CSS3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login to your account" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Login<span> to your account</span></h1>
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form method="post" autocomplete="on"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <?php if($wrongpass == 1) { ?> <label style="color: red">  *  You have specified an incorrect username or password.</label><br /> <?php } ?> 

                                    <label for="username" class="uname" data-icon="u" > Your username </label>
                                    <input id="username" name="username" required="required" type="text"  placeholder="Username" <?php echo 'value="'.$username.'"'; ?> />
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. 12345" /> 
                                </p>
                                <p>
                                    <label for="autologin">Log me on automatically each visit <input type="checkbox" name="autologin" id="autologin" /></label>
                                </p>
                                <input type="hidden" name="redirect" value="1" />
             
                                <p class="login button"> 
                                    <input type="submit" name="login" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Sign Up!</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form   method="POST" autocomplete="on"> 
                                <h1> Sign up </h1> 

				                <p> 
                                    <?php if($sec == 1) { ?> <label style="color: green">  Thank you for registering, your account has been created. You may now <a href="#tologin">login</a> with your username and password.</label><br /> <?php } ?> 
                                    <?php if($e == 1) { ?> <label style="color: red">  *  The username you entered is already in use, please select an alternative.</label><br /> <?php } ?> 
                                    <?php if($p == 1) { ?> <label style="color: red">  *  The confirmation code you entered was incorrect.</label><br /> <?php } ?> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="username" placeholder='schooluser918' required="required" type="text" <?php  echo 'value="'.$username.'"'; ?>   />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="email" required="required" placeholder='jk123@njit.edu' type="email" <?php echo 'value="'.$email.'"'; ?> /> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. 12345"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. 12345"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a id="autowhenregister" href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>

                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
