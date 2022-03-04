<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    $bio= $_POST['bio'];
    $pp= $_FILES['pp']['name'];
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        session_start();
        $un= $_SESSION['un'];
        $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
        $st= $conn -> prepare($search);
        $st -> execute();
        $account= $st->fetch();
        $userid= $account['user_id'];
        $sql="UPDATE `User` SET profile="."'".$pp."'".", bio='".$bio."' WHERE user_id=".$userid;
        $conn->exec($sql);
        

        $destination= '/Applications/MAMP/htdocs/PhotoApp/pics/';
        $filepath= $destination.$_FILES['pp']['name'];
        move_uploaded_file($_FILES['pp']['tmp_name'], $filepath);

        echo "<h2> Profile and bio updated successfully!</h2><br><br>";
        echo "<a href='user.php'> Back to user page </a>";
        
        
    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      };



?>