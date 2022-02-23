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
        header("Location: index.php");
        return;
    }

    $sql = "SELECT F_Name,L_Name,Salesman_id, Username, Password From Salesman Where Username= :un and Password = :ps";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':un' => $un,':ps' => $ps]);
    $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if ( $row[0]['Password'] !== $ps){
        $_SESSION['error'] = 'Incorrect Password';
        header("Location: index.php");
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Tenth navbar example">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" style="margin-right:20px;"><h3>CRM <br/></h3></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php"style="margin-top:8px;"><h5>Salesman</h5></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="managerlogin.php" style="margin-top:8px;"><h5>Manager</h5></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php" style="margin-top:8px;"><h5>SignUp</h5></a>
          </li>
        </ul>
      </div>
    </div>
</nav>

<div class="bg-image" 
     style="background-image: url(light.jpg);
            height:100vh; background-repeat:no-repeat; background-size:cover;">
</div>
<div style="position:absolute; top:20%; left:50%; transform:translate(-50%,-50%); z-index:2;"><h1 style="font-size: 45px;">Customer Relationship Management</h1></div>
<div style="position:absolute; top:30%; left: 50%; transform:translate(-50%,-50%); z-index:2;"><h3>Your One Stop For Managing Customer Relations</h3></div>
<div class="card bg-light mb-3" style="position:absolute; top:60%; left:50%; transform:translate(-50%,-50%); z-index:2; width:35%; height:40%;">
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
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Username" placeholder="Enter Username">
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
</div>
</body>
</html>

