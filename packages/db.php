<?php
$mysql_hostname  =  "localhost"; // host name
$mysql_user  =  "root"; // username
$mysql_password  =  "khLux2016"; // password
$mysql_database  =  "bundle"; //database name
$db = new mysqli($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);

if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


?>

