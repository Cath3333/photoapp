<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<?php
    require('nav.php');
    echo "<h1> Your Feed </h1>";
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();


    if ($_GET['like']==1){
        
        $addlikesql= "INSERT INTO `Likes` (post_id, liker_id) Values( ".$_GET['post'].','.$_GET['liker'].')';
        $conn->exec($addlikesql);
    }else if ($_GET['like']==2){
        echo 'test';
        $removelikesql="DELETE FROM `Likes` WHERE post_id LIKE ".$_GET['post']." AND liker_id LIKE ".$_GET['liker'];
        $conn->exec($removelikesql);
    }

    $un= $_SESSION['un'];
    $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
    $st= $conn -> prepare($search);
    $st -> execute();
    $account= $st->fetch();
    $userid=$account['user_id'];
    

    $followingsql= 'SELECT following_id FROM `Followers` WHERE follower_id LIKE '.$userid;
    $st= $conn -> prepare($followingsql);
    $st -> execute();

    $followinglist=[];
    while ($row=$st->fetch()){
        array_push($followinglist,$row["following_id"]);
    }
    //var_dump(array_values($followinglist));
    

    $postsql= "SELECT * FROM `Post` WHERE user_id IN (".implode(",",$followinglist).") ORDER BY date DESC LIMIT 30";
    //echo $postsql;
    $st= $conn -> prepare($postsql);
    $st -> execute();
    while ($row= $st -> fetch()){
        $posterid=$row['user_id'];
        $content= $row["content"];
        $pic= $row["pic"];
        $date= $row['date'];
        $postid= $row['post_id'];

        $postquery= $conn -> query("SELECT * FROM `User` WHERE user_id LIKE '".$posterid."'");
        $account= $postquery->fetch();
        $postername=$account['username'];

        $checklikequery= $conn -> query('SELECT * FROM `Likes` WHERE post_id LIKE '.$postid.' AND liker_id LIKE '.$userid);
        $likerow = $checklikequery -> fetch();

        $commentquery= $conn -> query ('SELECT COUNT(*) FROM `Comment` WHERE post_id LIKE '.$postid);
        $commentnum= $commentquery -> fetch();


        
        echo "<hr>
              <br><br>
                <img src='pics/".$pic."'width='400'><br><br>
                <a href='userpost.php?un=$postername' >$postername</a><br><br>
                <p class='content'>$content</p>
                <p class='date'>$date</p><br>";

        if ($likerow){
            echo "<a class='like' href='home.php?like=2&post=$postid&liker=$userid' >unlike</a>";
        }
        else {
            echo "<a class='like' href='home.php?like=1&post=$postid&liker=$userid' >like</a>";
        }
        
        echo "<a class='comment' href='comment.php?post=$postid&user=$userid'>$commentnum[0] comments</a>
                <br><br>
                <br><br>";
    }

?>

