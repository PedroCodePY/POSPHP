<?php
session_start();
if (!isset($_SESSION['Username'])) {
  header("location:login.php");
  exit;
} else {
  $shopname = $_SESSION['ShopName'];
  $shopcode = $_SESSION['ShopCode'];
  $shopcodefixed = preg_replace("/[^a-zA-Z0-9_]/", "", $shopcode);
  $shopowner = $_SESSION['Username'];
  $shoplocation = $_SESSION['ShopLocation'];
  $shopostalcode = $_SESSION['ShopPostalCode'];
  $shoplogo = $_SESSION['ShopLogo'];
  $conn = mysqli_connect("localhost", "root", "", "pos_app");
  $sql = "INSERT INTO shoplist (ShopName, ShopCode, ShopOwner, ShopLocation, ShopPostalCode, ShopLogo) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssssss", $shopname, $shopcodefixed, $shopowner, $shoplocation, $shopostalcode, $shoplogo);
  $query = mysqli_stmt_execute($stmt);
  $tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopcode . "_users");
  $tableNameD = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopcode . "_transaction");
  $tableNameY = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopcode . "_product");
  $sqlc = "CREATE TABLE `$tableName` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(500) NOT NULL,
    `Username` VARCHAR(100) NOT NULL,
    `Password` VARCHAR(100) NOT NULL,
    `ProfilePicture` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`ID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
  $sqld = "CREATE TABLE `$tableNameD` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `Name` varchar(500) NOT NULL,
    `Product` varchar(500) NOT NULL,
    `TransactionType` varchar(50) NOT NULL,
    `TransactionDate` datetime NOT NULL,
    `Status` varchar(100) NOT NULL,
    `Price` int(11) NOT NULL,
    PRIMARY KEY (`ID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  $sqly = "CREATE TABLE `$tableNameY` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `ProductName` varchar(500) NOT NULL,
    `Quantity` int(11) NOT NULL,
    `Price` int(11) NOT NULL,
    `ProductImage` varchar(500) NOT NULL,
    `Rate` float NOT NULL,
    PRIMARY KEY (`ID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  $query1 = mysqli_query($conn, $sqlc);
  $query2 = mysqli_query($conn, $sqld);
  $query3 = mysqli_query($conn, $sqly);
  unset($_SESSION['ShopName']);
  unset($_SESSION['ShopCode']);
  unset($_SESSION['ShopLocation']);
  unset($_SESSION['ShopPostalCode']);
  unset($_SESSION['ShopLogo']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Shop</title>
  <meta http-equiv="refresh" content="15; URL='../Code/Dashboard.php'">
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