<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    require('nav.php');
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo "Error: ". $e;
        }


        session_start();
        $un= $_SESSION['un'];
        $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
        $st= $conn -> prepare($search);
        $st -> execute();
        $account= $st->fetch();
        $userid=$account['user_id'];
        //echo $userid;

        echo "<h2>Following</h2><hr>";
        $following='SELECT * FROM `Followers` WHERE follower_id LIKE '.$userid;
        $st= $conn -> prepare($following);
        $st -> execute();
        $datafollowing= $st -> fetchAll();
        //var_dump($datafollowing);
        
        foreach($datafollowing as $row){
            
            $targetid= $row["following_id"];

            $display= 'SELECT * FROM `User` WHERE user_id LIKE '.$targetid;
            $st= $conn -> prepare($display);
            $st -> execute();
            $displayacc= $st->fetch();

            $username= $displayacc["username"];
            $profile= $displayacc['profile'];
            echo "<br><div class='dotted'><img src='pics/$profile' width='50'>
                <br><p>$username</p>
                <br><p><a href='searchuser.php?un=$name'>posts</a>
                <a href='remove.php?following=$targetid&follower=$userid'>remove</a><br><br>
                </div>";
        }
        echo "<br><br><hr><h2>Followers</h2><hr>";

        $follower= 'SELECT * FROM `Followers` WHERE following_id LIKE '.$userid;
        $st= $conn -> prepare($follower);
        $st -> execute();
        $data= $st -> fetchAll();


        foreach ($data as $row){
            
            $followerid= $row['follower_id'];

            $display= 'SELECT * FROM `User` WHERE user_id LIKE '.$followerid;
            $st= $conn -> prepare($display);
            $st -> execute();
            $displayacc= $st->fetch();

            $username= $displayacc["username"];
            $profile= $displayacc['profile'];
            echo "<br><div class='dotted'><img src='pics/$profile' width='50'>
                <p>$username</p>
                <br><br><p><a href='searchuser.php?un=$name'>posts</a>
                <a href='remove.php?following=$userid&follower=$followerid'>remove</a><br><br>
                </div>";
        }



?>