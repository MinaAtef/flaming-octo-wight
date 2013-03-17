<?php
	session_start();
	
	$link = @mysqli_connect(
		'localhost',
		'root',
		'',
		'evaluation'
	);
	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	$query = "select name 
				from student 
				where std_id not in ( select s.std_id
				from std_crs_eval s join course c join ins_course_track ic
				on s.course_id=c.course_id
				and c.course_id=ic.course_id
				and s.course_id='{$_SESSION['course']}'
				and ic.deadline<curtime() and 
				ic.track_id='{$_SESSION['track']}')
				and track_id='{$_SESSION['track']}'" ;
				
	$result = mysqli_query($link,$query);
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>Late students in course evaluation</td>";
	echo "</tr>";
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<tr>";
		echo "<td>";
		echo $row['name'];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table >";