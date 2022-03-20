
<?php
    header('Location: user.php');
    $bio= $_POST['bio'];
    $pp= $_FILES['pp']['name'];
    
    session_start();
    $un= $_SESSION['un'];
    require('database.php');
    require('fetchuserid.php');
    

    $sql="UPDATE `User` SET profile="."'".$pp."'".", bio='".$bio."' WHERE user_id=".$userid;
    $conn->exec($sql);
    

    $destination= '/Applications/MAMP/htdocs/PhotoApp/pics/';
    $filepath= $destination.$_FILES['pp']['name'];
    move_uploaded_file($_FILES['pp']['tmp_name'], $filepath);

?>