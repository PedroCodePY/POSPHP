<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
$db = mysqli_connect('localhost', 'root', '', 'pos_app');
$shopname = $_SESSION['Store'];
$tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_product");
function usernameExists($db, $SN, $tableName)
{
    $sql = "SELECT COUNT(*) FROM `$tableName` WHERE ProductName = '$SN'";
    $result = mysqli_query($db, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $count = $row[0];
        return $count > 0;
    } else {
        error_log("Database query error: " . mysqli_error($db));
        return false;
    }
}
if (isset($_POST['send'])) {
    $SN = $_POST['PN'];
    if (usernameExists($db, $SN, $tableName)) {
        echo "<script>alert('The product already exist.');</script>";
    } else {
        if (isset($_FILES['PI']) && $_FILES['PI']['error'] == 0) {
            $ImageName = basename($_FILES['PI']['name']);
            $tmp = $_FILES['PI']['tmp_name'];

            // Define directories
            $folder = '../../Asset/ProductImage/' . $ImageName;
            $folder2 = 'C:/xampp/htdocs/OrderPHP/MainAPP/Asset/ProductImage/' . $ImageName;

            // Ensure directories exist
            if (!is_dir('../../Asset/ProductImage/')) {
                mkdir('../../Asset/ProductImage/', 0777, true);
            }
            if (!is_dir('C:/xampp/htdocs/OrderPHP/MainAPP/Asset/ProductImage/')) {
                mkdir('C:/xampp/htdocs/OrderPHP/MainAPP/Asset/ProductImage/', 0777, true);
            }

            // Move file to the first directory
            if (move_uploaded_file($tmp, $folder)) {
                // Copy to the second directory
                if (copy($folder, $folder2)) {
                    $_SESSION['ProductName'] = $_POST['PN'];
                    $_SESSION['ProductImage'] = $ImageName;
                    $_SESSION['Price'] = $_POST['P'];
                    $_SESSION['Quantity'] = $_POST['Q'];
                    header("location:ASubmit.php");
                    exit;
                } else {
                    echo "<script>alert('Failed to copy image to order app directory.');</script>";
                }
            } else {
                echo "<script>alert('Failed to move image to product directory.');</script>";
            }
        } else {
            echo "<script>alert('No valid file uploaded.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Style/ShopRegist.css">
    <link rel="icon" type="image/icon" href="../../Asset/Logo.ico" />
</head>

<body>
    <div class="main">
        <div class="imagec">
            <img src="../../Asset/Checking boxes-rafiki.svg" alt="" class="img">
        </div>
        <div class="component">
            <form id="LoginForm" method="post" class="Regist" action="Main.php" enctype="multipart/form-data" autocomplete="off">
                <div class="component">
                    <p>Product Name</p>
                    <div class="userform">
                        <input
                            type="text"
                            placeholder="Cookie"
                            name="PN"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Product Image</p>
                    <div class="userform">
                        <input
                            type="file"
                            name="PI"
                            accept=".png, .jpeg, .jpg"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Price</p>
                    <div class="userform">
                        <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                        <input
                            type="text"
                            name="P"
                            placeholder="10000"
                            class="usernamedesing"
                            id="shopcode"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Quantity</p>
                    <div class="userform">
                        <input
                            type="text"
                            name="Q"
                            placeholder="100"
                            class="usernamedesing"
                            id="shopcode"
                            required />
                    </div>
                </div>
                <div class="btnclass">
                    <button type="button" id="BTN" class="btn btn-outline-danger" onclick="window.location.href='Main.php'">Cancel</button>
                    <button type="submit" name="send" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../../Javascript/AP.js"></script>
</body>

</html>