#!/usr/bin/php
<?php
//will need to run in order for login to work. If code is not running client cannot connect.
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password) //username and password come from client
{
    // lookup username in database
    // check password
	$db = new mysqli("localhost", "root", "khLux2016", "project");

        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	$username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);

	$sql = "select * from register where username = '$username' AND password = sha2('$password', 256)";
	 if(!$result = $db->query($sql)){
                die ('There was an error running the query [' . $db->error . ']'); //will state error in query
}
	$count = $result->num_rows;

        if ($count == 0){
        echo"Sorry, wrong password.  Please try again.";
	return false;
        }else{
	echo " Thank you for logging in/n";
	$query = "update register set login_time = NOW() where username = '$username' AND password = sha2('$password', 256)";
		//we know what time and day user has logged in
                if(!$result2 = $db->query($query)){
                 die ('There was an error running the query [' . $db->error . ']');
        }

    	//return false if not valid
		
		while ($row = $result->fetch_assoc())
		{
			//loop will print in server the information from database of that user
   		print_r($row);
		}
	return true;		


	}	
}
function requestProcessor($request)
{

  echo "received request".PHP_EOL;
  var_dump($request);
	$result = doLogin($request['username'], $request['password']); 
	if($result == true){
	return array("returnCode" => '0', 'message'=>"Server received request and processed"); //sending back to client
	}else{
		return array("returnCode" => '1', 'message'=>"Server received request and processed"); //sending back to client
	}
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
