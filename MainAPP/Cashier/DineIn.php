<?php
session_start();
if (!isset($_SESSION['Username2'])) {
    header("location:Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dine In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/icon" href="../Asset/Logo.ico" />
    <link rel="stylesheet" href="../Style/Dashboard.css">
    <link rel="stylesheet" href="../Style/DineIn.css">
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="logo">
                <center>
                    <img class="logoimg" src="../Asset/Logo.png" alt="">
                </center>
            </div>
            <div class="mainNav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="Dashboard.php"><img class="icon" src="../Asset/home.png">Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img class="icon" src="../Asset/transaction-history.png">Dine In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Menu/Settings.php"><img class="icon" src="../Asset/settings.png">Settings</a>
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
            <div class="manage" style="height: 100%">
                <form method="post" action="OrderFunction.php" style="height: 90%;">
                    <div class="menu">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "pos_app");
                        $sql3 = "SELECT ShopName FROM shoplist WHERE ShopCode = '" . $_SESSION['ShopCode'] . "'";
                        $query3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($query3);
                        $shopname = $row3['ShopName'];
                        $sql4 = "SELECT * FROM `transaction` WHERE `Type` = 'OrderApp' AND `Store` = '$shopname' AND `Status` = ''";
                        $query4 = mysqli_query($conn, $sql4);
                        if (mysqli_num_rows($query4) > 0) {
                            foreach ($query4 as $row) {
                        ?>
                                <div class="card">
                                    <div class="card-body" style="display: flex;">
                                        <div class="text">
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
                                        </div>
                                        <div class="action"></div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No Order Found";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function changeQuantity(itemId, changeAmount) {
            const input = document.getElementById(`quantity-${itemId}`);
            if (input) {
                let currentValue = parseInt(input.value);
                if (isNaN(currentValue)) {
                    currentValue = 0;
                }
                const newValue = currentValue + changeAmount;
                if (newValue >= 0) { // Prevent negative quantities
                    input.value = newValue;
                    checkQuantities();
                }
            }
        }
    </script>
</body>

</html>