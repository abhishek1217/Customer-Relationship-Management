<?php
include "header.html";
require "pdo_dbconnection.php";
session_start();
$id = $_SESSION['id'];
$date = date("Y-m-d");
if ( isset($_POST['Name']) && isset($_POST['Notes']) && isset($_POST['dd']) && isset($_POST['Status']) ) {
    // Data validation
    if ( strlen($_POST['Name']) < 1 || strlen($_POST['Notes']) < 1 || strlen($_POST['dd']) < 1 || strlen($_POST['Status']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Tasks.php");
        return;
    }

    $sql = "INSERT INTO Tasks ( Salesman_id, Customer_Name, Notes, Due_Date, Status, Date_Created) VALUES (:id, :name, :notes, :dd, :status, :dc)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $id,
        ':name' => $_POST['Name'],
        ':notes' => $_POST['Notes'],
        ':dd' => $_POST['dd'],
        ':status' => $_POST['Status'],
        ':dc' => $date));
    $_SESSION['success'] = 'Task Added';
    header('Location: Tasks.php');
    return;
}
?>

<html>
    <head>
        <title>Tasks</title>
        <link rel="stylesheet" href="Tasks.css">
    </head>
    <body>
    <h1>Tasks</h1>
    <div class="new-lead">
        <h2>Add Task</h2>
        <form method="post">
            <div class="row">
                <div class="col-25">
                    <label for="Name">Customer Name</label>
                </div>
                <div class="col-75">
                    <input type="text" name="Name" class="reg-input"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="Notes">Notes</label>
                </div>
                <div class="col-75">
                    <textarea name="Notes">Text Area</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="dd">Due Date</label>
                </div>
                <div class="col-75">
                    <input type="date" name="dd" class="reg-input"/> 
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="Status">Status</label>
                </div>
                <div class="col-75">
                    <input type="text" name="Status" class="reg-input"/>
                </div>
            </div>
            <br>
                <div class="row">
                    <input class="create-button" type="submit" value="Add">
                </div>
        </form>
    </div>

    <h1>Your Tasks</h1>
    <div class="table">
    <table id="customers">
    <tr>
    <th>Customer Name</th>
    <th>Notes</th>
    <th>Due Date</th>
    <th>Status</th>
    <th>Date Created</th>
    <?php
    $stmt = $pdo->query("SELECT * From Tasks");
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo("<tr><td>");
        echo(htmlentities($row['Customer_Name']));
        echo("</td><td>");
        echo(htmlentities($row['Notes']));
        echo("</td><td>");
        echo(htmlentities($row['Due_Date']));
        echo("</td><td>");
        echo(htmlentities($row['Status']));
        echo('</td><td>');
        echo(htmlentities($row['Date_Created']));
        echo("</td></tr>");
    }
    ?>
    </table>
    </div>
</body>
</html>