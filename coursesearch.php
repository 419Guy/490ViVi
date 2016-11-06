<?php

$db = new mysqli("localhost","root","khLux2016","project");

if ($db->connect_errno > 0 )
{
        echo __FILE__.__Line__." ERROR: ".$db->connect_error.PHP_EOL;
        exit(-1);
}


$course = $_POST['course'];

$query = "select * from Course where `Course_name` like '%".$course."%'";

echo "This is query: $query\n";
	if (!$result = $db->query($query)){
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
             
                echo "<h3>".$row['Course_name']."</h3>";
		echo "<p><br>Section: ".$row['Section_num'];
		echo "<br>Call number: ".$row['Call_num'];
		echo "<br>Professor: ".$row['Professor'];
		echo "<br>Time: ".$row['Time'];
		echo "<br>Room: ".$row['Room']."</p>";
		echo "<br><a href=\"".$row['Book_Info']."\">Book Link</a>";
		echo "<p><br>---------------------------------------------</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
        
?>	
