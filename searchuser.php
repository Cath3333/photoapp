<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<nav>
    <a href='home.php'> home </a>
    <a href='user.php'> setting </a>
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

        session_start();
        $un= $_GET['un'];
        $search="SELECT * FROM `User` WHERE username LIKE '".$un."'";
        $st= $conn -> prepare($search);
        $st -> execute();
        $account= $st->fetch();
        $userid=$account['user_id'];
        $profile= $account['profile'];
        $bio= $account['bio'];

        $nowun= $_SESSION['un'];
        $search="SELECT * FROM `User` WHERE username LIKE '".$nowun."'";
        $st= $conn -> prepare($search);
        $st -> execute();
        $account= $st->fetch();
        $nowuserid= $account['user_id'];

        //echo $userid." ".$nowuserid;
        $follow= "SELECT * FROM `Followers` WHERE following_id LIKE ".$userid." AND follower_id LIKE ".$nowuserid;
        //echo $follow;
        $st= $conn -> prepare($follow);
        $st -> execute();
        $followacc= $st->fetch();

        echo "<br><br><img src='pics/".$profile."'width='150'><h2>".$un."'s posts</h2><br>";
        if (is_null($followacc['user_id'])){
            echo "<a href='followhandle.php?fol=0&target=$userid&user=$nowuserid'>follow</a>";
        }
        else{
            echo "<a href='followhandle.php?fol=1&target=$userid&user=$nowuserid'>unfollow</a>";
        }
        echo"<br><br><br><br><p class='dotted'>".$bio."</p><br><br><br>";
        

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
                 //<a href='edit.php?id=$id'  id='edit'>edit</a>
                 //<a href='delete.php?id=$id'  id='delete'> delete </a>
                 //</div>
        }
        
        ?>
        <br><br><br>