#!/usr/bin/php
<?php
//needs to run in order to register
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include('session.php');
function doBookSearch($title,$author,$isbn13,$publisher,$course,$id)
{

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
		$course = $db->real_escape_string($course);
		$loggedin_id = $db->real_escape_string($id);	
	
		$word_list = array("$title", "$author", "$isbn13", "$publisher");	 
 		if($loggedin_id != 0){

			foreach ($word_list as $value){
				if($value != ""){
					 $search_save = "insert into search_table (id, search, date) values('$loggedin_id','$value', NOW())";
                if (!$result = $db->query($search_save)){
                        die ('There was an error running the query [' . $db->error . ']');
			}	
				}
		}

		}
		$query = "select * from BookInfo";
		$conditions = array();

		if($title !=""){
        		$conditions[] = "`Title` LIKE '%".$title."%'";
		}
		if($author != ""){
        		$conditions[] = "`Authors` LIKE '%".$author."%'";
		}
		if($isbn13 != ""){
        		$conditions[] = "`ISBN13` LIKE '%".$isbn13."%'";
		}
		if($publisher !=""){
        		$conditions[] = "`Publisher` LIKE '%".$publisher."%'";
		}
		if($course != ""){
       			 $conditions[] = "`course` LIKE '%".$course."%'";
		}

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
	
                $result_array[] = "<p><h3>".$row['Title']."</h3>Author: ".$row['Authors']."<br>Edition: ".$row['Edition']."<br>Year: ".$row['Year']."<br>ISBN-13: ".$row['ISBN13']."<br>Publisher: ".$row['Publisher']."<br></p>";
                //echo"<p>NJIT Bookstore Buy Price: $".$row['buy_book']."<br>NJIT Bookstore Rent Price: $".$row['rent_book']."</p>";
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
	$result = doBookSearch($request['title'],$request['author'],$request['isbn13'],$request['publisher'],$request['course'],$request['id']); 
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