<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    $hashedpw= password_hash($_POST['pw'], PASSWORD_BCRYPT);
    $un= $_POST['un'];
    $em=$_POST['em'];

    try{
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $searchsql= "SELECT * FROM `User` WHERE username LIKE '".$un."'";
        $st= $conn -> prepare($searchsql);
        $st -> execute();
        $account= $st->fetch();
        if($account){
            echo "<h2> Seems like the username has already been taken!</h2>";
            echo "<a href='signup.php'> Sign up again </a>";
            echo "<br><br><br><a href='login.php'> Log in instead </a>";
        }
        else{
            $sql="INSERT INTO `User` (username, email, password) Values ('".$un."','".$em."','".$hashedpw."')";
            $conn->exec($sql);
            session_start();
    
            $_SESSION['un']=$un;
            $_SESSION['em']=$em;
            #echo $_SESSION['un'].$_SESSION['em'];
            echo "<h2> Signed up Successfully!</h2><br><br>";
            echo "<a href='user.php'> Begin your tomato journey </a>";
        
        }
        
        
    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      };

?>

