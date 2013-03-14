<?php
session_start();

$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if (isset($_POST['admin']) && isset($_POST['pass'])) {
    $adminName = $_POST['admin'];
    $password = $_POST['pass'];


    $result = mysqli_query($link, "select name,password from admin  where name =  '$adminName' and password='$password'");
    $row = mysqli_fetch_assoc($result);
    if ($row['name'] == $adminName && $row['password'] = $password) {

        if (isset($_POST['remember'])) {
            setcookie('adminCo', $_POST['admin'], time() + 60 * 2);
            setcookie('PassCo', md5($_POST['pass']), time() + 60 * 2);
        }

        
        if(isset($_POST['change']))
        {
            $_SESSION['adSession'] = $adminName;
            header("Location: changeAdminPassword.php");
            
        }  else {
            
        
        header("Location: adminwin.php");
        }
        $_SESSION['adSession'] = $adminName;
        //$_SESSION['pass'] = $password;
        
        
        
    }
}

mysqli_close($link);

if (isset($_COOKIE['adminCo']) && isset($_COOKIE['PassCo'])) {
    header("Location: adminwin.php");
}

?>

<html>
    <body>

        <form action="" method="post">

            <h2>Admin Log In</h2>

            Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="admin">
            </br></br>

            Password : <input type="password" name="pass">
            </br></br>

            <input type="checkbox" name="remember"> Save Password .
            </br></br>


            <input type="submit" name="submit" value="Log In">
            <input type="submit" name="change" value="Change Password">



        </form>
    </body>
</html>