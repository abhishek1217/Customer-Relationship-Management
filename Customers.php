<?php
include "header.html";
include "pdo_dbconnection.php";
session_start();
$id = $_SESSION['id'];
?>

<html>
    <head>
    <title>Customers</title>
    <link rel="stylesheet" href="Customers.css">
    </head>
    <h1>Here are your Customers</h1>
    <div class="table">
    <h1>A Fancy Table</h1>
    <table id="customers">
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Product Purchased</th>
    <th>Phone_No</th>
    <th>Email</th>
    <th>Amount_Paid</th>
    <th>Action</th>
    <?php
    $sql = "SELECT * FROM Customer WHERE Salesman_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo("<tr><td>");
        echo($row['Customer_id']);
        echo("</td><td>");
        echo($row['Customer_Name']);
        echo("</td><td>");
        echo($row['Gender']);
        echo('</td><td>');
        echo($row['S_P_Provided']);
        echo('</td><td>');
        echo($row['Phone_No']);
        echo('</td><td>');
        echo($row['Email']);
        echo('</td><td>');
        echo($row['Amount_Paid']);
        echo('</td><td>');
        echo('<a href="Edit_Customer.php">Edit</a>');
        echo("</td></tr>");
    }
    print_r($_SESSION);
    ?>
    </div>
    </table>
    </div>
</html>