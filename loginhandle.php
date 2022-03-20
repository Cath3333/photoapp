<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    session_start();
    require('database.php');

    //first check if the user logged in using username
    $unquery= $conn -> query("SELECT * FROM `User` WHERE username LIKE '".$_POST['unem']."'");
    $account= $unquery -> fetch();
    $success=0;
    if ($account AND password_verify($_POST['pw'], $account['password'])){
        $success=1; }
    else{
        //if not username, check if the user used email
        $emquery= $conn -> query("SELECT * FROM `User` WHERE email LIKE '".$_POST['unem']."'");
        $account= $emquery -> fetch();
        if ($account AND password_verify($_POST['pw'], $account['password'])){
            $success=1; }
    }
    if($success==1){
        $_SESSION['un']=$account['username'];
        $_SESSION['em']=$account['email'];
        echo "<h2>Logged in successfully!</h2>
                <a href='home.php' class='login'> Home</a>";
    }
    else{
        //if both username and email didn't work, ask the user to try again
        echo "<h2>Unsuccessful login :( <h2>
                <a href='login.php' class='login'>try again</a>";
    }

?>