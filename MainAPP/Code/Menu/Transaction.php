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
    <title>Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/icon" href="../../Asset/Logo.ico" />
    <link rel="stylesheet" href="../../Style/Dashboard.css">
    <link rel="stylesheet" href="../../Style/DineIn.css">
    <style>
        .content {
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Reduced gap between cards */
            max-height: 100vh;
            /* Set max-height to limit the height */
            overflow-y: auto;
            /* Make it scrollable */
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="logo">
                <center>
                    <img class="logoimg" src="../../Asset/Logo.png" alt="Logo">
                </center>
            </div>
            <div class="mainNav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../Dashboard.php"><img class="icon" src="../../Asset/home.png" alt="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Store.php"><img class="icon" src="../../Asset/store.png" alt="Store">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Product.php"><img class="icon" src="../../Asset/cubes.png" alt="Product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img class="icon" src="../../Asset/transaction-history.png" alt="Transaction">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User.php"><img class="icon" src="../../Asset/users-avatar.png" alt="User">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php"><img class="icon" src="../../Asset/settings.png" alt="Settings">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="logOut">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../LogOut.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <?php
            $con1 = mysqli_connect("localhost", "root", "", "pos_app");
            $sql = "SELECT * FROM shoplist WHERE ShopOwner = '" . $_SESSION['Username'] . "'";
            $query = mysqli_query($con1, $sql);
            if (mysqli_num_rows($query) > 0) {
                foreach ($query as $row) {
                    $_SESSION['Store'] = $row['ShopCode']; ?>
                    <div class="manage" style="height: 100%">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "pos_app");
                        $sql3 = "SELECT ShopName FROM shoplist WHERE ShopCode = '" . $_SESSION['ShopCode'] . "'";
                        $query3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($query3);
                        $shopname = $row3['ShopName'];
                        $sql4 = "SELECT * FROM `transaction` WHERE `Store` = '$shopname'";
                        $query4 = mysqli_query($conn, $sql4);
                        if (mysqli_num_rows($query4) > 0) {
                            foreach ($query4 as $row) {
                        ?>
                                <form method="post" action="DineIn.php" style="height:auto;">
                                    <div class="Transaction">
                                        <div class="card" style="height: fit-content;">
                                            <div class="card-body" style="display: flex;">
                                                <div class="text1">
                                                    <h2 class="card-title"><?php echo $row['TransactionCode']; ?></h2>
                                                    <h5 class="card-subtitle">Product:</h5>
                                                    <ul>
                                                        <?php
                                                        $table = "shop_" . $_SESSION['ShopCode'] . "_transaction";
                                                        $sql5 = "SELECT * FROM $table WHERE `TransactionCode` = '" . $row['TransactionCode'] . "'";
                                                        $query5 = mysqli_query($conn, $sql5);
                                                        $price = 0;
                                                        if (mysqli_num_rows($query5) > 0) {
                                                            foreach ($query5 as $row2) {
                                                        ?>
                                                                <li class="card-text"><?php echo $row2['Product']; ?> x<?php echo $row2['Quantity']; ?></li>
                                                                <?php $price += $row2['Price']; ?>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                    <h5 class="card-text">Total amount: <?php echo $price; ?></h5>
                                                    <h5 class="card-text">Type: <?php echo $row['Type']; ?></h5>
                                                    <h5 class="card-text">
                                                        Status:
                                                        <span style="color: <?php echo ($row['Status'] === 'Done') ? 'green' : 'red'; ?>;">
                                                            <?php echo $row['Status']; ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                                <div class="action">
                                                    <?php if ($row['Status'] !== 'Done') { ?>
                                                        <input type="hidden" name="TransactionCode" value="<?php echo $row['TransactionCode']; ?>">
                                                        <button type="submit" name="confirm_transaction" class="btn btn-primary" onclick="return confirm('Are you sure you want to complete this transaction?')">
                                                            Confirm
                                                        </button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-success" disabled>Completed</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                        } else {
                            ?>
                            <div class='error' style="width: 100%; height: 100%; align-items: center; justify-content: center;">
                                <div class="image">
                                    <img src="../../Asset/Lost.svg" class="lost">
                                </div>
                                <div class="text" style="border-right: 0;">
                                    <h1>No Order Found</h1>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class='error'>
                    <div class="image">
                        <img src="../../Asset/Lost.svg" class="lost">
                    </div>
                    <div class="text" style="border-right: 0;">
                        <h1>No shop found</h1>
                        <button type="button" class="btn btn-primary"><a class="btnStrNW" href="../ShopRegist/Main.php">Create new shop</a></button>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA5yr2GU1hisSuRjVyEd51gDlP9boyD" crossorigin="anonymous"></script>
    <script src="../../Javascript/Product.js"></script>
</body>

</html>