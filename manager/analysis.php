<?php
include "header.html";
include "pdo_dbconnection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Analysis</title>
</head>
<body>
    <div class="whole-thing" style="margin-left: 200px; margin-right: 50px;">
    <center><h1 style="margin-top: 20px; padding: 10px; margin-bottom: 5px;">Brief Analysis</h1></center>
<div class="row" style="margin: 20px;">
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
        <h4 class="card-title" style="padding: 10px;">Revenue Generated</h4>
        <hr/>
        <table class="table table-borderless table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Salesman</th>
        <th>Revenue</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sql = $pdo->query("SELECT S.Salesman_id, S.F_Name, S.L_Name, SUM(I.Amount_Paid) AS Revenue FROM salesman S, invoice I WHERE S.Salesman_id = I.Salesman_id and I.Payment_Status = 'Done' and I.Processing_Status = 'Done' GROUP BY S.F_Name");
        while ( $row = $sql->fetch(PDO::FETCH_ASSOC) ) {
            echo("<tr><td>");
            echo($row['Salesman_id']);
            echo("</td><td>");
            echo($row['F_Name']." ".$row['L_Name']);
            echo("</td><td>");
            echo($row['Revenue']);
            echo("</td></tr>");
        }
      ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
        <h4 class="card-title" style="padding: 10px;">Products Sold</h4>
        <hr/>
        <table class="table table-borderless table-sm">
    <thead>
      <tr>
        <th>Product</th>
        <th>Sold</th>
        <th>Revenue</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sql = $pdo->query("Select count(Product_Name) AS countP, Product_name, Amount_Paid From Invoice Where Payment_Status = 'Done' and Processing_Status = 'Done' Group By Product_Name");
        while ( $row = $sql->fetch(PDO::FETCH_ASSOC) ) {
            echo("<tr><td>");
            echo($row['Product_name']);
            echo("</td><td>");
            echo($row['countP']);
            echo("</td><td>");
            echo($row['Amount_Paid']);
            echo("</td></tr>");
        }
      ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin: 20px;">
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
    <h4 class="card-title" style="padding: 10px;">Leads</h4>
    <hr/>
        <table class="table table-borderless table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number of Leads</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = $pdo->query("SELECT COUNT(*) AS Number_Of_Leads, S.F_Name, S.L_Name,S.Salesman_id From salesman S , leads L WHERE S.Salesman_id = L.Salesman_id GROUP BY S.Salesman_id");
        while ( $row = $sql->fetch(PDO::FETCH_ASSOC) ) {
            echo("<tr><td>");
            echo($row['Salesman_id']);
            echo("</td><td>");
            echo($row['F_Name']." ".$row['L_Name']);
            echo("</td><td>");
            echo($row['Number_Of_Leads']);
            echo("</td></tr>");
        }
      ?>
    </tbody>
  </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
        <h4 class="card-title" style="padding: 10px;">Customers</h4>
        <hr/>
        <table class="table table-borderless table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number of Customers</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = $pdo->query("SELECT COUNT(*) AS No, S.F_Name, S.L_Name,S.Salesman_id From salesman S , Customer C WHERE S.Salesman_id = C.Salesman_id GROUP BY S.Salesman_id");
        while ( $row = $sql->fetch(PDO::FETCH_ASSOC) ) {
            echo("<tr><td>");
            echo($row['Salesman_id']);
            echo("</td><td>");
            echo($row['F_Name']." ".$row['L_Name']);
            echo("</td><td>");
            echo($row['No']);
            echo("</td></tr>");
        }
      ?>
    </tbody>
  </table>
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin: 20px;">
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
        <h4 class="card-title" style="padding: 10px;">Total Customers</h4>
        <hr/>
      <?php
        $sql = $pdo->query("SELECT COUNT(*) AS Count From Customer");
        $row = $sql->fetch(PDO::FETCH_ASSOC);
      ?>
      </br>
        <h4><?php echo $row['Count'] ?></h4>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card bg-light">
      <div class="card-body text-center">
        <h4 class="card-title" style="padding: 10px;">Total Leads</h4>
        <hr/>
      <?php
        $sql = $pdo->query("SELECT COUNT(*) AS Count From Leads");
        $row = $sql->fetch(PDO::FETCH_ASSOC);
      ?>
      </br>
            <h4><?php echo $row['Count'] ?></h4>
      </div>
    </div>
  </div>
</div>
    </div>
</body>
</html>