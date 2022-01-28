<?php
require "pdo_dbconnection.php";
echo"Hello World";
$un = 'abhishek95381';
$ps = '95381';
$sql = "SELECT Username, Password From Salesman Where Username= :un and Password = :ps";
$stmt = $pdo->prepare($sql);
$stmt->execute([':un' => $un,':ps' => $ps]);

$row = $stmt->fetchALL(PDO::FETCH_ASSOC);
print_r($row);
echo "The change is happening";
// echo "Username: ".$row['Username'];
// echo "Password: ".$row['Password'];

?>