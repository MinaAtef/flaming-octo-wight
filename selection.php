<?php
session_start();

$stdId=$_SESSION['stdId'];

$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
$result1 = mysqli_query($link, "select * from course where evaluated=0 and course_id not in(select se.course_id from std_crs_eval se join student s
on s.std_id=se.std_id
and se.std_id='$stdId')");



$options1 = "";
while ($row = mysqli_fetch_assoc($result1)) {
    $options1 .= "<option value='{$row['course_id']}' >" . $row['name'] . "</option>";

}


$result2 = mysqli_query($link, "select * from instructor");


$options2 = "";
while ($row = mysqli_fetch_assoc($result2)) {
    $options2 .= "<option value='{$row['ins_id']}' >" . $row['name'] . "</option>";
}
if (isset($_POST['ins'])) {
    $_SESSION['insID'] = $_POST['ins'];
}

if (isset($_POST['crs'])) {
    $_SESSION['crsID'] = $_POST['crs'];
}

if (isset($_POST['ins_eval'])&&isset($_POST['crs'])) {
    header("Location: instructorEval.php");
}

if (isset($_POST['crs_eval'])&&isset($_POST['ins'])) {
    header("Location: courseEval.php");
}
//echo $_POST['crs'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            subject :  <select name="crs">
                <?php echo $options1; ?>
            </select> <br><br><br>
            Instructor :  <select name="ins">
                <?php echo $options2; ?>
            </select> <br><br><br> 

            <div>Evaluation deadline is :  15/12/2013</div> <br><br><br>
            <input type="submit" value="Instructor Evaluation" name="ins_eval" >  </button> &nbsp;&nbsp;&nbsp;
            <input type="submit" value="Course Evaluation" name="crs_eval">  </button> 

        </form>


    </body>
</html>
