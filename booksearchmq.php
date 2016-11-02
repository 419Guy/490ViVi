
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("booksearch.ini","testServer");

	$request = array();
	$request['title'] = $_POST['title'];
        $request['author'] = $_POST['author'];
	$request['isbn13'] = $_POST['isbn13'];
	$request['publisher'] = $_POST['publisher'];
	$request['course'] = $_POST['course'];
		

	$request['title'] = "";
        $request['author'] = "";
        $request['isbn13'] = "";
        $request['publisher'] = "";
        $request['course'] = "";


	
	$response = $client->send_request($request);
	//echo "client received response: ". PHP_EOL;
	//var_dump($response);
		//redirect to postlogin.php if user logged in

	//}else{

	//	echo "Sorry, wrong password.  Please try again.";
	//	echo "<br><a href=login.html>Return</a>";
	//}
		
?>

