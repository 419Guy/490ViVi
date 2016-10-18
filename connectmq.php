
<?php
	$username = $_POST ['username'];
	echo "$username";
	$password = $_POST ['password'];
	echo "$password";
	$message = shell_exec("php -q /var/www/demo/loginmq.php $username $password");
	//run rabbitmqclient that will send stuff to server
	//server must be online for it to work	
	
	$count = $argv[1];
	echo "$count/n";
	if ($count == 0){
		echo "Sorry, wrong password.  Please try again.";
	}else{
		session_start();
		$_SESSION['login'] = "1";
		header ("Location:postlogin.php");
	}
	

	
		
?>
