<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    session_start();
    require('nav.php');
    require('database.php');
    $un= $_SESSION['un'];
    require('fetchuserid.php');
    $display='fol';

    //fetch and display list of people that the current user follows
    echo "<h2>Following</h2><hr>";
    $loc='followlist';

    $followingquery= $conn -> query('SELECT * FROM `Followers` WHERE follower_id LIKE '.$userid);
    $following= $followingquery -> fetchAll();
    
    foreach($following as $row){
        $targetid= $row["following_id"];
        $status=1;
        include('userdisplay.php');
    }
    
    //fetch and display list of people that follow the current user
    echo "<hr><h2>Followers</h2><hr>";

    $followerquery= $conn -> query('SELECT * FROM `Followers` WHERE following_id LIKE '.$userid);
    $follower= $followerquery -> fetchAll();

    foreach ($follower as $row){
        
        $targetid= $row['follower_id'];
        $status=2;
        include('userdisplay.php');
    }



?>