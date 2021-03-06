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

//obtain ALL of the amazon urls from the specified isbns
foreach($isbns as $isbn){
  $URL =
"https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=".$isbn;
  $homepage = file_get_contents($URL);
  $pattern = '/\bs-access-detail-page[^>]*>/';
  preg_match($pattern, $homepage, $matches, PREG_OFFSET_CAPTURE, 3);
  $second = $matches[0][0];
  $pattern = '/\bhref="[^"]*"/';
  preg_match($pattern, $second, $matches, PREG_OFFSET_CAPTURE, 3);
  $third = $matches[0][0];
  $third = substr($third, 6, count($third)-2);
  array_push($URLS, $third);
}

print_r(json_encode($URLS));

?>

