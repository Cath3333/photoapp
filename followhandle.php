<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    require('nav.php');
    require('database.php');

    //fetch the id of the user that is being followed
    $followingname=$_GET['target'];
    $un=$followingname;
    require('fetchuserid.php');
    $followingid=$userid;

    //fetch the id of the current user
    $userid=$_GET['user'];

    //follow or unfollow the target user
    if($_GET['fol']==0){
        $sql="INSERT INTO `Followers`(following_id, follower_id) Values(".$followingid.",".$userid.")";
        $conn->exec($sql);
        echo "Followed successfully!";
    }
    else{
        $sql="DELETE FROM `Followers` WHERE following_id LIKE ".$followingid." AND follower_id LIKE ".$userid;
        $conn->exec($sql);
        echo "Unfollowed successfully!";
    }
    echo"
    <a href='followlist.php'>Your follow list</a>
    <a href='userpost.php?un=$followingname'>To the user's post</a>";
    
?>