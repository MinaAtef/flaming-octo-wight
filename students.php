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
    $result=mysqli_query($link,"select intake_id from intake where name = (select max(name) from intake)");
    $row=  mysqli_fetch_assoc($result);
    
    if(!mysqli_query($link, "INSERT INTO student (name,track_id,intake_id) VALUES ('$name','{$_POST['track']}','{$row['intake_id']}')")){
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
   
                    
     /*$query = "select track_id , name from track where status = '0' ";
     $result = mysqli_query($link,$query);
     $row = mysqli_fetch_assoc($result); */              
     if(!mysqli_query($link, "UPDATE student SET name = '$name' where track_id = '{$_POST['track']}' and std_id='{$_POST['name']}'")){
			die("Editing error: " . mysqli_error($link));
		}
     
     
     
     }
}   
 

if(isset($_POST['delete'])){    
     
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
    if(!mysqli_query($link, "UPDATE student SET status='1' WHERE std_id ='{$_POST['name']}' and track_id='{$_POST['track']}'")){
			die("Deleting error: " . mysqli_error($link));
		} 
     
    
 } 

 if(isset($_POST['transfer'])){    
     
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
    if(!mysqli_query($link, "UPDATE student SET track_id='{$_POST['ntrack']}' WHERE std_id ='{$_POST['studentname']}'")){
			die("Transfering error: " . mysqli_error($link));
		} 
     
    
 }
 ?>
<html>
   
    <html>
	<head>
        <script type="text/javascript" src="jquery-1.8.0.js"></script>
        <script type="text/javascript" src="jquery_students.js"></script>

        <script>
			$(function(){
				$("#track").on("change",function(){					
                                        $.ajax({
						url: "studentsajax.php",
						type: "POST",
						data: {
							name: $('#track').attr("value")
						},
						success: function(resp){
                                                    $("#name").html(resp);
						}
					});
				});
			});
        </script>
        <script>
			$(function(){
				$("#track2").on("change",function(){					
                                        $.ajax({
						url: "transferajax.php",
						type: "POST",
						data: {
							x: $('#track2').attr("value")
						},
						success: function(resp){
                                                    $("#name2").html(resp);
						}
					});
				});
			});
        </script>
        
        
        </head>
    
    
    
    <body>

        <form action="students.php" method="post">
            
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
            
            
            <h2> Student </h2>
            Track : <select name="track" id="track">
                        <?php       
                          while($row = mysqli_fetch_assoc($result)){
                                  echo " <option value ='{$row['track_id']}'>{$row['name']}</option>";
                              }
                        ?>
                    </select><br><br> 
            
            Student Name : <select name="name" id="name">
                             <?php       
                             $query = "select track_id , name from track where status = '0' ";
                             $result = mysqli_query($link,$query);
                             $row = mysqli_fetch_assoc($result);
                             $query2 = "select std_id , name from student where track_id = '{$row['track_id']}' and status= '0'";   
                             $result2 = mysqli_query($link,$query2);
                             while($row2 = mysqli_fetch_assoc($result2)){
                                        echo " <option value ='{$row2['std_id']}'>{$row2['name']}</option>";
                                    }
                              ?>
                          </select><br><br>
            
            <input type="button" name="add" value="Add">
            <input type="button" name="add" value="Edit">
            <input type="submit" name="delete" value="Delete"><br><br>
            
            <div id="mod"> 
            enter student name : <input type="text" name="blanck1"><br><br>
            <input type="hidden" name="flag">
            <input type="submit" value ="Save" name="Save">
            </div>
            
        </form>
        <form action="students.php" method="post">
            
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
            
                    $query3 = "select track_id , name from track where status = '0' ";
                    $result3 = mysqli_query($link,$query3);
                    
           ?>
            
            
            
            <h2> Transfer Student </h2>
            Track : <select name="track2" id="track2">
                        <?php       
                          while($row3 = mysqli_fetch_assoc($result3)){
                                  echo " <option value ='{$row3['track_id']}'>{$row3['name']}</option>";
                              }
                        ?>
                    </select><br><br>
           
            Student : <select name="studentname" id="name2">
                            <?php       
                             $query4 = "select track_id , name from track where status = '0' ";
                             $result4 = mysqli_query($link,$query4);
                             $row4 = mysqli_fetch_assoc($result4);
                             $query5 = "select std_id , name from student where track_id = '{$row4['track_id']}' and status= '0'";   
                             $result5 = mysqli_query($link,$query5);
                             while($row5 = mysqli_fetch_assoc($result5)){
                                        echo " <option value ='{$row5['std_id']}'>{$row5['name']}</option>";
                                    }
                              ?>
                      </select><br><br>
           
            New Track : <select name="ntrack" id="ntrack">
                          <?php       
                         $query = "select track_id , name from track where status = '0' ";
                         $result = mysqli_query($link,$query); 
                          while($row = mysqli_fetch_assoc($result)){
                                  echo " <option value ='{$row['track_id']}'>{$row['name']}</option>";
                              }
                          ?>  
                        </select><br><br> 
            
            <input type="submit" name="transfer" value="Transfer">
        </form>
        
    </body>
</html>
