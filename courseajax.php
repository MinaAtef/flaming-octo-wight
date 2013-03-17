<?php

$link = @mysqli_connect(
		'localhost',
		'root', 
		'', 
		'evaluation'
	);
   if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}
   $test=$_POST['name'];   
   $query = "SELECT code from course WHERE course_id = '$test'";
   $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    echo $row['code'];

?>
