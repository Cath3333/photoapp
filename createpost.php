<link rel="stylesheet" href="style.css">
<br>
<script src="https://app.simplefileupload.com/buckets/07da64324ebe0c7fa17f215024d6cdf2.js"></script>
<?php
    require('nav.php');
?>
<a href='personalposts.php'> my posts </a>
<h2> You are making a post </h2><br>
<form action='createposthandle.php' method='post' enctype='multipart/form-data'>
    <p>Upload images: </p><br>
    <input type='file' name='img' require><br><br>
    <p>Add description: </p><br>
    <input type='text' name='description' class='block'>
    <br><input type='submit' value='GO!'>
</form>