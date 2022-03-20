<?php
    header('Location: followlist.php');
    require('database.php');

    $sql="DELETE FROM `Followers` WHERE following_id LIKE ".$_GET['following']." AND follower_id LIKE ".$_GET['follower'];
    $conn->exec($sql);
?>