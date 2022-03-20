<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<?php
    require('nav.php');
    require('database.php');

    $unem = $_POST["unem"];
    echo "<h2> Search results for: ".$unem."</h2><br>";
    $unem= "%$unem%";
    $display='search';
    require('userdisplay.php');
    ?>