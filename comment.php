<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
    require('nav.php');
    require('database.php');
    session_start();
    
    $postid= $_GET['post'];
    $un= $_SESSION['un'];
    require('fetchuserid.php');
    
    
    
    //Adding new comments (if any)
    if ($_POST['content']){

        $user=$_POST['commenter'];
        $postid= $_POST['post_id'];
        $content= $_POST['content'];

        $insertquery="INSERT INTO `Comment`(post_id, commenter_id, content) Values(".$postid.",".$userid.",'".$content."')";
        $conn->exec($insertquery);
        
    }

    //Fetch & displaying post 
    $postquery= $conn -> query('SELECT * FROM `Post` WHERE post_id LIKE '.$postid);
    $allposts= $postquery -> fetchAll();
    $display='comment';
    
    require('postdisplay.php');
    echo '<hr>';

    //Fetch & display all comments
    $commentquery= $conn -> query('SELECT * FROM `Comment` WHERE post_id LIKE '.$postid." ORDER BY time DESC");
    $comments= $commentquery -> fetchAll();
    
    if(!$comments){
        echo"<div>Currently no comments under this post!</div>";
    }else{
        require('commentdisplay.php');
    }
    
?>
<br>
<hr>
    <div> Add a comment </div>
    <form action='comment.php' method='post'>
        <input type='textbox' name='content' class='commentpage'>
        <input type='hidden' name='commenter' value=<?php echo $user;?>>
        <input type='hidden' name='post_id' value=<?php echo $postid;?>>
        <input type='submit' value='GO !'>
    </form>

