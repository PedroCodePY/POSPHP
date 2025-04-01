<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
} else {
    $productname = $_SESSION['ProductName'];
    $productimage = $_SESSION['ProductImage'];
    $productprice = $_SESSION['Price'];
    $productquantity = $_SESSION['Quantity'];
    $shopname = $_SESSION['StoreName'];
    $conn = mysqli_connect("localhost", "root", "", "pos_app");
    $shopname = $_SESSION['Store'];
    $tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_product");
    $sql = "INSERT INTO `$tableName` (ProductName, Quantity, Price, ProductImage) VALUES ('$productname', '$productquantity', '$productprice', '$productimage')";
    $sql2 = "INSERT INTO menupos (Name, Price, Image, Shop, Quantity) VALUES ('$productname', '$productprice', '$productimage', '$shopname', '$productquantity')";
    $query1 = mysqli_query($conn, $sql);
    $query2 = mysqli_query($conn, $sql2);
    unset($_SESSION['ProductName']);
    unset($_SESSION['ProductImage']);
    unset($_SESSION['Price']);
    unset($_SESSION['Quantitu']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Shop</title>
    <meta http-equiv="refresh" content="15; URL='../Menu/Productok.php'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/ShopRegist.css">
    <link rel="icon" type="image/icon" href="../Asset/Logo.ico" />
</head>

<body>
    <div class="main">
        <div class="uploudbody">
            <center>
                <div class="spinner-grow text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <br>
                <h3>Please wait, creating shop data</h3>
            </center>
        </div>
    </div>
    <script src="../Javascript/S2SR.js"></script>
</body>

</html>