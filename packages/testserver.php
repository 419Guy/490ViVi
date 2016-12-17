#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//require_once('db.php');
function deployBundle($bundle)
{
	$bundle_name = preg_split('/[_]/', $bundle);
        $bundle_version = preg_split('/(\.[^.]*)$/', $bundle_name[1],-1, PREG_SPLIT_NO_EMPTY);
	$bundle_num = preg_split('/(\.[^.]*)$/', $bundle_version[0],-1, PREG_SPLIT_NO_EMPTY);
//	echo "$bundle_name[0]\n";
//	echo "$bundle_num[0]\n";

	$db = new mysqli("localhost", "root", "khLux2016", "bundle");

        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


	$query = "select * from bundles where Name = '$bundle_name[0]' and Version= '$bundle_num[0]'";
	 if (!$result = $db->query($query)){
        echo 'There was an error running the query [' . $db->error . ']';
	return false;
}
	$count = $result->num_rows;
	
	if($count != 0){
		echo "Bundle exists\n";
//	shell_exec("scp ~/bundles/$bundle jdb49@192.168.43.149:~/Desktop");
 	shell_exec("scp ~/bundles/$bundle ak652@192.168.43.165:~/Desktop");
		//shell_exec("scp ~/Desktop/$bundle nkh6@192.168.43.22:~/Desktop");
    	return true;
    //return false if not valid
}else{
	echo "Bundle doesn't exist\n";
	return false;
}
}

function updateBundle($bundle)
{
	
	$bundle_name = preg_split('/[_]/', $bundle);
	$bundle_version = preg_split('/(\.[^.]*)$/', $bundle_name[1],-1, PREG_SPLIT_NO_EMPTY);

	$bundle_num = preg_split('/(\.[^.]*)$/', $bundle_version[0],-1, PREG_SPLIT_NO_EMPTY);

//	echo "$bundle_name[0]\n";
//        echo "$bundle_num[0]\n";
	
	  $db = new mysqli("localhost", "root", "khLux2016", "bundle");

        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

	$query = "insert into bundles (Name,Version,Time_Received) values ('$bundle_name[0]', '$bundle_num[0]', NOW())";
	 if (!$result = $db->query($query)){
       	echo 'There was an error running the query [' . $db->error . ']';
	return false;
}
	 $query_out = "select * from bundles";
                if (!$result = $db->query($query_out)){
                die ('There was an error running the query [' . $db->error . ']');
}
		echo "Current Bundles: \n";
                while ($row = $result->fetch_assoc())
                {
                //loop will print in server what bundles are in the database
		echo "Bundle name: ".$row['Name']."\n";
		echo "Bundle version: ". $row['Version']."\n";
		echo "Version time: ". $row['Time_Received']."\n";
		echo "\n";
                }

	return true;
}

function requestProcessor($request)
{
  echo "\nreceived request for new version".PHP_EOL;
  var_dump($request);
	
  if(($request['message'] == "request"))
  {
	echo "Time requested: ". date("Y/m/d-h:i:sa")."\n";
	$result = deployBundle($request['bundle']);
	//echo "\nResult:$result\n";
	if($result == 1){
		 return array("returnCode" => '0', 'message'=>"Server deployed bundle");

	}else{
		 return array("returnCode" => '1', 'message'=>"Don't have this bundle");
        //send back to client
        }

}elseif(($request['message'] == "update")){
	echo "Time updated: ". date("Y/m/d-h:i:sa")."\n";
	$result = updateBundle($request['bundle']);
	if($result == true){
        return array("returnCode" => '0', 'message'=>"New version of bundle received");
        //send back to client
        }else{
                return array("returnCode" => '1', 'message'=>"Already have this version of bundle");
        //send back to client
        }

	}
}

$server = new rabbitMQServer("bundleDeploy.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

