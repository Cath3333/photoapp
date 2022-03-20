<?php
    //process request to like or unlike a post
    if ($_GET['like']==1){
        $addlikesql= "INSERT INTO `Likes` (post_id, liker_id) Values( ".$_GET['post'].','.$userid.')';
        $conn->exec($addlikesql);
    }else if ($_GET['like']==2){
        $removelikesql="DELETE FROM `Likes` WHERE post_id LIKE ".$_GET['post']." AND liker_id LIKE ".$userid;
        $conn->exec($removelikesql);
    }
?>