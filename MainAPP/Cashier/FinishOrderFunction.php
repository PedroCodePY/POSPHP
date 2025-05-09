<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pos_app");

$code = $_SESSION['BuyerCode'];
$time = $_SESSION['Time'];
$sn = $_SESSION['ShopName2'];
$sc = $_SESSION['ShopCode2'];
$table = "shop_" . $sc . "_transaction";
$table2 = "shop_" . $sc . "_product";

// Insert master transaction record
$sql = "INSERT INTO `transaction`(`TransactionCode`, `Time`, `Type`, `Store`, `Status`) VALUES ('$code','$time','Cashier','$sn', 'Done')";
$query = mysqli_query($conn, $sql);

// Process all order items
foreach ($_SESSION['OrderDetail'] as $order) {
    $p = $order['Item'];
    $q = $order['Quantity'];
    $pr = $order['totalPrice']; // fixed typo

    // Insert transaction details
    $sql2 = "INSERT INTO `$table`(`TransactionCode`, `Product`, `TransactionType`, `TransactionDate`, `Status`, `Price`, `Quantity`) 
             VALUES ('$code','$p','Cashier','$time','Finish','$pr', '$q')";

    // Update stock (IMPORTANT: no quotes around Quantity - $q)
    $sql3 = "UPDATE `$table2` SET `Quantity` = Quantity - $q WHERE `ProductName` = '$p'";

    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);
}

// After all orders processed, redirect once
header("location:FinishOrder.php");
exit();
