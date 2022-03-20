<?php 
    //check whether the user has liked a post and display like/unlike button accordingly 

    $checklikequery= $conn -> query('SELECT * FROM `Likes` WHERE post_id LIKE '.$postid.' AND liker_id LIKE '.$userid);
    $checklike= $checklikequery->fetch();

    if ($checklike){
        echo "<a class='like' href='$display.php?like=2&post=$postid' >unlike</a>";
    }
    else {
        echo "<a class='like' href='$display.php?like=1&post=$postid' >like</a>";
    }
?>