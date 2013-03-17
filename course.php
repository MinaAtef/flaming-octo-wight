<?php
if(isset($_POST['Save'])){
    
    if($_POST['flag'] == 0){  //add
        $name=$_POST['blanck1'];
        $code=$_POST['blanck2'];
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

    if(!mysqli_query($link, "INSERT INTO course (name,code) VALUES ('$name','$code')")){
                  die("Insertion error: " . mysqli_error($link));
          }          
     }

   if($_POST['flag'] == 1){  //Edit
     
     $name=$_POST['blanck1'];
     $code=$_POST['blanck2'];
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
    if(!mysqli_query($link, "UPDATE course SET name = '$name' , code = '$code' where course_id = '{$_POST['name']}'")){
			die("Editing error: " . mysqli_error($link));
		}
     
     
     
     }          
}
if(isset($_POST['Delete'])){    
     
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
    if(!mysqli_query($link, "UPDATE course SET status='1' WHERE course_id ='{$_POST['name']}'")){
			die("Deleting error: " . mysqli_error($link));
		} 
     
    
 }
 
?>



<html>
	<head>
		<script type="text/javascript" src="jquery-1.8.0.js"></script>
		<script type="text/javascript" src="jquer_course.js"></script>
	</head>
   <body>
<form action="course.php" method="post">
    <b>Course</b><br><br> 
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
   $query = "select course_id , name from course where status = '0' ";
   $result = mysqli_query($link,$query);
  ?>
    
    
    Name: <select name="name">
        <?php       
        while($row = mysqli_fetch_assoc($result)){
		echo " <option value ='{$row['course_id']}'>{$row['name']}</option>";
	}
        ?>
           </select> <br><br>
    Code: <input type="text" name="Code"><br><br> 
 <input type="button" value="Add" name="Add"> &nbsp;&nbsp;
 <input type="button" value="Edit" name="Edit"> &nbsp;&nbsp;
 <input type="submit" value="Delete" name="Delete"><br><br>
 <div id="mod"> 
 enter name : <input type="text" name="blanck1"><br><br>
 enter code : <input type="text" name="blanck2"><br><br>
 <input type="hidden" name="flag">
 <input type="submit" value ="Save" name="Save">
 </div>


</form>
