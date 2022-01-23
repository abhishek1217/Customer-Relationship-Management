<?php
require("pdo_dbconnection.php");
session_start();
?>






<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<ul class="header">
    <li><a class="crm">CRM</a></li>
    <div class="therest">
    <li><a href="login.php">Salesman</a></li>
    <li><a href="managerlogin.php">Manager</a></li></div>
    <!-- <li><a href="#about">About</a></li></div> -->
</ul>
<div class="sign-up">
        <p class="sign-up-text">Sign Up</p>
        <form method="post">
            <p class="reg"><label for="F_name">First Name</label>
            <input type="text" name="F_name" class="reg-input"/></p>
            <p class="reg"><label for="L_name">Last Name</label>
            <input type="text" name="L_name" class="reg-input"/></p>
            <p class="reg"><label for="Phone_No">Phone Number</label>
            <input type="text" name="Phone_No" class="reg-input"/></p>
            <p class="reg"><label for="Username">Username</label>
            <input type="number" name="Username" class="reg-input"/></p>
            <p class="reg"><label for="email">Email</label>
            <input type="email" name="email" class="reg-input"/></p>
            <p class="reg"><label for="pass">Password</label>
            <input type="password" name="pass" class="reg-input"/></p>
            <p class="reg"><label for="pass2">Reenter Password</label>
            <input type="password" name="pass2" class="reg-input"/></p>
            <input class="sign-up-button" type="submit" value="Sign Up">
        </form>
</div>
    <p class="para">Customer Relationship Management</p>
    <p class="para2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Aliquam sit amet orci in leo placerat pellentesque.
 Maecenas sit amet lorem ullamcorper, faucibus  
Nunc dui turpis, mollis sed rhoncus ut, vulputate. 
Aenean porttitor ex vel ligula cursus efficitur. 
Pellentesque gravida nunc mi. </p>
    
</body>
</html>


