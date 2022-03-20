<?php
    //display each comment (after fetching)
    foreach ($comments as $comment){
        $commenter= $comment['commenter_id'];
        $commentcontent= $comment['content'];
        $time= $comment['time'];
        $comment_id= $comment['comment_id'];

        $commenterquery= $conn -> query ("SELECT * FROM `User` WHERE user_id LIKE '".$commenter."'");
        $commentername= $commenterquery -> fetch();
        $commentername= $commentername['username'];

        echo"<div class='eachcomment'>
            <p>$commentername : $commentcontent </p>
            <p> $time </p>";
        if($userid==$commenter){
            echo "<a href='commentedit.php?comment=$comment_id&userid=$user&action=1'>edit</a>
            <a href='commentedit.php?comment=$comment_id&userid=$user&action=2'>delete</a>";      }
        echo"</div>";
    }
?>