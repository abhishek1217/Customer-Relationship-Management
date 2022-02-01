<?php
include "header.html";
include "pdo_dbconnection.php";
session_start();
$fname = $_SESSION['FirstName'];
$lname = $_SESSION['LastName'];
$id = $_SESSION['id'];
if ( isset($_POST['Name']) && isset($_POST['Phone_No'])
     && isset($_POST['Product']) && isset($_POST['Priority']) && isset($_POST['FollowUp'])) {

    // Data validation
    if ( strlen($_POST['Name']) < 1 || strlen($_POST['Phone_No']) < 1 || strlen($_POST['Product']) < 1 || strlen($_POST['Priority']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Leads.php");
        return;
    }

    $sql = "INSERT INTO Leads (Salesman_id, Phone_No, Name, P_S_Requested, Priority, FollowUp_Date)
              VALUES (:id, :ph, :name, :prod, :priority, :followup)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $id,
        ':ph' => $_POST['Phone_No'],
        ':name' => $_POST['Name'],
        ':prod' => $_POST['Product'],
        ':priority' => $_POST['Priority'],
        ':followup' => $_POST['FollowUp']));
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
<body>
    <div class="whole-thing">
    <h1>Welcome <?php echo $fname . " " . $lname?> </h1>
    <div class="new-lead">
        <h2 class="add-text">Add New Lead</h2>
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
                    <div class = "col-25">
                        <label for="Name">Name</label>
                    </div>
                        <div class="col-75">
                            <input type="text" name="Name" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Phone_No">Phone Number</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="Phone_No" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Product">Product Requested</label>
                    </div>
                        <div class="col-75">
                            <input type="text" name="Product" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="Priority">Priority</label>
                    </div>
                        <div class="col-75">
                            <input type="number" name="Priority" class="reg-input"/>
                        </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="FollowUp">FollowUp Date</label>
                    </div>
                        <div class="col-75">
                            <input type="date" name="FollowUp" class="reg-input"/>
                        </div>
                </div>
                <br>
                <div class="row">
                    <input class="create-button" type="submit" value="Add">
                </div>
            </form>
        </div>
    </div>
    <div class="table">
    <h2>Your Leads</h2>
    <table id="customers">
    <tr>
    <th>Name</th>
    <th>Phone Number</th>
    <th>Product/Service</th>
    <th>Priority</th>
    <th>Follow Up</th>
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
        echo(htmlentities($row['FollowUp_Date']));
        echo('</td><td>');
        echo('<button class="convert-button"><a class="convert" href="Convert.php">Convert</a></button>');
        echo("</td></tr>");
    }
    ?>
    </div>
</table>
    </div>
</body>
</html>
