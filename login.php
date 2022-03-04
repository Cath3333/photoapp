<!DOCTYPE html>
<nav>
    <a href='landing.php'> Main </a>
    <a href='signup.php'> Sign Up </a>
    <a href='login.php'> Log In</a>
</nav>
<head><link rel="stylesheet" href="style.css"></head>
<h1> You are Logging in </h1>
<form action='loginhandle.php' method='post'>
    <div> Enter username or email: </div>
    <input type='text' name='unem' require>
    <div> Enter password: </div>
    <input type='password' name='pw' require><br>
    <input type='submit' value='GO!'>
 </form>
 <br>