<?php
session_start();
$stdId = $_SESSION['stdId'];
$crsID = $_SESSION['crsID'];
if (isset($_SESSION['comment1'])) {
    $comment = $_SESSION['comment1'];
}
$flag = 0;
if (isset($_SESSION['flag1'])) {
    $flag = $_SESSION['flag1'];
}
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}



if (isset($_POST['group1']) && isset($_POST['group2']) && isset($_POST['group3']) && isset($_POST['group4']) && isset($_POST['group5'])) {
    $res1 = $_POST['group1'];
    $res2 = $_POST['group2'];
    $res3 = $_POST['group3'];
    $res4 = $_POST['group4'];
    $res5 = $_POST['group5'];
    mysqli_query($link, "insert into course_eval (record1,record2,record3,record4,record5,comment) values ('$res1','$res2','$res3','$res4','$res5','$comment')");
    unset($_SESSION['flag1']);
    unset($_SESSION['comment1']);
}

if (isset($_POST['submit'])) {
    $result = mysqli_query($link, "select max(c_eval_id) from course_eval  ");
    $row = mysqli_fetch_assoc($result);
    $eval_id = $row['max(c_eval_id)'];

    mysqli_query($link, "insert into std_crs_eval values('$stdId','$crsID','$eval_id')  ");
    header("Location: selection.php");
}

if (isset($_POST['comments'])) {
    header("Location: courseComment.php");
}
?>


<html>
    <head>
    </head>
    <body>
        <form action="" method="post">
            <h2><pre>                       Course Evaluation</pre></h2>
            <pre>                                                            Least          Most</pre>
            <ul>
                <li>Overall course rating &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="group1" value="1"><input type="radio" name="group1" value="2"><input type="radio" name="group1" value="3"><input type="radio" name="group1" value="4"><input type="radio" name="group1" value="5"></li>
                <li>Organization within the course sessions&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group2" value="1"><input type="radio" name="group2" value="2"><input type="radio" name="group2" value="3"><input type="radio" name="group2" value="4"><input type="radio" name="group2" value="5"></li>
                <li>Work load was reasonable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group3" value="1"><input type="radio" name="group3" value="2"><input type="radio" name="group3" value="3"><input type="radio" name="group3" value="4"><input type="radio" name="group3" value="5"></li>
                <li>Appropriate background for the course &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="group4" value="1"><input type="radio" name="group4" value="2"><input type="radio" name="group4" value="3"><input type="radio" name="group4" value="4"><input type="radio" name="group4" value="5"></li>
                <li>Efficiency of Course facilities & equipments &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="group5" value="1"><input type="radio" name="group5" value="2"><input type="radio" name="group5" value="3"><input type="radio" name="group5" value="4"><input type="radio" name="group5" value="5"></li>		
            </ul> 

            <div style="position:absolute;left:428px;"><input type="submit" name="submit" value="submit" >

<?php
if ($flag == 1 && isset($_SESSION['flag1'])) {
    echo '<input type="submit" name="comments" value="Comments" disabled>';
} else {
    echo '<input type = "submit" name = "comments" value = "Comments">';
}
?>
                </form>
                </body>
                </html>