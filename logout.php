<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    session_start();
    session_unset();
    echo "<h1> Your account has <br><br>been logged out</h1>";
    echo "<a href='index.php'> back to main page</a>";

?>