<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
    require('nav.php');
    echo"<div>Editing Comment:</div><hr>";
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if($_POST['content']){
        $postid=$_POST['post'];
        $user= $_POST['user'];
        $commentid= $_POST['commentid'];

        $editquery= "UPDATE `Comment` SET content='".$_POST['content']."' WHERE comment_id LIKE ".$commentid;
        $conn->exec($editquery);

        echo"<br><br><p>comment updated</p><br><br>
        <a href='comment.php?post=$postid&user=$user'>go back</a>";
    }

    else{
        $commentid= $_GET['comment'];
        $user= $_GET['userid'];

        $commentquery= $conn -> query('SELECT * FROM `Comment` WHERE comment_id LIKE '.$commentid);
        $comment= $commentquery -> fetch();
        $postid= $comment['post_id'];
        $commentcontent= $comment['content'];
        $time= $comment['time'];


        if($_GET['action']==1){
            echo"
            <div class='eachcomment'>
                <p> $commentcontent </p>
                <p> $time </p><br>
            </div>
            <form action='commentedit.php' method='post'>
                <input type='hidden' name='post' value=".$postid.">
                <input type='hidden' name='user' value=".$user.">
                <input type='hidden' name='commentid' value=".$commentid.">
                <input type='text' name='content'>
                <input type='submit' value='EDIT'>
            </form>
            ";

        }else if ($_GET['action']==2){
            $deletequery="DELETE FROM `Comment` WHERE comment_id LIKE ".$commentid;
            $conn->exec($deletequery);
            echo '<br><br><p>comment deleted</p><br><br>';
            echo "<a href='comment.php?post=$postid&user=$user'>go back</a>";
        }

    }


?>