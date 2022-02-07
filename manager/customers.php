<?php
include "header.html";
include "pdo_dbconnection.php";
session_start();
?>

<html>
    <head>
    <title>Customers</title>
    <link rel="stylesheet" href="Customers.css">
    </head>
    <div class="whole-thing">
        <h1>Here are all the Customers</h1>
        <div class="table">
            <table id="customers">
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Product Purchased</th>
                <th>Phone_No</th>
                <th>Email</th>
                <th>Amount_Paid</th>
                <?php
                $stmt = $pdo->query("SELECT * From Customer");
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
                    echo('</td><tr>');
                }
                ?>
            </table>
        </div>
    </div>
</html>