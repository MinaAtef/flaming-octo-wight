<?php
if(isset($_POST['Save'])){
    
    if($_POST['flag'] == 0){  //add
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
     
    if(!mysqli_query($link, "INSERT INTO track (name) VALUES ('$name')")){
			die("Insertion error: " . mysqli_error($link));
		}
        
   }
   
   
   if($_POST['flag'] == 1){  //Edit
     
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
    if(!mysqli_query($link, "UPDATE track SET name = '$name' where track_id = '{$_POST['name']}'")){
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
    if(!mysqli_query($link, "UPDATE track SET status='1' WHERE track_id ='{$_POST['name']}'")){
			die("Deleting error: " . mysqli_error($link));
		} 
     
    
 } 

 ?>

<html>
	<head>
		<script type="text/javascript" src="jquery-1.8.0.js"></script>
		<script type="text/javascript" src="jquery_track.js"></script>
	</head>
<body>
<form action="track.php" method="post">
    <b>Track</b><br>
    
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
        $query = "select track_id , name from track where status = '0' ";
        $result = mysqli_query($link,$query);
    ?>
Name: <select name="name">
        <?php       
        while($row = mysqli_fetch_assoc($result)){
		echo " <option value ='{$row['track_id']}'>{$row['name']}</option>";
	}
        ?>
           </select> <br><br>
           
 <input type="button" value="Add" name="Add"> &nbsp;&nbsp;
 <input type="button" value="Edit" name="Edit"> &nbsp;&nbsp;
 <input type="submit" value="Delete" name="Delete"><br><br>
 <div id="mod"> 
 enter name : <input type="text" name="blanck1"><br><br>
 <input type="hidden" name="flag">
 <input type="submit" value ="Save" name="Save">
 </div>
 
</form>