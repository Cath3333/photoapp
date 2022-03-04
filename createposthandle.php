<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    session_start();
    $file= $_FILES['img']['name'];
    $des= $_POST['des'];
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

        $sql="INSERT INTO `Post` (user_id, content, pic) Values (".$userid.",'".$des."','".$file."')";
        //echo $sql;
        $conn->exec($sql);
        
        //var_dump($_FILES);
        $destination= '/Applications/MAMP/htdocs/PhotoApp/pics/';
        $filepath= $destination.$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $filepath);

        echo "<h2> Post Uploaded Successfully!</h2><br><br>";
        echo "<a href='user.php'> Back to user page </a>";
        
        
    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      };

?>