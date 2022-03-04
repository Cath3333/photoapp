<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<nav>
    <a href='user.php'> setting </a>
    <a href='search.php'> search </a>
    <a href='createpost.php'> upload </a>
</nav>
<h1> Home Page </h1>
<?php
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    session_start();


    if ($_GET['like']==1){
        $addlikesql= "INSERT INTO `Likes` (post_id, liker_id) Values( ".$_GET['post'].','.$_GET['liker'].')';
        #echo $addlikesql;
        $conn->exec($addlikesql);
    }else if ($_GET['like']==0){
        $removelikesql="DELETE FROM `Likes` WHERE post_id LIKE ".$_GET['post']." AND liker_id LIKE ".$_GET['liker'];
        #echo $removelikesql;
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

        $search="SELECT * FROM `User` WHERE user_id LIKE '".$posterid."'";
        $inside= $conn -> prepare($search);
        $inside -> execute();
        $account= $inside->fetch();
        $postername=$account['username'];

        $checklike='SELECT * FROM `Likes` WHERE post_id LIKE '.$postid.' AND liker_id LIKE '.$userid;
        $fetchlike= $conn -> prepare($checklike);
        $fetchlike -> execute();
        $likerow = $fetchlike -> fetch();
        #var_dump($likerow);

        
        echo "<hr>
              <br><br>
                <img src='pics/".$pic."'width='400'><br><br>
                <a href='searchuser.php?un=$postername' >$postername</a><br><br>
                <p class='content'>$content</p>
                <p class='date'>$date</p><br>";

        if ($likerow){
            echo "<a class='like' href='home.php?like=0&post=$postid&liker=$userid' class='like'>unlike</a>";
        }
        else {
            echo "<a class='like' href='home.php?like=1&post=$postid&liker=$userid' class='like'>like</a>";
        }
        
        echo "<a class='comment' href='comment.php'>comment</a>
                <br><br>
                <br><br>";
    }

?>

