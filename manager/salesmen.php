<?php
include "header.html";
include "pdo_dbconnection.php";
session_start();
$date = date("Y-m-d");
if ( isset($_POST['id']) && isset($_POST['Name']) && isset($_POST['Notes']) && isset($_POST['dd']) && isset($_POST['Status']) ) {
    // Data validation
    if ( strlen($_POST['id']) < 1 || strlen($_POST['Name']) < 1 || strlen($_POST['Notes']) < 1 || strlen($_POST['dd']) < 1 || strlen($_POST['Status']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Tasks.php");
        return;
    }

    $sql = "INSERT INTO Tasks ( Salesman_id, Customer_Name, Notes, Due_Date, Status, Date_Created) VALUES (:id, :name, :notes, :dd, :status, :dc)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $_POST['id'],
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
    <title>Salesmen</title>
    <link rel="stylesheet" href="salesmen.css">
    </head>
    <div class="whole-thing">
    <div class="new-lead">
                <h2 class="add-text">Add Task for Salesman</h2>
                <?php
                    if(isset($_SESSION['success']))
                    {
                    ?>
                    <div class="message">
                        <strong style="color: green;">Success! </strong><strong><?php echo $_SESSION['success'];?></strong>
                    </div>
                    <?php
                    }
                    unset($_SESSION['success']);
                    if(isset($_SESSION['error']))
                    {
                    ?>
                    <div class="message">
                        <strong style="color: red;">Error! </strong> <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php
                    }
                    unset($_SESSION['error']);
                ?>
                <div class="container">
                    <form method="post">
                        <div class="row">
                            <div class="col-25">
                            <label for="id">Salesman ID</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="id" class="reg-input"/>
                        </div>
                        </div>
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
                            <textarea name="Notes" placeholder="Notes"></textarea>
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
            </div>
        <h1>All Salesmen</h1>
        <div class="table">
            <table id="customers">
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone NO</th>
                <th>Email</th>
                <th>Address</th>
                <th>Branch</th>
                <?php
                $stmt = $pdo->query("SELECT * From Salesman");
                while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    echo("<tr><td>");
                    echo($row['Salesman_id']);
                    echo("</td><td>");
                    echo($row['F_Name']." ".$row['L_Name']);
                    echo("</td><td>");
                    echo($row['Gender']);
                    echo('</td><td>');
                    echo($row['Phone_No']);
                    echo('</td><td>');
                    echo($row['Email']);
                    echo('</td><td>');
                    echo($row['Address']);
                    echo('</td><td>');
                    echo($row['Branch']);
                    echo('</td><tr>');
                }
                ?>
            </table>
        </div>
    </div>
</html>