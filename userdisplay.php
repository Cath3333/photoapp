<?php
    if ($display=='fol'){
        $searchuserquery= $conn -> query('SELECT * FROM `User` WHERE user_id LIKE '.$targetid);
    }
    else if ($display=='search'){
        $searchuserquery= $conn -> query("SELECT * FROM `User` WHERE username LIKE '".$unem."' OR email LIKE '".$unem."'");
    }
   
    $targets= $searchuserquery->fetchAll();

    foreach ($targets as $target){
        $targetname= $target["username"];
        $profile= $target['profile'];
        echo "<br><div class='dotted'><img src='$profile' width='50'>
            <br><p>$targetname</p>
            <br><p><a href='userpost.php?un=$targetname'>posts</a>";
        if ($display=='fol'){
            if ($status==1){
                echo "<a href='remove.php?following=$targetid&follower=$userid'>remove</a>";
            }else if ($status==2){
                echo "<a href='remove.php?following=$userid&follower=$targetid'>remove</a>";
            }
        }
        echo"</div>";
    }
    
?>