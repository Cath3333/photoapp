<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
    require('nav.php');
    require('database.php');

    echo"<div>Editing Comment:</div><hr>";
    
    
    if($_POST['content']){

        #update comments that the user edited (if form below has been sent)
        $postid=$_POST['post'];
        $user= $_POST['user'];
        $commentid= $_POST['commentid'];

        $editquery= "UPDATE `Comment` SET content='".$_POST['content']."' WHERE comment_id LIKE ".$commentid;
        $conn->exec($editquery);

        echo"<div>comment updated</div>
        <a href='comment.php?post=$postid&user=$user'>go back</a>";
    }

    else{
        $commentid= $_GET['comment'];
        $user= $_GET['userid'];

        //fetch the target comment
        $commentquery= $conn -> query('SELECT * FROM `Comment` WHERE comment_id LIKE '.$commentid);
        $comment= $commentquery -> fetch();
        $postid= $comment['post_id'];
        $commentcontent= $comment['content'];
        $time= $comment['time'];

        if($_GET['action']==1){

            //display edit form if user choose to edit the comment
            echo"<div class='eachcomment'>
                <p> $commentcontent </p>
                <p> $time </p>
                </div>
                <form action='commentedit.php' method='post'>
                    <input type='hidden' name='post' value=".$postid.">
                    <input type='hidden' name='user' value=".$user.">
                    <input type='hidden' name='commentid' value=".$commentid.">
                    <input type='text' name='content'>
                    <input type='submit' value='EDIT'>
                </form>";
        
        }else if ($_GET['action']==2){

            //directly remove comment from database if user choose to delete
            $deletequery="DELETE FROM `Comment` WHERE comment_id LIKE ".$commentid;
            $conn->exec($deletequery);
            echo '<div>comment deleted</div>';
            echo "<a href='comment.php?post=$postid&user=$user'>go back</a>";
        }

    }


?>