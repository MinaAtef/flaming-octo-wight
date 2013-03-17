<?php
if(isset($_POST['Save'])){
    
    if($_POST['flag'] == 0){  //add
        $name=$_POST['blanck1'];
        $title=$_POST['blanck2'];
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
     
    if(!mysqli_query($link, "INSERT INTO instructor (name,title) VALUES ('$name','$title')")){
			die("Insertion error: " . mysqli_error($link));
		}                
 }
  
 
 if($_POST['flag'] == 1){  //Edit
     
     $name=$_POST['blanck1'];
     $title=$_POST['blanck2'];
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
    if(!mysqli_query($link, "UPDATE instructor SET name = '$name' , title = '$title' where ins_id = '{$_POST['name']}'")){
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
    if(!mysqli_query($link, "UPDATE instructor SET status='1' WHERE ins_id ='{$_POST['name']}'")){
			die("Deleting error: " . mysqli_error($link));
		} 
     
    
 } 

 ?>







<html>
	<head>
                <script type="text/javascript" src="jquery-1.8.0.js"></script>
		<script type="text/javascript" src="jquer_inst.js"></script>
		<script>
			$(function(){
				$("#name").on("change",function(){					
                                        $.ajax({
						url: "instajax.php",
						type: "POST",
						data: {
							name: $('#name').attr("value")
						},
						success: function(resp){
                                                    $("#title").attr('value',resp);
						}
					});
				});
			});
		</script>
            
            
            
            
            
            
            
                
	</head>
<body>
<form action="inst.php" method="post">
    <b>Instructor</b><br>
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
   $query = "select ins_id , name from instructor where status = '0' ";
   $result = mysqli_query($link,$query);
?>
Name: <select  name ="name" id="name">
        <?php       
        while($row = mysqli_fetch_assoc($result)){
		echo " <option value ='{$row['ins_id']}'>{$row['name']}</option>";
	}
        ?>
           </select> <br><br>
 Title: <input type="text" name="Title" id="title" value="<?php $query = "select * from instructor where status = '0'";$result = mysqli_query($link,$query);$row = mysqli_fetch_assoc($result);echo "{$row['title']}";?>"><br><br>           

 <input type="button" value="Add" name="Add"> &nbsp;&nbsp;
 <input type="button" value="Edit" name="Edit"> &nbsp;&nbsp;
 <input type="submit" value="Delete" name="Delete"><br><br>
 <div id="mod"> 
 enter name : <input type="text" name="blanck1"><br><br>
 enter title : <input type="text" name="blanck2"><br><br>
 <input type="hidden" name="flag">
 <input type="submit" value ="Save" name="Save">
 </div>
</form>
    
    
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
