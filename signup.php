<!DOCTYPE html>
<head><link rel="stylesheet" href="style.css"></head>
<nav>
    <a href='landing.php'> Main </a>
    <a href='signup.php'> Sign Up </a>
    <a href='login.php'> Log In</a>
</nav>
<h1> You are Signing Up </h1>
<form action='signuphandle.php' method='post'>
    <div> Username: </div>
    <input type='text' name='un' require><br>
    <div> Email: </div>
    <input type='text' name='em' require><br>
    <div> Password: </div>
    <input type='password' name='pw' require><br>
    <input type='submit' value='GO !'>
 </form>
<br>
 <br><br>