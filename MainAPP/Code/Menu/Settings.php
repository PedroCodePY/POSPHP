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
    <title>Settings</title>
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
                        <a class="nav-link" href="User.php"><img class="icon" src="../../Asset/users-avatar.png">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img class="icon" src="../../Asset/settings.png">Settings</a>
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
            <div class="settingsmanage">
                <div class="topPart">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "pos_app");
                    $sql2 = "SELECT * FROM user WHERE Username = '" . $_SESSION['Username'] . "'";
                    $query2 = mysqli_query($conn, $sql2);
                    $query2 = mysqli_query($conn, $sql2);
                    if ($row2 = mysqli_fetch_assoc($query2)) {
                        if (!empty($row2['ProfilePicture'])) {
                            echo "<img class='pps' src='../../Asset/PP/" . htmlspecialchars($row2['ProfilePicture']) . "'>";
                        } else {
                            echo "<img class='pps' src='../../Asset/PP/profile-user.png'>";
                        }
                        echo "<h1 class='Name'>" . htmlspecialchars($row2['Name']) . " </h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>