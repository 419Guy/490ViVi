#!/usr/bin/php
<?php
//needs to run in order to register
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include('session.php');
function doBookSearch($title,$author,$isbn13,$publisher)
{

	//$db1 = new mysqli("192.168.43.149","dancho","khLux2016","it490");
	$db = new mysqli("localhost","root","khLux2016","project");
	if ($db->connect_errno > 0 )
	{
        	echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
       		 exit(-1);
	}

		$title = $db->real_escape_string($title);
		$author = $db->real_escape_string($author);
		$isbn13 = $db->real_escape_string($isbn13);
		$publisher = $db->real_escape_string($publisher);
	//	$course = $db->real_escape_string($course);
	//	$loggedin_id = $db->real_escape_string($id);	
	
		$word_list = array("$title", "$author", "$isbn13", "$publisher");	 
	//create new database connection for my search table

	 //$db = new mysqli("localhost","root","khLux2016","project");

        //if ($db->connect_errno > 0 )
       // {
         //       echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
           //      exit(-1);
      //  }

 	//	if($loggedin_id != 0){

	//		foreach ($word_list as $value){
	//			if($value != ""){
	//				 $search_save = "insert into search_table (id, search, date) values('$loggedin_id','$value', NOW())";
          //      if (!$result = $db->query($search_save)){
            //            die ('There was an error running the query [' . $db->error . ']');
	//		}	
	//			}
	//	}

	//	}
		$query = "select distinct title1,author,isbn,publisher,year from textbooks";
		$conditions = array();

		if($title !=""){
        		$conditions[] = "`title1` LIKE '%".$title."%'";
		}
		if($author != ""){
        		$conditions[] = "`author` LIKE '%".$author."%'";
		}
		if($isbn13 != ""){
        		$conditions[] = "`isbn` LIKE '%".$isbn13."%'";
		}
		if($publisher !=""){
        		$conditions[] = "`publisher` LIKE '%".$publisher."%'";
		}
		//if($course != ""){
       		//	 $conditions[] = "`course` LIKE '%".$course."%'";
		//}

		$sql = $query;
		if (count($conditions) > 0){
        		$sql.= " WHERE " . implode( ' AND ', $conditions);
		}

		echo "This is query: $sql\n";

        	if (!$result = $db->query($sql)){
        		die ('There was an error running the query [' . $db->error . ']');
		}
		$result_array = array();

		  $count = $result->num_rows;
        if($count > 0){ // if one or more rows are returned do following
		
            while($row = $result->fetch_assoc()){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
	
                $result_array[] = "<td class=\"text-center\">"."<a href=\"book-info.php\" target=_\"blank\">".$row['title1']."</a></td>"."<td class=\"text-center\">".$row['author']."</td>"."<td class=\"text-center\">".$row['publisher']."</td>"."<td class=\"text-center\">".$row['isbn']."</td>"."<td class=\"text-center\">".$row['year']."</td>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
		print_r($result_array);
        }
        else{ // if there is no matching rows do following
            echo "No results\n";
	return false;
        }
	
	return $result_array;

	
}
function requestProcessor($request)
{

  echo "received request".PHP_EOL;
  var_dump($request);
	$result = doBookSearch($request['title'],$request['author'],$request['isbn13'],$request['publisher']); 
	if($result == false){
	return array("returnCode" => '1','message'=>"Service processed");
	//send back to client
	}else{
		return $result;
	//array("returnCode" => '0', 'message'=>"Server received request and processed");
	//send back to client
	}
}
$server = new rabbitMQServer("booksearch.ini","testServer");
//register.ini talks to different exchange and queue because issues happened using same testExchange

$server->process_requests('requestProcessor');
exit();
?>
