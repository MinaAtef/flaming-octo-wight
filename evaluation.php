<?php
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

$options1 = "";
$result1 = mysqli_query($link, "select * from track where status ='0'");
while ($row = mysqli_fetch_array($result1)) {

    $options1 .= "<option value='{$row['track_id']}' >" . $row['name'] . "</option>";
}


$options2 = "";
$result2 = mysqli_query($link, "select * from course where status ='0' and evaluated='0'");
while ($row = mysqli_fetch_array($result2)) {

    $options2 .= "<option value='{$row['course_id']}' >" . $row['name'] . "</option>";
}


$options3 = "";
$result3 = mysqli_query($link, "select * from instructor where status ='0' and evaluated='0'");
while ($row = mysqli_fetch_array($result3)) {

    $options3 .= "<option value='{$row['ins_id']}' >" . $row['name'] . "</option>";
}


if(isset($_POST['activate']))
    {
    $trk=$_POST['track'];
    $crs=$_POST['course'];
    $ins=$_POST['instructor'];
    $date=$_POST['duedate'];
    
    //echo $trk;
    //echo $crs;
    //echo $ins;
    //echo $date;
    //mysqli_query($link, "insert into track_course_ values('$trk','$crs')");
    mysqli_query($link, "insert into ins_course_track values('$ins','$crs','$trk',STR_TO_DATE('$date','%m/%d/%Y'))");
    }


?>

<html>
    <head>
          <meta charset="utf-8" />
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

        
    </head>
    <body>

        <form action="" method="post">
            <h2> Evaluations: </h2>
            Track : <select name="track">

                <?php echo $options1; ?>
            </select> 
            <br><br>
            Course : <select name="course">
                <?php echo $options2; ?>
            </select> 
            <br><br>
            Instructor : <select name="instructor">
                <?php echo $options3; ?>
            </select> 
            <br><br>
            Due date : <input type="text" id="datepicker" name="duedate"/>
            <br><br>
            <input type="submit" name="activate" value="Activate">
        </form>

        
        
    </body>
</html>
