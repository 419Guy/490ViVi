<?php
#Goes through and tests whether all Campuses are returning Terms
require_once('../includes/autoloads.php');
$problem_ids = array();
//Get the campuses...
$conn = connect();
$all_campuses_query = 'SELECT Campus_ID FROM Campuses';
$result = mysqli_query($conn,$all_campuses_query);
while ($row = mysqli_fetch_assoc($result))
{
    //Query the campus
    $query = next_dropdowns_query(array('campus' => $row['Campus_ID']));
   
    $campus_result = mysqli_query($conn,$query);
    if (mysqli_num_rows($campus_result) == 0)
    {
        $problem_ids[] = $row['Campus_ID'];
    }
    else
    {
        $campus_row = mysqli_fetch_assoc($campus_result);
	print_r($campus_row);
        if (!$campus_row['Term_ID'])
        {
		
            update_classes_from_bookstore($campus_row);
            $campus_result = mysqli_query($conn, $query);
            if (mysqli_num_rows($campus_result) == 0)
            {
                $problem_ids[] = $row['Campus_ID'];
            }
            else
            {
                $campus_row = mysqli_fetch_assoc($campus_result);
                if (!$campus_row['Term_ID'])
                {
                    $problem_ids[] = $row['Campus_ID'];
                }
            }
        }
    }
}
echo implode(',', $problem_ids);
?>
