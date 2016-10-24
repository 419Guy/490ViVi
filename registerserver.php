#!/usr/bin/php
<?php
//needs to run in order to register
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doRegister($firstname,$lastname,$username,$email,$password)
{
   // variables come from registermq.php
    // register user into database
	$db = new mysqli("localhost", "root", "khLux2016", "project");

        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	$query_count = "select * from register where username = '$username' AND password = sha2('$password',256)";

	if (!$result = $db->query($query_count)){
        die ('There was an error running the query [' . $db->error . ']');
}
//tell me what the error was in the query
	$count = $result->num_rows;

        if($count == 1){
        echo "User is already registered/n";
	echo "This is: $count";
	 while ($row = $result->fetch_assoc()){
                                print_r($row);
         }

	return false;
	}else{
        	$query = "insert into register (firstname, lastname, username, email, password, registration_time, login_time)  values('$firstname', '$lastname', '$username', '$email', sha2('$password',256), NOW(), NOW())";
        //place new user into database
		if ($result = $db->query($query)){
		echo "New user has been added.";
		}else{
		die ('There was an error running the query [' . $db->error . ']');
        	}
	$query_out = "select * from register where username = '$username' AND password = sha2('$password',256)";
                if (!$result = $db->query($query_out)){
                die ('There was an error running the query [' . $db->error . ']');
}
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
	$result = doRegister($request['firstname'],$request['lastname'],$request['username'],$request['email'],$request['password']); 
	if($result == true){
	return array("returnCode" => '0', 'message'=>"Server received request and processed");
	//send back to client
	}else{
		return array("returnCode" => '1', 'message'=>"Server received request and processed");
	//send back to client
	}
}
$server = new rabbitMQServer("register.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
