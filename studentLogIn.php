<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if (isset($_POST['student']) && isset($_POST['pass'])) {
    $username = $_POST['student'];
    $password = $_POST['pass'];


    $result = mysqli_query($link, "select name,password from student  where name =  '$username' and password='$password'");
    $row = mysqli_fetch_assoc($result);
    if ($row['name'] == $username && $row['password'] = $password) {

        if (isset($_POST['remember'])) {
            setcookie('stuCo', $_POST['student'], time() + 60 * 2);
            setcookie('pasCo', md5($_POST['pass']), time() + 60 * 2);
        }

        if(isset($_POST['change']))
        {
            $_SESSION['stuSession'] = $username;
            header("Location: changeStudentPassword.php");
           
        }  else {
            
        
        header("Location: selection.php");
        }
        
        
    }
}

mysqli_close($link);

if (isset($_COOKIE['stuCo']) && isset($_COOKIE['pasCo'])) {
    header("Location: selection.php");
}
?>


<html>
    <body>

        <form action="" method="post">

            <h2>Student Log In</h2>

            Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="student">
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