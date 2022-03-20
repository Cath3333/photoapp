<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    require('database.php');
    $hashedpw= password_hash($_POST['pw'], PASSWORD_BCRYPT);
    $un= $_POST['un'];
    $em=$_POST['em'];

    
    $searchquery= $conn -> query("SELECT * FROM `User` WHERE username LIKE '".$un."'");
    $account = $searchquery -> fetch();
    if($account){
        //check whether the username had been taken by another account. If yes, ask the user to either log in or sign up with another username
        echo "<h2> Seems like the username has already been taken!</h2>
              <a href='signup.php'> Sign up again </a>
              <br><br>
              <a href='login.php'> Log in instead </a>";
    }
    else{
        $sql="INSERT INTO `User` (username, email, password) Values ('".$un."','".$em."','".$hashedpw."')";
        $conn->exec($sql);
        session_start();

        $_SESSION['un']=$un;
        $_SESSION['em']=$em;
        echo "<h2> Signed up Successfully!</h2>
              <br><br>
              <a href='user.php'> Begin your tomato journey </a>";
    
    }


?>

