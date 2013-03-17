<?php
	session_start();
	
	$link = @mysqli_connect(
		'localhost',
		'root',
		'',
		'evaluation'
	);
	echo "<form action='adminwin.php' method='post'>";
	if($_SESSION['course']!='noselection_c')
	{
	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	$query = "SELECT evaluated from course where course_id =".$_SESSION['course'] ;
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($result);
	/*$query="select * from course_eval where c_eval_id=".$_SESSION['c'];
	echo $query;*/
	
	$grade = array( "Overall instructor rating","instructor encouraged me to search on my own","instructor was knowledgeable enough","class time well used","instructor was able to present clearly");
	
	if($row['evaluated'])
	{
	echo "<table border='1'>";
	$total=0;
	$no=0;
	echo "<tr>";
	echo "<td>Ser</td>";
	echo "<td>Item/Grade</td>";
	echo "<td>1</td>";
	echo "<td>2</td>";
	echo "<td>3</td>";
	echo "<td>4</td>";
	echo "<td>5</td>";
	echo "<td>Percent</td>";
	echo "<td>Total</td>";
	echo "<td>No.</td>";
	echo "</tr>";
	for($j=1;$j<6;$j++)
	{
		$no=0;
		$total=0;
		echo "<tr>";
		echo "<td>".$j."</td>";
		echo "<td>".$grade[$j-1]."</td>";
		for($i=1;$i<6;$i++)
		{
			$query = "SELECT count(ce.record".$j.") co from course_eval ce join std_crs_eval s join course c on c.course_id=s.course_id and ce.c_eval_id=s.c_eval_id and record".$j."=".$i." and c.course_id=".$_SESSION['course'] ;
			$result = mysqli_query($link,$query);
			$row = mysqli_fetch_assoc($result);
			$total+=$row['co']*$i;
			$no+=$row['co'];
			echo "<td>".$row['co']."</td>";
		}
		
		echo "<td>".(($total/($no*5))*100)."%</td>";
		echo "<td>".$total."</td>";
		echo "<td>".$no."</td>";
		echo "</tr>";
	}
	echo "</table >";
	}
	}
	echo "<input type='submit' name='back' value='back'>";
	echo "</form>";
	?>