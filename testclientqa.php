#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testBundleDeploy.ini","testServer");
if($argv[1] == "request"){
	$msg = $argv[1];
	$bundle = $argv[2];
	
}elseif($argv[1] == "update"){
	$msg = $argv[1];
	$bundle = $argv[2];
	shell_exec("scp $bundle dancho@192.168.43.142:~/bundles");

}else
{
  $msg = "no version";
}

$request = array();
//$request['type'] = "Login";
$request['message'] = $msg;
$request['bundle'] = $bundle;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

if($response['returnCode'] == 0) {
	$mew=shell_exec("~/git/rabbitmqphp_example/frontend_1.3.sh");
#	$mew=shell_exec("sh ~/Desktop/BROKENIT490_1.1-1.sh");
	print_r($mew);
}
	else{
	echo "cannot run script";
}
echo $argv[0]." END".PHP_EOL;
#if($response == 0){
#   shell_exec ('sudo php installer.php');
#}else{
#echo "cannot run script";  
#}

