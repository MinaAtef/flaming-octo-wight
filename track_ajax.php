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
$query = "SELECT * from course WHERE course_id in(select course_id from ins_course_track where track_id='$test')";
$result = mysqli_query($link,$query);
$option="<option value='noselection_t'>No Selection</option>";
$row = mysqli_fetch_assoc($result);
if($row['status']==0)
{
	//$option.="<option value='noselection_c'>No Selection</option>";
	$option.="<option value='{$row['course_id']}'>{$row['name']}</option>";
	while($row = mysqli_fetch_assoc($result))
	{
		$option.="<option value='{$row['course_id']}'>{$row['name']}</option>";
	}
}
echo $option;
?>