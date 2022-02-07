<?php
include "header.html";
require "pdo_dbconnection.php";
session_start();
$id = $_SESSION['id'];
if ( isset($_POST['ci']) && isset($_POST['Name']) && isset($_POST['pn']) && isset($_POST['dd']) 
        && isset($_POST['ap']) && isset($_POST['Phone_No']) && isset($_POST['Email']) && isset($_POST['Address']) && isset($_POST['ps']) && ($_POST['Status'])) {

    // Data validation
    if ( strlen($_POST['ci']) < 1 || strlen($_POST['Name']) < 1 || strlen($_POST['pn']) < 1 || strlen($_POST['dd']) < 1
        || strlen($_POST['ap']) < 1 || strlen($_POST['Phone_No']) < 1 || strlen($_POST['Email']) < 1 || strlen($_POST['Address']) < 1 || strlen($_POST['ps']) < 1 || strlen($_POST['Status']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Orders.php");
        return;
    }

    $sql = "INSERT INTO Invoice (Customer_id, Salesman_id, Customer_Name, Product_Name, Shipping_Date, Amount_Paid, Phone_No, Email, Shipping_Address, Payment_Status, Processing_Status)
              VALUES (:cid, :id, :name,:pn,:sd,:ap,:phone,:email,:sa,:ps,:process)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':cid' => $_POST['ci'],
        ':id' => $id,
        ':name' => $_POST['Name'],
        ':pn' => $_POST['pn'],
        ':sd' => $_POST['dd'],
        ':ap' => $_POST['ap'],
        ':phone' => $_POST['Phone_No'],
        ':email' => $_POST['Email'],
        ':sa' => $_POST['Address'],
        ':ps' => $_POST['ps'],
        ':process' => $_POST['Status']));
    $_SESSION['success'] = 'Invoice Generated';
    header('Location: Orders.php');
    return;
}

?>

<html>
    <head>
        <title>Orders</title>
        <link rel="stylesheet" href="Orders.css">
    </head>
    <body>
    <div class="whole-thing">
        <h1>Orders</h1>
        <div class="new-lead">
            <h2>Generate Invoice</h2>
            <?php
            if(isset($_SESSION['success']))
            {
            ?>
            <div class="message">
                <h3><strong>Success! </strong><strong><?php echo $_SESSION['success'];?></strong></h3>
            </div>
            <?php
            }
            unset($_SESSION['success']);
            if(isset($_SESSION['error']))
            {
            ?>
            <div class="message">
                <h3><strong>Error! </strong> <?php echo $_SESSION['error']; ?></h3>
            </div>
            <?php
            }
            unset($_SESSION['error']);
            ?>
            <div class="container">
                <form method="post">
                <div class="row">
                    <div class = "col-25">
                        <label for="ci">Customer Id</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="ci" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Name">Customer Name</label>
                    </div>
                        <div class="col-75">    
                            <input type="text" name = "Name" class="reg-input"/>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-25">
                        <label for="pn">Product Name</label>
                    </div>
                        <div class="col-75">
                            <input type="text" name = "pn" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="dd">Shippping Date</label>
                    </div>
                        <div class="col-75">
                            <input type="date" name="dd" class="reg-input"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ap">Amount Paid</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="ap" class="reg-input"/>
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
                        <div class="0.75">
                            <input type="email" name="Email" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="Address">Shipping Address</label>
                    </div>
                        <div class="col-75">
                    <textarea name="Address"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="ps">Payment Status</label>
                    </div>
                        <div class="col-75">
                    <input type="text" name="ps" class="reg-input"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="Status">Processing Status</label>
                    </div>
                        <div class="col-75">
                    <input type="text" name="Status" class="reg-input"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <input class="create-button" type="submit" value="Generate">
                    </div>
                </form>
            </div>
        </div>
        <div class="table">
            <h1>All Orders</h1>
            <table id="customers">
                <tr>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Shipping Date</th>
                <th>Amount Paid</th>
                <th>Shipping Address</th>
                <th>Payment Status</th>
                <th>Processing Status</th>
                <th>Action</th>

                <?php
                $sql = "SELECT * FROM Invoice WHERE Salesman_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    echo("<tr><td>");
                    echo(htmlentities($row['Customer_Name']));
                    echo("</td><td>");
                    echo(htmlentities($row['Product_Name']));
                    echo('</td><td>');
                    echo(htmlentities($row['Shipping_Date']));
                    echo('</td><td>');
                    echo(htmlentities($row['Amount_Paid']));
                    echo('</td><td>');
                    echo(htmlentities($row['Shipping_Address']));
                    echo('</td><td>');
                    echo(htmlentities($row['Payment_Status']));
                    echo('</td><td>');
                    echo(htmlentities($row['Processing_Status']));
                    echo('</td><td>');
                    echo('<button class="convert-button"><a class="convert" href="Convert.php">Update</a></button>');
                    echo("</td></tr>");
                }
                ?>
            </table>
        </div>
    </div>
    <h3><?php print_r($_SESSION) ?></h3>
</body>
</html>