<?php

session_start();
echo $_SESSION['crsSess'];

$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}



if(isset($_POST['group1'])&&isset($_POST['group2'])&&isset($_POST['group3'])&&isset($_POST['group4'])&&isset($_POST['group5']))
    {
    $res1= $_POST['group1'];
    $res2= $_POST['group2'];
    $res3= $_POST['group3'];
    $res4= $_POST['group4'];
    $res5= $_POST['group5'];
    mysqli_query($link, "insert into instructor_eval (record1,record2,record3,record4,record5) values ('$res1','$res2','$res3','$res4','$res5')");
    }

?>


<html>
<head>
</head>
<body>
	<form action="" method="post">
		<h2><pre>                       Instructor Evaluation</pre></h2>
		    <pre>                                                            Least          Most</pre>
		<ul>
			<li>Overall instructor rating &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="group1" value="1"><input type="radio" name="group1" value="2"><input type="radio" name="group1" value="3"><input type="radio" name="group1" value="4"><input type="radio" name="group1" value="5"></li>
			<li>instructor encouraged me to search on my own&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group2" value="1"><input type="radio" name="group2" value="2"><input type="radio" name="group2" value="3"><input type="radio" name="group2" value="4"><input type="radio" name="group2" value="5"></li>
			<li>Instructor was knowledgeable enough &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group3" value="1"><input type="radio" name="group3" value="2"><input type="radio" name="group3" value="3"><input type="radio" name="group3" value="4"><input type="radio" name="group3" value="5"></li>
			<li>Class time well used &nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="group4" value="1"><input type="radio" name="group4" value="2"><input type="radio" name="group4" value="3"><input type="radio" name="group4" value="4"><input type="radio" name="group4" value="5"></li>
			<li>Instructor was able to present clearly &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group5" value="1"><input type="radio" name="group5" value="2"><input type="radio" name="group5" value="3"><input type="radio" name="group5" value="4"><input type="radio" name="group5" value="5"></li>		
		</ul> 
		
	   <div style="position:absolute;left:428px;"><input type="submit" value="submit">
	   <input type="button" value="Comments">
	</form>
</body>
</html>