<?php
include "header.html";
session_start();
require "pdo_dbconnection.php";
if ( isset($_POST['Name']) && isset($_POST['Price'])
     && isset($_POST['Demand']) && isset($_POST['UA']) ) {

    // Data validation
    if ( strlen($_POST['Name']) < 1 || strlen($_POST['Price']) < 1 || strlen($_POST['Demand']) < 1 || strlen($_POST['UA']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: Products.php");
        return;
    }

    $sql = "INSERT INTO Products ( Name, Price, Demand, Units_is)
              VALUES (:name, :price, :d, :ua)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['Name'],
        ':price' => $_POST['Price'],
        ':d' => $_POST['Demand'],
        ':ua' => $_POST['UA']));
    $_SESSION['success'] = 'Product Added';
    header('Location: Products.php');
    return;
}
?>

<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="Products.css">
    </head>
    <body>
        <div class="whole-thing">
    <div class="new-lead">
        <h2 class="add-text">Add a New Product</h2>
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
                            <label for="Price">Price</label>
                        </div>
                            <div class="col-75">
                                <input type="number" name="Price" class="reg-input"/>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="Demand">Demand</label>
                        </div>
                            <div class="col-75">
                                <input type="text" name="Demand" class="reg-input"/>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="UA">Units Available</label>
                        </div>
                            <div class="col-75">
                                <input type="number" name="UA" class="reg-input"/>
                            </div>
                    </div>
                    <br>
                    <div class="row">
                        <input class="create-button" type="submit" value="Add">
                    </div>
        </div>
        </form>
    </div>
    
    <h1>Products</h1>
    <div class="table">
    <table id="customers">
    <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Demand</th>
    <th>Units Available</th>
    <?php
    $stmt = $pdo->query("SELECT * From Products");
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        echo("<tr><td>");
        echo(htmlentities($row['Name']));
        echo("</td><td>");
        echo(htmlentities($row['Price']));
        echo("</td><td>");
        echo(htmlentities($row['Demand']));
        echo('</td><td>');
        echo(htmlentities($row['Units_is']));
        echo("</td></tr>");
    }
    ?>
    </table>
    </div>
</div>
</body>
</html>