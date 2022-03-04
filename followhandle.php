<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<nav>
    <a href='user.php'> user home </a>
    <a href='search.php'> search </a>
    <a href='createpost.php'> upload </a>
</nav>
<?php
    $targetid=$_GET['target'];
    $userid=$_GET['user'];
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        echo "Error: ". $e;
    }

    if($_GET['fol']==0){
        $sql="INSERT INTO `Followers`(following_id, follower_id) Values(".$targetid.",".$userid.")";
        $conn->exec($sql);
        echo "Followed successfully!
        <a href='";


    }
    else{
        $sql="DELETE FROM `Followers` WHERE following_id LIKE ".$targetid." AND follower_id LIKE ".$userid;
        $conn->exec($sql);
        echo "Unfollowed successfully!";
    }



?>