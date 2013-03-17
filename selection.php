<?php
session_start();

$stdId = $_SESSION['stdId'];
$trkId = $_SESSION['trkId'];
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
$result1 = mysqli_query($link, "select c.* from course c join ins_course_track ic on c.course_id=ic.course_id and ic.track_id='$trkId' and c.evaluated=0 and c.course_id not in(select se.course_id from std_crs_eval se join student s
on s.std_id=se.std_id
and se.std_id='$stdId')");


$options1 = "";
while ($row = mysqli_fetch_assoc($result1)) {
    $options1 .= "<option value='{$row['course_id']}' >" . $row['name'] . "</option>";
}

$options2 = "";

if (isset($_POST['ins'])) {
    $_SESSION['insID'] = $_POST['ins'];
}

if (isset($_POST['crs'])) {
    $_SESSION['crsID'] = $_POST['crs'];
}

if (isset($_POST['ins_eval']) && isset($_POST['crs'])) {
    if ($_POST['crs'] != 'noselection_c')
        header("Location: instructorEval.php");
}

if (isset($_POST['crs_eval']) && isset($_POST['ins'])) {
    header("Location: courseEval.php");
}
//echo $_POST['crs'];
?>


<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="jquery-1.8.0.js"></script>

        <script>
            $(function(){
                $("#crs").on("change",function(){					
                    $.ajax({
                        url: "selectajax.php",
                        type: "POST",
                        data: {
                            crs: $('#crs').attr("value")
                        },
                        success: function(resp){
                            $("#ins").html(resp);
                            // alert($("#ins").html(resp);)
                        }
                    });
                });
                $("#crs").on("change",function(){					
                    $.ajax({
                        url: "selectajax_d.php",
                        type: "POST",
                        data: {
                            crs: $('#crs').attr("value")
                        },
                        success: function(resp){
                            $("#eval_d").html(resp);
                            // alert($("#ins").html(resp);)
                        }
                    });
                });
            });
        </script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            subject :  <select name="crs" id="crs">
                <option value="noselection_c">No Selection</option>
                <?php echo $options1; ?>
            </select> <br><br><br>
            Instructor :  <select name="ins" id="ins">

            </select> <br><br><br> 

            <div id="eval_d">Evaluation deadline is : </div> <br><br><br>
            <input type="submit" value="Instructor Evaluation" name="ins_eval" >  </button> &nbsp;&nbsp;&nbsp;
            <input type="submit" value="Course Evaluation" name="crs_eval">  </button> 

        </form>


    </body>
</html>
