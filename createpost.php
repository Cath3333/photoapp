<link rel="stylesheet" href="style.css">
<br>
<?php
    require('nav.php');
?>
<a href='personalposts.php'> my posts </a>
<h2> You are making a post </h2><br>
<form action='createposthandle.php' method='post' enctype='multipart/form-data'>
    <p>Upload images: </p><br>
    <input type='file' name='img' require>
    <p>Add description: </p><br>
    <input type='text' name='description' class='block'>
    <br><input type='submit' value='GO!'>
</form>