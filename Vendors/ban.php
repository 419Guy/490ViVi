<?php
/*
REMOVE THESE HEADERS 
- THEY ARE USED IF YOU TRY TO ACCESS THIS PAGE FROM:
'file://...' extension rather than 'http://...'
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$bookstore_url = file_get_contents('php://input');
$isbns = [];
$URLS = [];

//get the html from the bookstore url and parse out any lines containing isbn's
$homepage = file_get_contents($bookstore_url);
$pattern = '/\ISBN:[^"]*"/';
preg_match_all($pattern, $homepage, $matches);

//from the lines containing isbn's, parse out the isbn's
$pattern = '!\d+!';
foreach($matches[0] as $m){
  preg_match($pattern, $m, $match, PREG_OFFSET_CAPTURE, 3);
  array_push($isbns, $match[0][0]);
}

//make url's for each isbn (barnes and nobles url)
foreach($isbns as $isbn){
  $URL =
"http://www.barnesandnoble.com/w/unfinished-agenda-junius-w-williams/1115170487?ean=".$isbn;
  array_push($URLS, $URL);
}

print_r(json_encode($URLS));

?>

