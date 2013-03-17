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
   $query = "SELECT title from instructor WHERE ins_id = '$test'";
   $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    echo $row['title'];
    // echo $test;
                    
?>
