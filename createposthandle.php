<?php
    header('Location: userpost.php');
    session_start();
    require('database.php');
    $file= $_FILES['img']['name'];
    $des= $_POST['description'];
    
    $un= $_SESSION['un'];
    require('fetchuserid.php');

    //insert content of new posts to database
    $sql="INSERT INTO `Post` (user_id, content, pic) Values (".$userid.",'".$des."','".$file."')";
    $conn->exec($sql);
    
    $destination= '/Applications/MAMP/htdocs/PhotoApp/pics/';
    $filepath= $destination.$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], $filepath);
        
?>