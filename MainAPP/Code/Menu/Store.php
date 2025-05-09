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
    <title>Store</title>
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
                        <a class="nav-link active" href="#"><img class="icon" src="../../Asset/store.png">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Product.php"><img class="icon" src="../../Asset/cubes.png">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Transaction.php"><img class="icon" src="../../Asset/transaction-history.png">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User.php"><img class="icon" src="../../Asset/users-avatar.png">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php"><img class="icon" src="../../Asset/settings.png">Settings</a>
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
            <div class="manage" style="height: 100%; align-content:center; justify-items: center;">
                <?php
                $con1 = mysqli_connect("localhost", "root", "", "pos_app");
                $sql = "SELECT * FROM shoplist WHERE ShopOwner = '" . $_SESSION['Username'] . "'";
                $query = mysqli_query($con1, $sql);
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $row) {
                        $_SESSION['Store'] = $row['ShopCode']; ?>
                        <div class="card" style="width: 98%; height:98%; border-radius: 15px;">
                            <div class="card-body">
                                <div class="card-title" style="display: flex; width: 100%; flex-direction: column;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="mb-0">Shop Profile</h3>
                                        <a href="StoreEdit.php" class="btn btn-outline-primary btn-lg">Edit</a>
                                    </div>
                                </div>
                                <div class="shopInfo">
                                    <div class="Shoplogo">
                                        <div class="card" style="width: 240px; height:240px; align-items:center; justify-content:center; border-radius: 15px;">
                                            <img src="../../Asset/ShopLogo/<?php echo $row['ShopLogo'] ?>" alt="ShopLogo" style="width: 90%; height:90%;">
                                        </div>
                                    </div>
                                    <div class="shopDetail">
                                        <h1><?php echo $row['ShopName'] ?></h1>
                                        <h4>Location: <?php echo $row['ShopLocation'] ?>, <?php echo $row['ShopPostalCode'] ?></h4>
                                        <h4>Phone Number: <?php echo $row['ShopPN'] ?></h4>
                                        <h4>Email: <?php echo $row['ShopEmail'] ?></h4>
                                        <h4>Website: <?php echo $row['ShopWebsite'] ?></h4>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <?php
                                $sql2 = "SELECT * FROM user WHERE Username = '" . $_SESSION['Username'] . "'";
                                $query2 = mysqli_query($con1, $sql2);
                                if (mysqli_num_rows($query2) > 0) {
                                    foreach ($query2 as $row2) {
                                ?>
                                        <h4>Owner: <?php echo $row2['Name'] ?></h4>
                                        <h4>Email: <?php echo $row2['Email'] ?></h4>
                                <?php
                                    }
                                }
                                ?>
                                <h4>Year Created: <?php echo $row['Year'] ?></h4>
                                <h4>Shop Code: <?php echo $row['ShopCode'] ?></h4>
                                <a target="_blank" href="../../Cashier/Login.php" class="btn btn-outline-success">Worker's Login</a>
                                <a class=" btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this Store?')">Delete Store</a>
                                <p>&copy <?php echo $row['ShopName'] ?> 2025</p>
                                <hr>
                                <div class="bottom">
                                    <p>&copy Skydome 2025</p>
                                </div>
                            </div>
                        </div>
                    <?php
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