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
    <h1>Tasks</h1>
    <div class="new-lead">
        <h2>Add Task</h2>
        <form method="post">
            <p class="reg"><label for="Name">Customer Name</label>
            <input type="text" name="Name" class="reg-input"/></p>
            <p class="reg"><label for="Notes">Notes</label>
            <textarea name="Notes">Text Area</textarea></p>
            <p class="reg"><label for="dd">Due Date</label>
            <input type="date" name="dd" class="reg-input"/></p>
            <p class="reg"><label for="Status">Status</label>
            <input type="text" name="Status" class="reg-input"/></p>
            <input class="create-button" type="submit" value="Add">
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
</html>