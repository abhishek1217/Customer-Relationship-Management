<?php
require("pdo_dbconnection.php");
session_start();
if ( isset($_POST['F_name']) && isset($_POST['L_name']) && isset($_POST['Gender']) && isset($_POST['Phone_No']) &&
        isset($_POST['Username']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass2'])) {

    if (strlen($_POST['F_name']) < 1 || strlen($_POST['L_name']) < 1 || strlen($_POST['Gender']) < 1 || strlen($_POST['Phone_No']) < 1 ||
            strlen($_POST['Username']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 || strlen($_POST['pass2']) < 1) {
        $_SESSION['error'] = "Missing Data";
        header("Location: index.php");
        return;
    }

    if ( $_POST['pass'] !== $_POST['pass2']){
        $_SESSION['error'] = "Passwords don't Match";
        header("Location: index.php");
        return;
    }
    $sql = "INSERT INTO Salesman (F_Name, L_Name, Gender, Phone_No, Email, Username, Password) VALUES (:fname,:lname,:gender,:phone_no,:email,:username,:password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':fname' => $_POST['F_name'],
        ':lname' => $_POST['L_name'],
        ':gender' => $_POST['Gender'],
        ':phone_no' => $_POST['Phone_No'],
        ':email' => $_POST['email'],
        ':username' => $_POST['Username'],
        ':password' => $_POST['pass']));
    $_SESSION['success'] = 'Sign Up Complete. Please Log In to Continue';
    header('Location: index.php');
    return;
    }

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
        <?php
        if(isset($_SESSION['success']))
        {
        ?>
        <div class="message">
            <strong>Success!   </strong><strong><?php echo $_SESSION['success'];?></strong>
        </div>
        <?php
        }
        unset($_SESSION['success']);
        if(isset($_SESSION['error']))
        {
        ?>
        <div class="message">
            <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
        </div>
        <?php
        }
        unset($_SESSION['error']);
        ?>
        <form method="post">
            <p class="reg"><label for="F_name">First Name</label>
            <input type="text" name="F_name" class="reg-input"/></p>
            <p class="reg"><label for="L_name">Last Name</label>
            <input type="text" name="L_name" class="reg-input"/></p>
            <p class="reg"><label for="Gender">Gender</label>
            <input type="text" name="Gender" class="reg-input"/></p>
            <p class="reg"><label for="Phone_No">Phone Number</label>
            <input type="number" name="Phone_No" class="reg-input"/></p>
            <p class="reg"><label for="Username">Username</label>
            <input type="text" name="Username" class="reg-input"/></p>
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
    <button onclick = "location.href = 'login.php';" class="login-button">Log In</button>
</body>
</html>


