<?php
include "pdo_dbconnection.php";
session_start();
$id = $_SESSION['id'];
if ( isset($_POST['Name']) && isset($_POST['Product']) && isset($_POST['Gender']) && isset($_POST['Phone_No']) &&
        isset($_POST['AP']) && isset($_POST['Email'])) {

    if (strlen($_POST['Name']) < 1 || strlen($_POST['Product']) < 1 || strlen($_POST['Gender']) < 1 || strlen($_POST['Phone_No']) < 1 ||
            strlen($_POST['AP']) < 1 || strlen($_POST['Email']) < 1) {
        $_SESSION['error'] = "Missing Data";
        header("Location: Convert.php");
        return;
    }
    $sql = "INSERT INTO Customer (Salesman_id, Customer_Name, Gender, S_P_Provided, Phone_No, Email, Amount_Paid) VALUES (:id,:name,:gender,:product,:phone_no,:email,:amt)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $id,
        ':name' => $_POST['Name'],
        ':gender' => $_POST['Gender'],
        ':product' => $_POST['Product'],
        ':phone_no' => $_POST['Phone_No'],
        ':email' => $_POST['Email'],
        ':amt' => $_POST['AP']));
    $_SESSION['success'] = 'One Happy Customer Added';
    header('Location: Leads.php');
    return;
    }
?>

<html>
    <head>
        <title>Convert</title>
        <link rel="stylesheet" href="Convert.css">
    </head>
    <body>
    <?php
    if(isset($_SESSION['error']))
    {
    ?>
    <div class="message">
        <strong>Error! </strong> <?php echo $_SESSION['error']; ?>
    </div>
    <?php
    }
    unset($_SESSION['error']);
    ?>
    <div class="whole-thing">
        <div class="new-lead">
            <div class="container">
            <form method="post">
                        <div class="row">
                            <div class = "col-25">
                                <label for="Name">Name</label>
                            </div>
                                <div class="col-75">
                                    <input type="text" name="Name" class="reg-input"/>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="Gender">Gender</label>
                            </div>
                                <div class="col-75">
                                    <input type="text" name="Gender" class="reg-input"/>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="Product">Product Requested</label>
                            </div>
                                <div class="col-75">
                                    <input type="text" name="Product" class="reg-input"/>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="Phone_No">Phone No</label>
                            </div>
                                <div class="col-75">
                                    <input type="number" name="Phone_No" class="reg-input"/>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="Email">Email</label>
                            </div>
                                <div class="col-75">
                                    <input type="email" name="Email" class="reg-input"/>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="AP">Amount Paid</label>
                            </div>
                                <div class="col-75">
                                    <input type="number" name="AP" class="reg-input"/>
                                </div>
                        </div>
                        <br>
                        <div class="row">
                            <input class="create-button" type="submit" value="Convert">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>