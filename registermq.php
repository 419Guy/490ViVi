
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("register.ini","testServer");

	$request = array();
	$request['firstname'] = $_POST['firstname'];
	$request['lastname'] = $_POST['lastname'];
	$request['username'] = $_POST['username'];
	$request['email'] = $_POST['email'];
        $request['password'] = $_POST['password'];
	
	$response = $client->send_request($request);
	//echo "client received response: ". PHP_EOL;
	//var_dump($response);

	if($response['returnCode'] == 0){
		 session_start();
                $_SESSION['login'] = "1";
               header ("Location:postlogin.php");
		//redirect to postlogin.php if user logged in.  Now whether user truly signed in...
	}else{

		echo "Sorry, user already exists in database.";
		header ("Refresh: 2; url = login.html#toregister");
		//echo "<a href=login.html#toregister>Return</a>";
	}
		
?>

