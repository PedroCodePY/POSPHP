<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/icon" href="../../Asset/Logo.ico" />
    <link rel="stylesheet" href="../../Style/Dashboard.css">
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="logo">
                <center>
                    <img class="logoimg" src="../../Asset/Logo.png" alt="">
                </center>
            </div>
            <div class="mainNav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../Dashboard.php"><img class="icon" src="../../Asset/home.png">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Store.php"><img class="icon" src="../../Asset/store.png">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Product.php"><img class="icon" src="../../Asset/cubes.png">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img class="icon" src="../../Asset/transaction-history.png">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img class="icon" src="../../Asset/users-avatar.png">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php"><img class="icon" src="../../Asset/settings.png">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="logOut">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="LogOut.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="usermanage">
                <?php
                $con1 = mysqli_connect("localhost", "root", "", "pos_app");
                $sql = "SELECT * FROM shoplist WHERE ShopOwner = '" . $_SESSION['Username'] . "'";
                $query = mysqli_query($con1, $sql);
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $row) {
                        $_SESSION['Store'] = $row['ShopCode'];
                        $shopname = $_SESSION['Store'];
                        $tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_users");
                        $sqln = "SELECT * FROM `$tableName`";
                        $queryr = mysqli_query($con1, $sqln);
                        if (mysqli_num_rows($queryr) > 0) {
                        } else {
                ?>
                            <div class='error'>
                                <div class="image">
                                    <img src="../../Asset/Lost.svg" class="lost">
                                </div>
                                <div class="text">
                                    <h1>No user found</h1>
                                    <button type="button" class="btn btn-primary"><a class="btnStrNW" href="../ShopRegist/Main.php">Add new user</a></button>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <div class='error'>
                        <div class="image">
                            <img src="../../Asset/Lost.svg" class="lost">
                        </div>
                        <div class="text">
                            <h1>No shop found</h1>
                            <button type="button" class="btn btn-primary"><a class="btnStrNW" href="../ShopRegist/Main.php">Create new shop</a></button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>