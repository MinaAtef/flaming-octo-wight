<?php
session_start();
$trkId = $_SESSION['trkId'];
echo $trkId;
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
   $query = "SELECT i.* from instructor i join course c join ins_course_track ic 
                                             on i.ins_id=ic.ins_id and c.course_id=ic.course_id and c.course_id = '$test' and ic.track_id='$trkId'";
   $result = mysqli_query($link,$query);
    $options2='';
    while ($row = mysqli_fetch_assoc($result)) {
    $options2 .= "<option value='{$row['ins_id']}' >" . $row['name'] . "</option>";
     }
   
    echo $options2; 

?>
