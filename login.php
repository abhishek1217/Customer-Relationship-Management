<?php
require("pdo_dbconnection.php");
session_start();
$un = ' ';
$ps = ' ';
$id = ' ';
if ( isset($_POST['Username']) && isset($_POST['Password'])) {

    $un = $_POST['Username'];
    $ps = $_POST['Password'];
    // Data validation
    if ( strlen($_POST['Username']) < 1 || strlen($_POST['Password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: login.php");
        return;
    }

    $sql = "SELECT F_Name,L_Name,Salesman_id, Username, Password From Salesman Where Username= :un and Password = :ps";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':un' => $un,':ps' => $ps]);
    $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if ( $row[0]['Password'] !== $ps){
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
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class = "login-stuff">
        <div class="details">
            <h1>Login</h1>
            <form method="post">
            <p class="login-text"><label for="Username">Username</label>
            <input type="text" name="Username" class="login-input"/></p>
            <p class="login-text"><label for="Password">Password</label>
            <input type="text" name="Password" class="login-input"/></p>
            <input type="submit" value="Login" class="login-button">
            <?php
            if(isset($_SESSION['error'])){
            ?>
            <div class="message">
            <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
            </div>
            <?php
            }
            unset($_SESSION['error']);
            ?>
            </form>
        </div>
    </div>
</body>
</html>