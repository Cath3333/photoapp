<link rel="stylesheet" href="style.css">
<br>
<nav>
    <a href='user.php'> back to user home </a>
    <a href='personalposts.php'> my posts </a>
    <a href='search.php'> search </a>
</nav>
<h2> You are making a post </h2><br>
<form action='createposthandle.php' method='post' enctype='multipart/form-data'>
    <p>Upload images: </p><br>
    <input type='file' name='img' require>
    <p>Add description: </p><br>
    <input type='text' name='des' class='block'>
    <br><input type='submit' value='GO!'>
</form>