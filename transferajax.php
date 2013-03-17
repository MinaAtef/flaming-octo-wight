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

        $test=$_POST['x'];
        $query2 = "select std_id , name from student where track_id= '$test' and status= '0'";
        $result2 = mysqli_query($link,$query2);
        //$row2 = mysqli_fetch_assoc($result2); 
        $option='';
        while ($row2 = mysqli_fetch_assoc($result2))
        {
            $option .="<option value='{$row2['std_id']}'>{$row2['name']}</option>";
        }
        echo $option;
?>