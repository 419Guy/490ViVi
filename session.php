<?php
include('db.php');
session_start();
$user_check=$_SESSION['username'];
$ses_sql= "select id,username from register where username='$user_check'";
if(!$result = mysqli_query($db,$ses_sql)){
                die ('There was an error running the query [' . mysqli_error($db) . ']');
}
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$loggedin_session=$row['username'];
$loggedin_id=$row['id'];
if(!isset($loggedin_session)  ||  $loggedin_session==NULL)
{
	echo  "Go  back";
	header("Location: index.html");
}
?>
