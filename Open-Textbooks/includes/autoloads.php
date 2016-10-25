<?php

//error_reporting(0); //report all errors during development..

$root = $_SERVER['DOCUMENT_ROOT'];

//config..
//require_once($root . '/../includes/db_config.php');
//require_once($root . '/../includes/proxy_config.php');

//includes..
//require_once($root . '/../includes/book_functions.php');
//require_once($root . '/../includes/bookstore_functions.php');
//require_once($root . '/../includes/db_functions.php');
//require_once($root . '/../includes/math_functions.php');
//require_once($root . '/../includes/parsing_functions.php');
//require_once($root . '/../includes/url_functions.php');
//require_once($root . '/../includes/validation_functions.php');

//As you can see we took root and replaced it with DIR

require_once(__DIR__.'/../includes/db_config.php');
require_once(__DIR__.'/../includes/proxy_config.php');

//includes..
require_once(__DIR__.'/../includes/book_functions.php');
require_once(__DIR__. '/../includes/bookstore_functions.php');
require_once(__DIR__.'/../includes/db_functions.php');
require_once(__DIR__.'/../includes/math_functions.php');
require_once(__DIR__. '/../includes/parsing_functions.php');
require_once(__DIR__.'/../includes/url_functions.php');
require_once(__DIR__.'/../includes/validation_functions.php');


?>
