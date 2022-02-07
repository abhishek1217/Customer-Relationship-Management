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
if (isset($_POST['uname']) && isset($_POST['psw'])){
    //TO DO: Add data validation 
    $sql = "SELECT F_Name,L_Name,Salesman_id, Username, Password From Salesman Where Username= :un and Password = :ps";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':un' => $_POST['uname'],':ps' => $_POST['psw']]);
    $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if ( $row[0]['Password'] !== $_POST['psw']){
        $_SESSION['error'] = 'Incorrect Password';
        header("Location: login.php");
        return;
    }
    $_SESSION['id'] = $row[0]['Salesman_id'];
    $_SESSION['FirstName'] = $row[0]['F_Name'];
    $_SESSION['LastName'] = $row[0]['L_Name'];
    header("Location: Leads.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div>
<ul class="header">
    <li><a class="crm" style = "font-style: italic;">CRM</a></li>
    <div class="therest">
    <li><a href="login.php">Salesman</a></li>
    <li><a href="managerlogin.php">Manager</a></li></div>
    <!-- <li><a href="#about">About</a></li></div> -->
</ul>
</div>

<center><img src="crmimage.jpg" alt="CRM" class="crm-image"></center>
<span>Customer Relationship Management</span>
<span>Your one stop to improve Customer relations</span>
<h2>Modal Login Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="profile.svg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<!-- <div class="whole-thing">
    <p class="para">Customer Relationship Management</p>
    <div style="background-image: url('crmimage.jpg');">
        <p class="para2">Manage all your customer data at just one place </p>
        <button onclick = "location.href = 'login.php';" class="login-button">Log In</button>
        <button onclick = "location.href = 'signup.php';" class="login-button">Sign Up</button>
    </div>
</div> -->
<!-- <div style="background-image: url('crmimage.jpg');"></div> -->
</body>
</html>


