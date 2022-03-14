<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<?php
    require('nav.php');
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');

    }catch(PDOException $e){
        echo "Error: ". $e;
    }

    $unem = $_POST["unem"];
    echo "<h2> Search results for: ".$unem."</h2><br>";
    $unem= "%$unem%";
    $sql= "SELECT * FROM `User` WHERE username LIKE '".$unem."' OR email LIKE '".$unem."'";

    $st= $conn -> prepare($sql);
    $st -> execute();
    
    while($row= $st->fetch()){
        $name= $row["username"];
        $email= $row["email"];
        $profile= $row['profile'];
        echo "<hr><br><br><img src='pics/$profile' width='150'><br><br><br>
              <p><a href='userpost.php?un=$name'>$name</a><br><br>
              $email</p><br><br>";
    }
    ?>