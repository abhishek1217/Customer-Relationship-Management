<?php
require "pdo_dbconnection.php";
session_start();
$id = $_SESSION['id'];
if ( isset($_POST['ci']) && isset($_POST['Name']) && isset($_POST['pn']) && isset($_POST['dd']) 
        && isset($_POST['ap']) && isset($_POST['Phone_No']) && isset($_POST['Email']) && isset($_POST['Address']) && isset($_POST['ps']) && isset($_POST['Status']) && isset($_POST['invoice-id'])) {

    // Data validation
    if ( strlen($_POST['ci']) < 1 || strlen($_POST['Name']) < 1 || strlen($_POST['pn']) < 1 || strlen($_POST['dd']) < 1
        || strlen($_POST['ap']) < 1 || strlen($_POST['Phone_No']) < 1 || strlen($_POST['Email']) < 1 || strlen($_POST['Address']) < 1 || strlen($_POST['ps']) < 1 || strlen($_POST['Status']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Orders.php");
        return;
    }

    $sql = "UPDATE Invoice SET Customer_id = :cid,Salesman_id = :id,Customer_Name=:name,Product_Name=:pn,Shipping_Date=:dd,
                    Amount_Paid=:ap,Phone_No=:phone,Email=:email,Shipping_Address=:sa,Payment_Status=:ps,Processing_Status=:process WHERE Invoice_id=:id2";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':cid' => $_POST['ci'],
        ':id' => $id,
        ':name' => $_POST['Name'],
        ':pn' => $_POST['pn'],
        ':dd' => $_POST['dd'],
        ':ap' => $_POST['ap'],
        ':phone' => $_POST['Phone_No'],
        ':email' => $_POST['Email'],
        ':sa' => $_POST['Address'],
        ':ps' => $_POST['ps'],
        ':process' => $_POST['Status'],
        ':id2' => $_POST['invoice-id']));
    $_SESSION['success'] = 'Invoice Updated';
    header('Location: Orders.php');
    return;
}

?>

<html>
    <head>
        <title>Update Orders</title>
        <link rel="stylesheet" href="Orders.css">
    </head>
    <body>
        <?php
    $sql = "SELECT * FROM Invoice WHERE Salesman_id = :id and Invoice_id = :id2";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id,':id2' => $_GET['invoice-id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC)
    ?>
    <div class="whole-thing">
        <div class="new-lead">
            <h2>Generate Invoice</h2>
            <div class="container">
                <form method="post">
                <div class="row">
                    <div class = "col-25">
                        <label for="ci">Customer Id</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="ci" class="reg-input" value="<?=$row['Customer_id']?>"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Name">Customer Name</label>
                    </div>
                        <div class="col-75">    
                            <input type="text" name = "Name" class="reg-input" value="<?=$row['Customer_Name']?>"/>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-25">
                        <label for="pn">Product Name</label>
                    </div>
                        <div class="col-75">
                            <input type="text" name = "pn" class="reg-input" value="<?=$row['Product_Name']?>"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="dd">Shippping Date</label>
                    </div>
                        <div class="col-75">
                            <input type="date" name="dd" class="reg-input" value="<?=$row['Shipping_Date']?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ap">Amount Paid</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="ap" class="reg-input" value="<?=$row['Amount_Paid']?>"/>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Phone_No">Phone No</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="Phone_No" class="reg-input" value="<?=$row['Phone_No']?>"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Email">Email</label>
                    </div>      
                        <div class="0.75">
                            <input type="email" name="Email" class="reg-input" value="<?=$row['Email']?>"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="Address">Shipping Address</label>
                    </div>
                        <div class="col-75">
                    <textarea name="Address"><?=$row['Shipping_Address']?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="ps">Payment Status</label>
                    </div>
                        <div class="col-75">
                    <input type="text" name="ps" class="reg-input" value="<?=$row['Payment_Status']?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="Status">Processing Status</label>
                    </div>
                        <div class="col-75">
                    <input type="text" name="Status" class="reg-input" value="<?=$row['Processing_Status']?>"/>
                    </div>
                </div>
                    <div class="col-75">
                    <input type="hidden" name="invoice-id" class="reg-input" value="<?=$row['Invoice_id']?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <input class="create-button" type="submit" value="Update">
                </div>
                <div class="row">
                    <div class="col-25">
                    <button class="convert-button"><a class="convert" href="Orders.php">Cancel</a></button>
                </div>
                </form>
            </div>
        </div> 
</div>
</body>
</html>