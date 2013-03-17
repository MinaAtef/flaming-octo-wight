<?php

$link = @mysqli_connect(
                'localhost', 'root', '', 'evaluation'
);
if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
$test = $_POST['name'];
$trkId = $_POST['track'];
$query = "SELECT i.* from instructor i join course c join ins_course_track ic on i.ins_id=ic.ins_id and c.course_id=ic.course_id and c.course_id = '$test' and ic.track_id='$trkId'";
$result = mysqli_query($link, $query);
$option = "<option value='noselection_t'>No Selection</option>";
//$row = mysqli_fetch_assoc($result);
//
//$option.="<option value='noselection_i'>No Selection</option>";
//$option.="<option value='{$row['ins_id']}'>{$row['name']}</option>";
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['status'] == 0) {
        $option.="<option value='{$row['ins_id']}'>{$row['name']}</option>";
    }
}
echo $option;
?>