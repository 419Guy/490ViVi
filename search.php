
<?php

$db = new mysqli("localhost","root","khLux2016","project");

if ($db->connect_errno > 0 )
{
        echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
        exit(-1);
}


$title = $_POST['title'];
$author = $_POST['author'];
$isbn13 = $_POST['isbn13'];
$publisher = $_POST['publisher'];
$course = $_POST['course'];

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

             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
	$count = $result->num_rows;
        if($count > 0){ // if one or more rows are returned do following
             
            while($row = $result->fetch_assoc()){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$row['Title']."</h3>Author: ".$row['Authors'];
		echo"<br>Edition: ".$row['Edition']."<br>Year: ".$row['Year']."<br>ISBN-13: ".$row['ISBN13']."<br>Publisher: ".$row['Publisher']."<br></p>";
		//echo"<p>NJIT Bookstore Buy Price: $".$row['buy_book']."<br>NJIT Bookstore Rent Price: $".$row['rent_book']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
        
?>


	
