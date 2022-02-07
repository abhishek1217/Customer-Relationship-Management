<?php
include "header.html";
require "pdo_dbconnection.php";
session_start();
$date = date("Y-m-d");
$id = $_SESSION['id'];
?>

<html>
    <head>
        <title>Follow Ups</title>
        <link rel="stylesheet" href="FollowUp.css">
    </head>
    <div class="whole-thing">
        <h1>Today's Follow Ups</h1>
        <table id="customers">
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Product/Service</th>
                <th>Action</th>
                <?php
                    $sql = "SELECT * FROM Leads WHERE Salesman_id = :id AND FollowUp_Date = :date ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':id' => $id,
                        ':date' => $date
                    ));
                    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    echo("<tr><td>");
                    echo(htmlentities($row['Name']));
                    echo("</td><td>");
                    echo(htmlentities($row['Phone_No']));
                    echo("</td><td>");
                    echo(htmlentities($row['P_S_Requested']));
                    echo('</td><td>');
                    echo('<button class="convert-button"><a class="convert" href="Convert.php">Convert</a></button>');
                    echo("</td></tr>");
                }
                ?>
        </table>
    </div>
</html>