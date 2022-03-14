<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>

<?php
    require('nav.php');
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error: ". $e;}
    $sql="DELETE FROM `Followers` WHERE following_id LIKE ".$_GET['following']." AND follower_id LIKE ".$_GET['follower'];
    $conn->exec($sql);
    echo "User removed from list successfully!";
?>
<br><br><a href='followlist.php'>Go Back</a>