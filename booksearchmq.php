
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
	
	$response = $client->send_request($request);
	//echo "client received response: ". PHP_EOL;
	//var_dump($response);
		//redirect to postlogin.php if user logged in
	if($response['returnCode'] == 1){
		echo "Sorry, we could not find the book you wanted\n";
	}else{
	
		foreach($response as $value){
		echo $value;
	}
	}	
?>

