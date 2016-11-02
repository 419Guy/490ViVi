<?php

	$db = new mysqli("localhost", "root", "khLux2016", "project");
	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$username=$_POST ['username'];
	$username = $db->real_escape_string($username);
	echo "$username<br>";
	$password=$_POST ['password'];
	$password = $db->real_escape_string($password);
	$sql="select * from register where username = '$username' AND password = sha2('$password',256)";
	if(!$result = $db->query($sql)){
		die ('There was an error running the query [' . $db->error . ']');
}
	$count = $result->num_rows;
	
	if ($count == 0){
	echo"Sorry, wrong password.  Please try again.";
	}else { 
		$query = "update register set login_time = NOW() where username = '$username' AND password = sha2('$password', 256)";
		if(!$result2 = $db->query($query)){
               	 die ('There was an error running the query [' . $db->error . ']');
	}
	session_start();
        $_SESSION['login'] = "1";
        header ("Location:postlogin.php");

	echo "Thank you for logging in $username.";
	}

	$db->close();
?>

