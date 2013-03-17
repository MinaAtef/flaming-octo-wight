
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

	if(isset($_POST['edit']))
    {
	//update  ins_course_track set deadline = STR_TO_DATE("12/12/2012",'%m/%d/%Y') where ins_id=1 and course_id=1 and track_id=1;
	$query_c = "update  ins_course_track set deadline = STR_TO_DATE('{$_POST['duedate']}','%m/%d/%Y') where ins_id='{$_POST['instructor']}' and course_id='{$_POST['course']}' and track_id='{$_POST['track']}'";
		mysqli_query($link,$query_c);
	}
	if(isset($_POST['delete']))
    {
		$query_c = "UPDATE course_eval set deleted='1' where c_eval_id in (select c_eval_id from std_crs_eval where course_id in (select course_id from course where course_id =".$_POST['course']."))" ;
		mysqli_query($link,$query_c);
		$query_c = "UPDATE course set status='1' where course_id =".$_POST['course'] ;
		mysqli_query($link,$query_c);
		$query_c = "UPDATE instructor_eval set deleted='1' where i_eval_id in (select i_eval_id from std_ins_eval where ins_id in (select ins_id from instructor where ins_id =".$_POST['instructor']."))" ;
		mysqli_query($link,$query_c);
		$query_c = "UPDATE instructor set deleted='1' where ins_id =".$_POST['instructor'] ;
		mysqli_query($link,$query_c);
	}
	if(isset($_POST['deactivate_eval']))
    {
		$query_c = "UPDATE course set evaluated='1' where course_id =".$_POST['course'] ;
		mysqli_query($link,$query_c);
		$query_c = "UPDATE instructor set evaluated='1' where ins_id =".$_POST['instructor'] ;
		mysqli_query($link,$query_c);
	}
	$query_intake = "select * from intake ";
	$result_intake = mysqli_query($link,$query_intake);
	
	$query_course = "select * from course ";
	$result_course = mysqli_query($link,$query_course);
	
	$query_track = "select * from track ";
	$result_track = mysqli_query($link,$query_track);
	
	$query_inst = "select * from instructor ";
	$result_inst = mysqli_query($link,$query_inst);
	if(isset($_POST['course_eval']))
    {
		$_SESSION['course']=$_POST['course'];
		header("Location: table_course.php");
    }
	if(isset($_POST['inst_eval']))
    {
		$_SESSION['ins']=$_POST['instructor'];
		header("Location: table_inst.php");
    }
	if(isset($_POST['late']))
    {
		$_SESSION['track']=$_POST['track'];
		$_SESSION['course']=$_POST['course'];
		header("Location: late.php");
    }
    
?>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script type="text/javascript" src="jquery-1.8.0.js"></script>
  <script src="1ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>


<script>
$(function(){
		$("#track").on("change",function(){
			$.ajax({
			url: "track_ajax.php",
			type: "POST",
			data: {
				name: $('#track').attr("value")
			},
			success: function(resp){
                          
			$("#course").html(resp);
			}
			});
		});
		$("#intake").on("change",function(){
			$.ajax({
			url: "intake_ajax.php",
			type: "POST",
			data: {
				name: $('#intake').attr("value")
			},
			success: function(resp){                       
			$("#track").html(resp);
			}
			});
		});
		$("#course").on("change",function(){
			$.ajax({
			url: "course_ajax.php",
			type: "POST",
			data: {
				name: $('#course').attr("value"),
                                track: $('#track').attr("value")
			},
			success: function(resp){
			$("#instructor").html(resp);
			}
			});
		});
});
</script>
</head>
<body>
<form action="" method="post">
<div> Instructor &nbsp;&nbsp; Course &nbsp;&nbsp; Track &nbsp;&nbsp; Students &nbsp;&nbsp; Evalyation &nbsp;&nbsp; Intake </div><br>
Intake : <select name="intake" id="intake">
<?php
		echo " <option value ='noselection_i'>No Selection</option>";
		while($row = mysqli_fetch_assoc($result_intake))
		{
			echo " <option value ='{$row['intake_id']}'>{$row['name']}</option>";
		}
?>
</select> <br><br><br>
Track : <select name="track" id="track">
<?php
		echo " <option value ='noselection_t'>No Selection</option>";
		/*while($row = mysqli_fetch_assoc($result_track))
		{
		if($row['status'] == 0)
			echo " <option value ='{$row['track_id']}'>{$row['name']}</option>";
		}*/
?>
</select> <br><br><br>
Course :  <select name="course" id="course">
<?php
		echo " <option value ='noselection_c'>No Selection</option>";
		/*while($row = mysqli_fetch_assoc($result_course))
		{
			
			if($row['status'] == 0)
				echo " <option value ='{$row['course_id']}'>{$row['name']}</option>";
		}*/
?>
</select> <br><br><br>
                  
Instructor : <select name="instructor" id="instructor">
<?php
		echo " <option value ='noselection_i'>No Selection</option>";
		/*while($row = mysqli_fetch_assoc($result_inst)){
		if($row['deleted'] == 0)
			echo " <option value ='{$row['ins_id']}'>{$row['name']}</option>";
		}*/
?>
</select> <br><br><br>
                  
Due date : <input type="text" id="datepicker" name="duedate"/> <br><br>
<input type="submit" name='inst_eval' value="Instructor evaluation">&nbsp;&nbsp;&nbsp;
<input type="submit" name='course_eval' value="Course evaluation">&nbsp;&nbsp;&nbsp;
<span> <input type="submit" name='deactivate_eval' value="Deactivate"><br>
<input type="submit" name='delete' value="Delete"> </span>
<input type="submit" name='edit' value="Edit">&nbsp;&nbsp;&nbsp;
<input type="submit" name='late' value="Late_students">

</form>
</body>
</html>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
