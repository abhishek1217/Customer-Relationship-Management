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
        header("Location: managerlogin.php");
        return;
    }

    $sql = "SELECT F_Name,L_Name,Admin_id, Username, Password From Admin Where Username= :un and Password = :ps";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':un' => $un,':ps' => $ps]);
    $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if ( $row[0]['Password'] !== $ps){
        $_SESSION['error'] = 'Incorrect Password';
        header("Location: managerlogin.php");
        return;
    }
    $_SESSION['id'] = $row[0]['Admin_id'];
    $_SESSION['FirstName'] = $row[0]['F_Name'];
    $_SESSION['LastName'] = $row[0]['L_Name'];
    header("Location: manager/leads.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="bg-image" 
     style="background-image: url(light.jpg);
            height:100vh; background-repeat:no-repeat; background-size:cover;">
</div>
        <div class="card bg-light mb-3" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); z-index:2; width:35%; height:40%;">
        <div class="card-header text-center"><h3><strong>Login</strong><h3/></div>
        <div class="card-body text-center">
        <form method="post">
        <div class="form-group">
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
            <label for="exampleInputEmail1" style="margin-bottom: 5px;">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="Username" aria-describedby="emailHelp" placeholder="Enter Username">
        </div>
        <br/>
        <div class="form-group">
            <label for="exampleInputPassword1" style="margin-bottom: 5px;">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Password">
        </div>
        <br/>
        <button type="submit" class="btn btn-dark">Login</button>
        </form>
        </div>
        </div>
</body>
</html>