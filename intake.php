<?php
if(isset($_POST['Save'])){
    
    if($_POST['flag'] == 0){  //set new intake
        $name=$_POST['blanck1'];
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
     
    if(!mysqli_query($link, "INSERT INTO intake (name) VALUES ('$name')")){
			die("Insertion error: " . mysqli_error($link));
		}                
 }
}
if(isset($_POST['Delete'])){    //Delete 
     
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
    if(!mysqli_query($link, "UPDATE intake SET status='1' WHERE intake_id ='{$_POST['name']}'")){
			die("Deleting error: " . mysqli_error($link));
		} 
     
    
 } 
 if(isset($_POST['Set_As_Current'])){    //setting the intake to be the current one 
     
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
    
   if(!mysqli_query($link, "UPDATE intake SET current='0'"))
    
                 {
			die("Setting error: " . mysqli_error($link));
		} 
                    
                    
    if(!mysqli_query($link, "UPDATE intake SET current='1' WHERE intake_id ='{$_POST['name']}'"))
    
                 {
			die("Setting error: " . mysqli_error($link));
		} 
     
    
 }
?>

<html>
	<head>
		<script type="text/javascript" src="jquery-1.8.0.js"></script>
		<script type="text/javascript" src="jquery_intake.js"></script>
	</head>
<body>
<form action="intake.php" method="post">
    <b>Intake</b><br>
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
        $query = "select intake_id , name from intake where status = '0' ";
        $result = mysqli_query($link,$query);
?>

    
    Intake no : <select name="name">
        <?php       
        while($row = mysqli_fetch_assoc($result)){
		echo " <option value ='{$row['intake_id']}'>{$row['name']}</option>";
	}
        ?>
           </select> <br><br>
           
   <input type="button" value="Add" name="Add"> &nbsp;&nbsp;
   <input type="submit" value="Delete" name="Delete">&nbsp;&nbsp;
   <input type="submit" value="Set As Current" name="Set_As_Current"> <br><br>
   <div id="mod"> 
   enter Intake no  : <input type="text" name="blanck1"><br><br>
   <input type="hidden" name="flag">
   <input type="submit" value ="Save" name="Save">
   </div>