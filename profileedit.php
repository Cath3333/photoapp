
<?php
    header('Location: user.php');
    $bio= $_POST['bio'];
    $pp= $_POST['pp'];
    
    session_start();
    $un= $_SESSION['un'];
    require('database.php');
    require('fetchuserid.php');
    

    $sql="UPDATE `User` SET profile="."'".$pp."'".", bio='".$bio."' WHERE user_id=".$userid;
    $conn->exec($sql);
    
?>