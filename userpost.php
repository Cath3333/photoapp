<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head><br><br>
<?php
    require('nav.php');
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
        //var_dump($followacc);

        echo "<br><br><img src='pics/".$profile."'width='150'><h2>".$un."'s posts</h2><br>";
        if ($followacc){
            
            echo "<a href='followhandle.php?fol=1&target=$userid&user=$nowuserid'>unfollow</a>";
        }
        else{
            echo "<a href='followhandle.php?fol=0&target=$userid&user=$nowuserid'>follow</a>";
        }
        echo"<br><br><br><br><p class='dotted'>".$bio."</p><br><br><br>";
        

        $result= $conn -> query("SELECT * FROM `Post` WHERE user_id=".$userid." ORDER by date DESC");
        while ($row= $result->fetch()){
            $content= $row["content"];
            $pic= $row["pic"];
            $date= $row['date'];
            $postid= $row['post_id'];
            echo "<hr>
                 <br><br>
                 <img src='pics/".$pic."'width='400'><br><br>
                 <p class='content'>$content</p>
                 <p class='date'>$date</p>
                 <br><br>";
                 //<a href='edit.php?id=$id'  id='edit'>edit</a>
                 //<a href='delete.php?id=$id'  id='delete'> delete </a>
                 //</div>
            
            $checklikequery= $conn -> query('SELECT * FROM `Likes` WHERE post_id LIKE '.$postid.' AND liker_id LIKE '.$userid);
            $checklike= $checklikequery->fetch();

            if ($checklike){
                echo "<a class='like' href='home.php?like=2&post=$postid&liker=$userid' >unlike</a>";
            }
            else {
                echo "<a class='like' href='home.php?like=1&post=$postid&liker=$userid' >like</a>";
            }

            $commentquery= $conn -> query ('SELECT COUNT(*) FROM `Comment` WHERE post_id LIKE '.$postid);
            $commentnum= $commentquery -> fetch();
            
            echo "<a class='comment' href='comment.php?post=$postid&user=$userid'>$commentnum[0] comments</a>
                    <br><br>
                    <br><br>";
    
            
        }
        
        ?>
        <br><br><br>