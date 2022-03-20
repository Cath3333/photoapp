<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    require('nav.php');
    require('database.php');
    session_start();
    $un= $_SESSION['un'];
    require('fetchuserid.php');
    require('editlike.php');


    echo "<h1> Your Feed </h1>";

    //fetch the list of people the user follows into an numeric array
    $followingsql= $conn -> query('SELECT following_id FROM `Followers` WHERE follower_id LIKE '.$userid);
    $followinglist=[];
    while ($row=$followingsql->fetch()){
        array_push($followinglist,$row["following_id"]);
    }
    
    //fetch and display the posts of the users that the current user follows
    $allpostsquery= $conn -> query("SELECT * FROM `Post` WHERE user_id IN (".implode(",",$followinglist).") ORDER BY date DESC LIMIT 30");
    $allposts= $allpostsquery -> fetchAll();

    $display='home';
    require('postdisplay.php');

?>

