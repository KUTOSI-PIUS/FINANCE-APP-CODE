<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<div class="body">
   <div class="container">
    <div class="title">Registration form</div>

    <form action="process.php" method="POST">
        <div class="user-details">
            <!-- <div class="input-box">
                <span class="details">Full name</span>
                <input type="text" placeholder="enter your name" required>
            </div> -->
            <div class="input-box">
                <span class="details">Username</span>
                <input type="text" name="username" placeholder="enter username" required>
            </div>
            <div class="input-box">
                <span class="details">Email</span>
                <input type="text"  name="email" placeholder="enter email" required>
            </div>
            <!-- <div class="input-box">
                <span class="details">Phone number</span>
                <input type="text" placeholder="enter your number" required>
            </div> -->
            <div class="input-box">
                <span class="details">Password</span>
                <input type="password" name="password" placeholder="enter password" required>
            </div>
            <!-- <div class="input-box">
                <span class="details">Confirm Password</span>
                <input type="password" placeholder="Retype your password" required>
            </div> -->

            <input type="submit" value="register">

            <button type="submit" class="btn">Register</button> 
    </form>
   </div>
   </div>
</body>
</html>

process.php


<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$pass = md5($password);

    echo "<h1> Welcome ".$username."</h1>";

    echo "<h2> Your email is ".$email."</h2>";

    echo "<h2> your password is ".$pass."</h2>";







?>