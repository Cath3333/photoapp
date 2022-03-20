<?php
    //count the number of comments in each post
    $commentquery= $conn -> query ('SELECT COUNT(*) FROM `Comment` WHERE post_id LIKE '.$postid);
    $commentnum= $commentquery -> fetch();
    echo "<a class='comment' href='comment.php?post=$postid'>$commentnum[0] comments</a>";

?>