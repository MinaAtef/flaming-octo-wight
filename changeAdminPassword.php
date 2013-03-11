<?php

session_start();
$nameSess=$_SESSION['adSession'];
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if (isset($_POST['old']) && isset($_POST['new'])) {
    $old = $_POST['old'];
    $new = $_POST['new'];

    $result = mysqli_query($link, "select password from admin where password='$old'");
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] == $old) {
        mysqli_query($link, "update admin set password='$new' where name='$nameSess' ");
    }
}
?>

<html>
    <body>

        <form action="" method="post">

            <h2>Change Password</h2>

            Old Password : <input type="password" name="old">
            </br></br>

            New Password : <input type="password" name="new">
            </br></br>

            <input type="submit" name="submit" value="Change Password">
            



        </form>
    </body>
</html>
