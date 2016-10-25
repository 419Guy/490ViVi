<?php
//changed this from relying on db_config by putting in the connection variables

include('db_config.php');

function connect()
{
	echo "ECHO\n";
	if (!($connection = mysqli_connect('localhost', 'root','usawari1','it490textdb')) || !mysqli_select_db($connection, 'it490textdb'))
	{
               echo "not";
		return false;
	}
	else
	{
                echo "Connected";
		return $connection;
	}
}

connect();

?>
