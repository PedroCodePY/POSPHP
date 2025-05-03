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
    <title>Selling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/icon" href="../Asset/Logo.ico" />
    <link rel="stylesheet" href="../Style/Dashboard.css">
    <link rel="stylesheet" href="../Style/Cashier.css">
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
                        <a class="nav-link active" aria-current="page" href="#"><img class="icon" src="../Asset/home.png">Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="DineIn.php"><img class="icon" src="../Asset/transaction-history.png">Dine In</a>
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
            <div class="menutop">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "pos_app");
                $table = "shop_" . $_SESSION['ShopCode'] . "_product";
                $table2 = "shop_" . $_SESSION['ShopCode'] . "_users";
                $sql2 = "SELECT * FROM $table2 WHERE Username = '" . $_SESSION['Username2'] . "'";
                $query2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($query2) > 0) {
                    foreach ($query2 as $row2) {
                ?>
                        <h3 class="Name"><?php echo $row2['Name'] ?></h3>
                <?php
                        if (!empty($row2['ProfilePicture'])) {
                            echo "<img src='../Asset/PP/" . htmlspecialchars($row2['ProfilePicture']) . "'>";
                        } else {
                            echo "<img class='pp' src='../Asset/PP/profile-user.png'>";
                        }
                    }
                }
                ?>
            </div>
            <div class="manage">
                <form method="post" action="OrderFunction.php" style="height: 90%;">
                    <div class="menu">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "pos_app");
                        $query = "SELECT * FROM menupos";
                        $sql_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($sql_run) > 0) {
                            foreach ($sql_run as $row) {
                        ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['Name']; ?></h5>
                                        <h6 class="card-text"><?php echo $row['Shop']; ?></h6>
                                        <p class="card-text"><?php echo $row['Rate']; ?>&#11088;</p>
                                        <?php
                                        $price = number_format($row['Price']);
                                        $rupiah = "Rp $price";
                                        ?>
                                        <p><?php echo $rupiah ?></p>
                                        <div class="quantity">
                                            <button type="button" class="pm" onclick="changeQuantity(<?php echo $row['ID']; ?>, -1)">-</button>
                                            <input type="number" name="quantity[<?php echo $row['ID']; ?>]" id="quantity-<?php echo $row['ID']; ?>" class="Num" min="0" value="0">
                                            <button type="button" class="pm" onclick="changeQuantity(<?php echo $row['ID']; ?>, 1)">+</button>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No Item Found";
                        }
                        ?>
                    </div>
                    <button type="submit" id="continueButton" class="btn" name="send"><i><img src="../Asset/cart-shopping-fast.png" class="btnico"></i>Continue</button>
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