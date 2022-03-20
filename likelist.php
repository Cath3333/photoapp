<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>

<?php
    require('nav.php');
    require('database.php');
    
    echo "<h1> Posts that you liked </h1>";

    session_start();
    $un= $_SESSION['un'];
    require('fetchuserid.php');
    require('editlike.php');

    //get the list of the id of posts that the user has liked
    $searchlikequery= $conn -> query("SELECT post_id FROM `Likes` WHERE liker_id LIKE ".$userid);
    $likelist=[];
    while ($row=$searchlikequery->fetch()){
        array_push($likelist,$row["post_id"]);
    }

    //fetch & display posts based on the list of id
    $postquery= $conn -> query("SELECT * FROM `Post` WHERE post_id IN (".implode(",",$likelist).") ORDER BY date DESC LIMIT 30");
    $allposts = $postquery -> fetchAll();

    $display='likelist';
    require('postdisplay.php');

?>