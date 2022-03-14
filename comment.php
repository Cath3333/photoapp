<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<?php
    require('nav.php');
    require('database.php');
    $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user= $_GET['user'];
    $postid= $_GET['post'];
    

    
    //Adding new comments (if any)
    if ($_POST['content']){
        //echo $_POST['post_id'];
        $postid= $_POST['post_id'];
        $user= $_POST['commenter'];
        $content= $_POST['content'];
        $insertquery="INSERT INTO `Comment`(post_id, commenter_id, content) Values(".$postid.",".$user.",'".$content."')";
        //echo $insertquery;
        $conn->exec($insertquery);
        //echo 'done?';
    }

    //Displaying All comments 
    //echo 'test';
    $postquery= $conn -> query('SELECT * FROM `Post` WHERE post_id LIKE '.$postid);
    $post= $postquery->fetch();

    $posterid=$post['user_id'];
    $content= $post["content"];
    $pic= $post["pic"];
    $date= $post['date'];

    $posterquery= $conn -> query("SELECT * FROM `User` WHERE user_id LIKE '".$posterid."'");
    $account= $posterquery->fetch();
    $postername=$account['username'];

    $likequery= $conn -> query('SELECT * FROM `Likes` WHERE post_id LIKE '.$postid." AND liker_id LIKE ".$user);
    $like= $likequery -> fetch();
    

    echo "<br>
        <img src='pics/".$pic."'width='400'><br><br>
        <a href='searchuser.php?un=$postername' >posted by : $postername</a>";
    if ($like){
        echo "<a class='like' href='home.php?like=2&post=$postid&liker=$userid' >unlike</a>";
    }
    else {
        echo "<a class='like' href='home.php?like=1&post=$postid&liker=$userid' >like</a>";
    }
    echo "<br><br><p class='content'>$content</p>
        <p class='date'>$date</p><br><hr>";

    
    $commentquery= $conn -> query('SELECT * FROM `Comment` WHERE post_id LIKE '.$postid);
    $comments= $commentquery -> fetchAll();
    
    if(!$comments){
        echo"<br><div>Currently no comments under this post!</div>";
    }else{

        foreach ( $comments as $comment){
            $commenter= $comment['commenter_id'];
            $commentcontent= $comment['content'];
            $time= $comment['time'];
            $comment_id= $comment['comment_id'];

            $commenterquery= $conn -> query ("SELECT * FROM `User` WHERE user_id LIKE '".$commenter."'");
            $commentername= $commenterquery -> fetch();
            $commentername= $commentername['username'];

            echo"
            <div class='eachcomment'>
                <p>$commentername : $commentcontent </p>
                <p> $time </p><br>
            ";
            if($user==$commenter){
                echo "<a href='commentedit.php?comment=$comment_id&userid=$user&action=1'>edit</a>
                <a href='commentedit.php?comment=$comment_id&userid=$user&action=2'>delete</a>";      }
            echo"</div>";
        }
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

