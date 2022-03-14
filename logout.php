<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php

    session_start();
    unset($_SESSION['un']);
    unset($_SESSION['em']);
    unset($_SESSION['pw']);
    echo $_SESSION['un'].$_SESSION['em'].$_SESSION['pw'];
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><h2> Your account has <br><br>been logged out</h2>";
    echo "<br><br><br><a href='index.php'> back to main page</a>";

?>