<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<?php
    $unsql= "SELECT * FROM `User` WHERE username LIKE '".$_POST['unem']."'";
    $emsql= "SELECT * FROM `User` WHERE email LIKE '".$_POST['unem']."'";
    session_start();
    try{
        
        $conn= new PDO('mysql:host=localhost; dbname=Insta', 'root', 'root');
        $st= $conn -> prepare($unsql);
        $st -> execute();
        $account= $st->fetch();
        $success=0;
        if ($account){
            $_SESSION['un']=$account['username'];
            $_SESSION['em']=$account['email'];
            if(password_verify($_POST['pw'], $account['password'])){
                $success=1;
            }
            
        }
        else{
            $st= $conn -> prepare($emsql);
            $st -> execute();
            $account= $st->fetch();
            if ($account){
                $_SESSION['un']=$account['username'];
                $_SESSION['em']=$account['email'];
                if(password_verify($_POST['pw'], $account['password'])){
                    $success=1;
                }
            }
        }
        if($success==1){
            echo "<br><br><br><br><br><br><br><br><br><br><br><br><div><h2>Logged in successfully!</h2>";
            echo "<br><br><br><a href='home.php' class='login'> Home</a>";
        }
        else{
            echo "<br><br><br><br><br><br><br><br><br><br><br><br><h2>Unsuccessful login :( <h2>";
            echo "<br><br><br><a href='login.php' class='login'>try again</a>";
        }

        #echo $_SESSION['un'].$_SESSION['em'];

    }catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      };


?>