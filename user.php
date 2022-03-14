<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<h1></h1>
<img class='noborder' src='pics/usertop.png' alt='tomato' width='300' height="200" >
<?php
    session_start();
    $un= $_SESSION['un'];
    echo "<h1>Welcome,<br>".$un." :)</h1>";
    //echo "<a href='profile.php'>Go to profile</a>";
    require('nav.php');
?>

<a href='userpost.php?un=<?php echo $un;?>'> Your posts</a>
<a href='followlist.php'> Following & Followers</a>
<a href='likelist.php'>Like list</a>
<br><br><br><br><br><br>


<hr>
<h2> Setting </h2>
<form action='edit.php' method='post' enctype='multipart/form-data'>
    <div> Edit Profile </div>
    <p> Upload profile pic here: </p><br>
    <input type='file' name='pp' accept='image/png, image/jpeg'> 
    <p> Update or add your bio: </p><br>
    <input type='text' name='bio'>
    <br><input type='submit' value='GO!'>
</form>
<br><br><a href='logout.php'> Log out</a><br><br><br><br>
<hr><br><br>

