<?php
session_start();
//<?php
//if (isset($_SESSION['stdId']))
  //  header("Location: selection.php");
$link = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if (isset($_POST['student']) && isset($_POST['pass'])) {
    $username = $_POST['student'];
    $password = $_POST['pass'];


    $result = mysqli_query($link, "select s.* from student s join intake i on s.intake_id=i.intake_id and s.name = '$username' and s.password='$password' and i.current='1'");
    $row = mysqli_fetch_assoc($result);
    echo $row['name'];

    if ($row['name'] == $username && $row['password'] = $password) {

        if (isset($_POST['remember'])) {
            setcookie('stuCo', $_POST['student'], time() + 60 * 5);
            setcookie('pasCo', md5($_POST['pass']), time() + 60 * 5);
        }

        if (isset($_POST['change'])) {
            $_SESSION['stuSession'] = $username;
            header("Location: changeStudentPassword.php");
        } else {


            header("Location: selection.php");
        }


        $_SESSION['stdId'] = $row['std_id'];
        $_SESSION['trkId'] = $row['track_id'];
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