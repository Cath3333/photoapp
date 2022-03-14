<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    require('nav.php');
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $targetid=$_GET['target'];
    $userid=$_GET['user'];
    if($_GET['fol']==0){
        $sql="INSERT INTO `Followers`(following_id, follower_id) Values(".$targetid.",".$userid.")";
        $conn->exec($sql);
        echo "Followed successfully!";

    }
    else{
        $sql="DELETE FROM `Followers` WHERE following_id LIKE ".$targetid." AND follower_id LIKE ".$userid;
        $conn->exec($sql);
        echo "Unfollowed successfully!";
    }
    
?>