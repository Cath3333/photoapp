<?php
    header('Location: userpost.php');
    session_start();
    require('database.php');
    $file= $_POST['img'];
    $des= $_POST['description'];
    
    $un= $_SESSION['un'];
    require('fetchuserid.php');

    //insert content of new posts to database
    $sql="INSERT INTO `Post` (user_id, content, pic) Values (".$userid.",'".$des."','".$file."')";
    $conn->exec($sql);
        
?>