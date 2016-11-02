<?php 
$db = new mysqli("dancho","root","khLux2016","project");

if ($db->connect_errno > 0 )
{
	echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
	exit(-1);
}

echo "We are connected to the DATABASE.  Welcome to the NJIT TEXTBOOK Comparison site which is still in progress.  Thank you for your kind service.<br>".PHP_EOL;

$first = ($_POST['firstname']);
$first = $db->real_escape_string($first);
echo "$first<br>";
$last = ($_POST['lastname']);
$last = $db->real_escape_string($last);
echo "$last<br>";
$username= ($_POST['username']);
$username = $db->real_escape_string($username);
echo "$username<br>";
$email = ($_POST['email']);
$email = $db->real_escape_string($email);
echo "$email<br>";
$password = ($_POST['password']);
$passoword = $db->real_escape_string($password);

$query_count = "select * from register where username = '$username' AND password = sha2('$password',256)";

if (!$result = $db->query($query_count)){
	die ('There was an error running the query [' . $db->error . ']');
}

$count = $result->num_rows;
echo "Table has $count rows<br>"; 

if($count != 0)
	die ("User is already registered");
else{
	$query = "insert into register (firstname, lastname, username, email, password, registration_time, login_time)  values('$first', '$last', '$username', '$email', sha2('$password',256), NOW(), NOW())";
	if (!$result2 = $db->query($query)){
        die ('There was an error running the query [' . $db->error . ']');
}
	session_start();
        $_SESSION['login'] = "1";
        header ("Location:postlogin.php");

        echo "Thank you for logging in $username.";

	echo("Congratulations!  You have made an account.");
}

	$db->close(); 	
?>
