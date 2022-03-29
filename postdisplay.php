<?php
    foreach ($allposts as $row){
        $content= $row["content"];
        $pic= $row["pic"];
        $date= $row['date'];
        $postid= $row['post_id'];
        $posterid= $row['user_id'];

        $postquery= $conn -> query("SELECT * FROM `User` WHERE user_id LIKE '".$posterid."'");
        $poster= $postquery->fetch();
        $postername=$poster['username'];
        
        
        echo "<hr>
            <img src='".$pic."'width='400'><br><br>
            <a href='userpost.php?un=$postername' >posted by : $postername</a><br><br>
            <p class='content'>$content</p>
            <p class='date'>$date</p><br>";

        require('countlikes.php');
        require('checklike.php');

        if ($display!='comment'){
            require('countcomment.php');
        }
    }
?>