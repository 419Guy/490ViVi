<?php
$mysql_hostname  =  "192.168.43.142"; // host name
$mysql_user  =  "ak652"; // username
$mysql_password  =  "1234"; // password
$mysql_database  =  "project"; //database name
$db  =  mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);
if($db){
}else{
	echo mysqli_error($db);
}
?>
