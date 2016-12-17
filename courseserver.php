#!/usr/bin/php
<?php
//needs to run in order to register
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include('session.php');
function doCourseSearch($course)
{

	$db = new mysqli("localhost","root","khLux2016","project");
	if ($db->connect_errno > 0 )
	{
        	echo __FILE__.__Line__." ERROR: ".$db1->connect_error.PHP_EOL;
       		 exit(-1);
	}

		$course = $db->real_escape_string($course);
	//	$loggedin_id = $db->real_escape_string($id);	

 	//	if($loggedin_id != 0){

//			foreach ($word_list as $value){
//				if($value != ""){
//					 $search_save = "insert into search_table (id, search, date) values('$loggedin_id','$value', NOW())";
  //              if (!$result = $db->query($search_save)){
    //                    die ('There was an error running the query [' . $db->error . ']');
//			}	
//				}
//		}

//		}
		$query =  "select * from Course where `Course_name` like '%".$course."%'";
        	if (!$result = $db->query($query)){
        		die ('There was an error running the query [' . $db->error . ']');
		}
		
		
		  $count = $result->num_rows;
		echo "$count\n";
        if($count > 0){ // if one or more rows are returned do following
	
		$result_array = array();	
            while($row = $result->fetch_assoc()){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
	
                $result_array[] = "<td class=\"text-center\">".$row['Course_name']."</td>"."<td class=\"text-center\">".$row['Section_num']."</td>"."<td class=\"text-center\">".$row['Call_num']."</td>"."<td class=\"text-center\">".$row['Professor']."</td>"."<td class=\"text-center\">".$row['Time']."</td>"."<td class=\"text-center\">".$row['Room']."</td>"."<td class=\"text-center\">"."<a href=\"".$row['Book_Info']."\">Book Link</a>"."</td>";
		
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
		print_r($result_array);
        }
        else{ // if there is no matching rows do following
            echo "No results";
	return false;
        }
	
	return $result_array;

	
}
function requestProcessor($request)
{

  echo "received request".PHP_EOL;
  var_dump($request);
	$result = doCourseSearch($request['course']);
	if($result == false){
	return array("returnCode" => '1','message'=>"Service processed");
	//send back to client
	}else{
		return $result;
	//array("returnCode" => '0', 'message'=>"Server received request and processed");
	//send back to client
	}
}
$server = new rabbitMQServer("coursesearch.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
