<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	$request = array();
	$request['username'] = $_POST['username'];
        $request['password'] = $_POST['password'];
	//$request['username'] = 'NewFlash52';
        //$request['password'] = 'lindapark';
	$username = $request['username'];
	
	$response = $client->send_request($request);
	//echo "client received response: ". PHP_EOL;
	//var_dump($response);
	if($response['returnCode'] == 0){
		 session_start();
                $_SESSION['username'] = $username;
                header ("Location:postlogin.php");
		//redirect to postlogin.php if user logged in
	}else{
		echo "Sorry, wrong password.  Please try again.";
		echo "<br><a href=login.php>Return</a>";
	}
		
?>
