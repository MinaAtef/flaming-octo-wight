<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <body>

        <form action="" method="post">
            <h2> Student </h2>
            Track : <select name="track"></select> 
            <br><br>
            Name : <select name="name"></select> 
            <br><br>
            <input type="button" name="add" value="Add/Edit">
            <input type="button" name="delete" value="Delete">
        </form>
        <form action="" method="post">
            <h2> Transfer Student </h2>
            Track : <select name="track"></select> 
            <br><br>
            Student : <select name="student"></select> 
            <br><br>
            New Track : <select name="ntrack"></select> 
            <br><br>
            <input type="button" name="transfer" value="Transfer">
        </form>
        
    </body>
</html>
