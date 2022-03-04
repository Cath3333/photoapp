<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<nav>
    <a href='user.php'> user home </a>
    <a href='search.php'> search </a>
    <a href='createpost.php'> upload </a>
</nav>
<?php
    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo "Error: ". $e;
        }

       // echo "<h1> You are<br> Viewing the Messages</h1>";
        //echo"<br><a href='index.php'><h2> Back to Main Page </h2></a><br><br>";
        session_start();
        $un= $_SESSION['un'];
        $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
        $st= $conn -> prepare($search);
        $st -> execute();
        $account= $st->fetch();
        $userid=$account['user_id'];
        $profile= $account['profile'];
        $bio= $account['bio'];
        echo "<br><br><img src='pics/".$profile."'width='150'><h2>".$un."'s posts</h2><br><p class='dotted'>".$bio."</p><br><br><br>";

        $result= $conn -> query("SELECT * FROM `Post` WHERE user_id=".$userid);
        while ($row= $result->fetch()){
            $content= $row["content"];
            $pic= $row["pic"];
            $date= $row['date'];
            echo "<hr>
                 <br><br>
                 <img src='pics/".$pic."'width='400'><br><br>
                 <p class='content'>$content</p>
                 <p class='date'>$date</p>
                 <br><br>";
        }
        
        ?>
        <br><br><br>