<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<script src="https://app.simplefileupload.com/buckets/07da64324ebe0c7fa17f215024d6cdf2.js"></script>
<h2><img class='noborder' src='pics/usertop.png' alt='tomato' width='300' height="200" ></h2>
<?php
    session_start();
    $un= $_SESSION['un'];
    echo "<h2>Welcome,<br>".$un." :)</h2>";
    
    require('database.php');
    require('fetchuserid.php');

    //dispkay profile pic
    $profilequery= $conn -> query('SELECT profile FROM `User` WHERE user_id LIKE '.$userid);
    $profile= $profilequery->fetch();
    $profile= $profile['profile'];
    echo "<img src='pics/".$profile."'width='150'><br>";

    //nav bar goes after username and profile pic 
    require('nav.php');

?>


<a href='userpost.php'> Your posts</a>
<a href='followlist.php'> Following & Followers</a>
<a href='likelist.php'>Like list</a>


<hr>
<h2> Setting </h2>
<form action='profileedit.php' method='post' enctype='multipart/form-data'>
    <div> Edit Profile </div>
    <p> Upload profile pic here: </p><br>
    <input type='file' name='pp' accept='image/png, image/jpeg'> <br><br>
    <p> Update or add your bio: </p><br>
    <input type='text' name='bio'>
    <br><input type='submit' value='GO!'>
</form>
<br><br><a href='logout.php'> Log out</a>
<hr><br><br>

