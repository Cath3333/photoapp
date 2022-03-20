<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<?php
    require('nav.php');
    require('database.php');
    session_start();
    $un= $_GET['un'];
    if(!isset($un)){
        $un= $_SESSION['un'];
    }

    //fetch the info of the user of this page
    require('fetchuserid.php');
    $postuserid= $userid;
    $postprofile= $user['profile'];
    $postbio= $user['bio'];
    $postname= $user['username'];

    //fetch id of current user
    $un= $_SESSION['un'];
    require('fetchuserid.php');

    $checkfollowquery= $conn -> query("SELECT * FROM `Followers` WHERE following_id LIKE ".$postuserid." AND follower_id LIKE ".$userid);
    $checkfollow= $checkfollowquery -> fetch();

    //display profile pic
    echo "<img src='pics/".$postprofile."'width='150'><h2>".$postname."'s posts</h2>";
    if ($checkfollow){
        echo "<a href='followhandle.php?fol=1&target=$postname&user=$userid'>unfollow</a>";
    }
    //if the user whose posts are being displayed is the same as the current user, don't show follow button
    else if ($userid != $postuserid){
        echo "<a href='followhandle.php?fol=0&target=$postname&user=$userid'>follow</a>";
    }

    //display personal bio
    echo"<p class='dotted'>".$postbio."</p>";
    
    //fetch & display all posts
    $allpostsquery= $conn -> query("SELECT * FROM `Post` WHERE user_id=".$postuserid." ORDER by date DESC");
    $allposts= $allpostsquery -> fetchAll();

    require('postdisplay.php');
        
    ?>
