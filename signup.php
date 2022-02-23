<?php
require("pdo_dbconnection.php");
session_start();
if ( isset($_POST['F_name']) && isset($_POST['L_name']) && isset($_POST['Gender']) && isset($_POST['Phone_No']) && isset($_POST['bd']) &&
        isset($_POST['br']) && isset($_POST['ad']) && isset($_POST['Username']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass2'])) {

    if (strlen($_POST['F_name']) < 1 || strlen($_POST['L_name']) < 1 || strlen($_POST['Gender']) < 1 || strlen($_POST['Phone_No']) < 1 ||
            strlen($_POST['Username']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 || strlen($_POST['pass2']) < 1 || strlen($_POST['bd']) < 1 || strlen($_POST['br']) < 1 || strlen($_POST['ad']) < 1) {
        $_SESSION['error'] = "Missing Data";
        header("Location: signup.php");
        return;
    }

    if ( $_POST['pass'] !== $_POST['pass2']){
        $_SESSION['error'] = "Passwords don't Match";
        header("Location: signup.php");
        return;
    }
    $sql = "INSERT INTO Salesman (F_Name, L_Name, Gender, Phone_No, Email, Birth_Date, Username, Password,Address,Branch) VALUES (:fname,:lname,:gender,:phone_no,:email, :bd, :username,:password,:ad,:br)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':fname' => $_POST['F_name'],
        ':lname' => $_POST['L_name'],
        ':gender' => $_POST['Gender'],
        ':phone_no' => $_POST['Phone_No'],
        ':email' => $_POST['email'],
        ':bd' => $_POST['bd'],
        ':username' => $_POST['Username'],
        ':password' => $_POST['pass'],
        ':ad' => $_POST['ad'],
        ':br' => $_POST['br']));
    $_SESSION['success'] = 'Sign Up Complete. Please Log In to Continue';
    header('Location: login.php');
    return;
    }
// else {
//     $_SESSION['error'] = "Theres some probem";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css">
    <title>SignUp</title>
</head>

<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
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
            

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                     <label class="form-label" for="firstName">First Name</label>
                    <input type="text" id="firstName" class="form-control form-control-lg" name="F_name" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <label class="form-label" for="lastName">Last Name</label>
                    <input type="text" id="lastName" class="form-control form-control-lg" name="L_name"/>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                     <label class="form-label" for="firstName">Phone Number</label>
                    <input type="number" id="firstName" class="form-control form-control-lg" name="Phone_No" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <label class="form-label" for="lastName">Address</label>
                    <input type="text" id="lastName" class="form-control form-control-lg" name="ad"/>
                  </div>

                </div>
            </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <label class="form7-label" for="lastName">Birth Date</label>
                            <input type="date" id="lastName" class="form-control form-control-lg" name="bd"/>
  
                    </div>
                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <label class="form-label" for="lastName">Gender</label>
                    <input type="text" id="lastName" class="form-control form-control-lg" name="Gender"/>
                    
                  </div>

                </div>
              </div>
                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <label class="form-label" for="emailAddress">Branch</label>
                        <input type="text" id="emailAddress" class="form-control form-control-lg" name="br" />
                        
                    </div>

                    </div>
                </div>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="emailAddress">Username</label>
                    <input type="text" id="emailAddress" class="form-control form-control-lg" name="Username" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="phoneNumber">Email</label>
                    <input type="email" id="phoneNumber" class="form-control form-control-lg" name="email" />
                    
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="emailAddress">Password</label>
                    <input type="password" id="emailAddress" class="form-control form-control-lg" name="pass" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <label class="form-label" for="phoneNumber">Confirm Password</label>
                    <input type="password" id="phoneNumber" class="form-control form-control-lg" name="pass2" />
                    
                  </div>

                </div>
              </div>
              

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Submit"/>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>