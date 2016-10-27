<?php
#	$db = new mysqli("localhost","root","test123","it490");
#if ($db->connect_errno > 0)
#	echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
#	exit(-1);


//read the json file contects.
$jsondata = file_get_contents('ea01aaf1-45dc-45d3-bc62-8d2b5e7650f9.json');


//convert json object to php associative array.
$data = json_decode($jsondata, true);

	//Extract the Array Values.
	$Course_Name=$data['Course_Name'];
	$Book_Name=$data['Course_Name']['Book_Name'];
	$Book_Price=$data['Course_Name']['Book_Name']['Book_Price'];
	$Book_ISBN=$data['Course_Name']['Book_Name']['Book_ISBN'];
	$Book_Author=$data['Course_Name']['Book_Name']['Book_Author'];


//Connect to database
   $db = new mysqli("localhost","root","test123","it490");
if ($db->connect_errno > 0)
        echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
        exit(-1);


	//Insert into mysql table
	$sql = "CREATE TABLE test(Course_Name VARCHAR(30), Book_Name VARCHAR(50), Book_Price VARCHAR(8), Book_ISBN VARCHAR(14), Book_Author VARCHAR(30))";

	if (!$result=$db->query($query_count)){
	die ('ERROR! [' .$db->Error . ']');	

	$sql = "INSERT INTO test(Course_Name, Book_Name, Book_Price, Book_ISBN, Book_Author)
	values('$Course_Name', '$Book_Name', '$Book_Price', '$Book_ISBN', '$Book_Author')";


	if(!mysql_query($sql,$db))
	{
		die('Error : ' . mysql_error());
	}
?>
