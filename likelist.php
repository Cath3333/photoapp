<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>

<?php
    require('nav.php');
    echo "<h1> Posts that you liked </h1>";
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['post'])){
        $removelikesql="DELETE FROM `Likes` WHERE post_id LIKE ".$_GET['post']." AND liker_id LIKE ".$_GET['liker'];
        #echo $removelikesql;
        $conn->exec($removelikesql);
    }


    session_start();
    $un= $_SESSION['un'];
    $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
    $st= $conn -> prepare($search);
    $st -> execute();
    $account= $st->fetch();
    $userid=$account['user_id'];

    $searchlike="SELECT post_id FROM `Likes` WHERE liker_id LIKE ".$userid;
    $l= $conn -> prepare($searchlike);
    $l -> execute();

    $likelist=[];
    while ($row=$l->fetch()){
        array_push($likelist,$row["post_id"]);
    }

    $postsql= "SELECT * FROM `Post` WHERE post_id IN (".implode(",",$likelist).") ORDER BY date DESC LIMIT 30";

    $st= $conn -> prepare($postsql);
    $st -> execute();
    while ($row= $st -> fetch()){
        $posterid=$row['user_id'];
        $content= $row["content"];
        $pic= $row["pic"];
        $date= $row['date'];
        $postid= $row['post_id'];

        $search="SELECT * FROM `User` WHERE user_id LIKE '".$posterid."'";
        $inside= $conn -> prepare($search);
        $inside -> execute();
        $account= $inside->fetch();
        $postername=$account['username'];

        
        echo "<hr>
            <br><br>
            <img src='pics/".$pic."'width='400'><br><br>
            <a href='searchuser.php?un=$postername' >$postername</a><br><br>
            <p class='content'>$content</p>
            <p class='date'>$date</p><br>
            <a class='like' href='likelist.php?post=$postid&liker=$userid' class='like'>unlike</a>
            <a class='comment' href='comment.php'>comment</a>
            <br><br>
            <br><br>";
    }



?>