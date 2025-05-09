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
                        <a class="nav-link" href="Transaction.php"><img class="icon" src="../../Asset/transaction-history.png">Transaction</a>
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
                        $_SESSION['Store'] = $row['ShopCode'];
                        $shopname = $_SESSION['Store'];
                        $tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_users");
                        $sqln = "SELECT * FROM `$tableName`";
                        $queryr = mysqli_query($con1, $sqln);
                        if (mysqli_num_rows($queryr) > 0) {
                ?>
                            <div class="card" style="width: 98%; height:98%; border-radius: 15px; text-align: center;">
                                <div class="card-body">
                                    <div class="container text-center">
                                        <div class="row align-items-start">
                                            <div class="col">
                                            </div>
                                            <div class="col">
                                            </div>
                                            <div class="col">
                                                <a href="../UserRegist/Main.php"><button type="button" id="APBTN" style="width:100%;" class="btn btn-outline-primary"> + Add User</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-hover" style="width: 98%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Profile Picture</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($queryr as $row) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['ID']; ?></th>
                                                    <td><?php echo $row['Name']; ?></td>
                                                    <td><?php echo $row['Username']; ?></td>
                                                    <td><?php echo $row['Password']; ?></td>
                                                    <td><?php echo $row['ProfilePicture']; ?></td>
                                                    <td><?php echo $row['Email']; ?></td>
                                                    <td><a href="EditProduct.php?id=<?php echo $row['ID']; ?>" class="btn btn-outline-success">Edit</a></td>
                                                    <td><a href="DeleteProduct.php?id=<?php echo $row['ID']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class='error'>
                                <div class="image">
                                    <img src="../../Asset/Lost.svg" class="lost">
                                </div>
                                <div class="text">
                                    <h1>No user found</h1>
                                    <button type="button" class="btn btn-primary"><a class="btnStrNW" href="../UserRegist/Main.php">Add new user</a></button>
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
                            <button type="button" class="btn btn-primary"><a class="btnStrNW" href="../../ShopRegist/Main.php">Create new shop</a></button>
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