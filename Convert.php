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
    <form method="post">
            <p class="reg"><label for="Name">Name</label>
            <input type="text" name="Name" class="reg-input"/></p>
            <p class="reg"><label for="Gender">Gender</label>
            <input type="text" name="Gender" class="reg-input"/></p>
            <p class="reg"><label for="Product">Product Requested</label>
            <input type="text" name="Product" class="reg-input"/></p>
            <p class="reg"><label for="Phone_No">Phone_No</label>
            <input type="number" name="Phone_No" class="reg-input"/></p>
            <p class="reg"><label for="Email">Email</label>
            <input type="text" name="Email" class="reg-input"/></p>
            <p class="reg"><label for="AP">Amount Paid</label>
            <input type="number" name="AP" class="reg-input"/></p>
            <input class="create-button" type="submit" value="Convert">
        </form>
    </body>
</html>