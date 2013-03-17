<?php
session_start();
$trkId = $_SESSION['trkId'];

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
   $test=$_POST['crs'];   
   $query = "SELECT * from ins_course_track where track_id='$trkId' and course_id='$test'";
   $result = mysqli_query($link,$query);
    $options2='';
    while ($row = mysqli_fetch_assoc($result)) {
    $options2 .= $row['deadline'];
     }
    $options2=" Evaluation deadline is :".$options2;
    echo $options2; 

?>
