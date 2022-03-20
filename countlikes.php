<?php

    //count number of likes for each post
    $countlikequery= $conn -> query ('SELECT COUNT(*) FROM `Likes` WHERE post_id LIKE '.$postid);
    $countlike= $countlikequery -> fetch();
    $countlike= $countlike[0];
    echo "<p> $countlike likes ";
    if($posterid==$userid){

        //if the post belongs to the current user, show the names of the users that have liked the post
        echo "by: ";
        $likerquery= $conn -> query('SELECT liker_id FROM `Likes` WHERE post_id LIKE '.$postid);
        $likers= $likerquery -> fetchAll();
        foreach($likers as $liker){
            $usernamequery= $conn -> query('SELECT username FROM `User` WHERE user_id LIKE '.$liker[0]);
            $username= $usernamequery -> fetch();
            echo "$username[0], ";
        }
    }
    echo"</p><br>";

?>