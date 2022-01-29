<?php
include "header.html";
include "pdo_dbconnection.php";
session_start();
$fname = $_SESSION['FirstName'];
$lname = $_SESSION['LastName'];
$id = $_SESSION['id'];
if ( isset($_POST['Name']) && isset($_POST['Phone_No'])
     && isset($_POST['Product']) && isset($_POST['Priority'])) {

    // Data validation
    if ( strlen($_POST['Name']) < 1 || strlen($_POST['Phone_No']) < 1 || strlen($_POST['Product']) < 1 || strlen($_POST['Priority']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Leads.php");
        return;
    }

    $sql = "INSERT INTO Leads (Salesman_id, Phone_No, Name, P_S_Requested, Priority)
              VALUES (:id, :ph, :name, :prod, :priority)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $id,
        ':ph' => $_POST['Phone_No'],
        ':name' => $_POST['Name'],
        ':prod' => $_POST['Product'],
        ':priority' => $_POST['Priority']));
    $_SESSION['success'] = 'Lead Created';
    header('Location: Leads.php');
    return;
}
?>

<html>
<head>
    <title>Leads</title>
    <link rel="stylesheet" href="Leads.css">
</head>
    <div class="whole-thing">
    <h1>Welcome <?php echo $fname . " " . $lname?> </h1>
    <?php
        if(isset($_SESSION['success']))
        {
        ?>
        <div class="message">
            <strong>Success! </strong><strong><?php echo $_SESSION['success'];?></strong>
        </div>
        <?php
        }
        unset($_SESSION['success']);
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
    <div class="new-lead">
        <h2>New Lead</h2>
        <form method="post">
            <p class="reg"><label for="Name">Name</label>
            <input type="text" name="Name" class="reg-input"/></p>
            <p class="reg"><label for="Phone_No">Phone Number</label>
            <input type="number" name="Phone_No" class="reg-input"/></p>
            <p class="reg"><label for="Product">Product Requested</label>
            <input type="text" name="Product" class="reg-input"/></p>
            <p class="reg"><label for="Priority">Priority</label>
            <input type="number" name="Priority" class="reg-input"/></p>
            <input class="create-button" type="submit" value="Create">
        </form>
    </div>
    <div class="table">
    <h1>A Fancy Table</h1>
    <table id="customers">
    <tr>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Product/Service</th>
    <th>Priority</th>
    <th>Action</th>
    <?php
    $sql = "SELECT * FROM Leads WHERE Salesman_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo("<tr><td>");
        echo(htmlentities($row['Name']));
        echo("</td><td>");
        echo(htmlentities($row['Phone_No']));
        echo("</td><td>");
        echo(htmlentities($row['P_S_Requested']));
        echo('</td><td>');
        echo(htmlentities($row['Priority']));
        echo('</td><td>');
        echo('<a href="Convert.php">Convert</a>');
        echo("</td></tr>");
    }
    print_r($_SESSION);
    ?>
    </div>
</table>
    </div>
</html>
