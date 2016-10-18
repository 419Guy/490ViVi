#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$request = array();
	$request['username'] = $argv[1];
	$request['password'] = $argv[2];
	
	$response = $client->send_request($request);
	echo "client received response: ". PHP_EOL;
	
//	session_start();
  //      $_SESSION['login'] = "1";
    //    header ("Location:postlogin.php");

	
?>

