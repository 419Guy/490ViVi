<?php
//no longer needed
#echo "Hello there. This is a test";
#exec('sh test.sh');
	$message=shell_exec("cat /var/www/demo/testRabbitMQServer.php");
	print_r($message);
?>
