<?php
    $useridquery= $conn -> query("SELECT * FROM `User` WHERE username LIKE '".$un."'");
    $user= $useridquery->fetch();
    $userid= $user['user_id'];
?>