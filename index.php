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
  <div class="card-header"><h3><strong><center>Login</center></strong><h3/></div>
  <div class="card-body">
  <form>
  <div class="form-group">
      
    <label for="exampleInputEmail1" style="margin-bottom: 5px;">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <br/>
  <div class="form-group">
    <label for="exampleInputPassword1" style="margin-bottom: 5px;">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <br/>
  <center><button type="submit" class="btn btn-dark">Submit</button></center>
</form>
  </div>
</div>
<a href="signup.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" style="position:absolute; top:90%; left:50%; transform:translate(-50%,-50%); z-index:2;">Register/Sign Up</a>
</div>
</body>
</html>

