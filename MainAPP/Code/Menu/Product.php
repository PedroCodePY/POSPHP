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
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/icon" href="../../Asset/Logo.ico" />
    <link rel="stylesheet" href="../../Style/Dashboard.css">
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
                        <a class="nav-link active" href="#"><img class="icon" src="../../Asset/cubes.png" alt="Product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img class="icon" src="../../Asset/transaction-history.png" alt="Transaction">Transaction</a>
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
                        <a class="nav-link" aria-current="page" href="LogOut.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="productmanage">
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col">
                        </div>
                        <div class="col">
                        </div>
                        <div class="col">
                            <button type="button" id="APBTN" style="width:100%;" class="btn btn-outline-primary"> + Add product</button>
                        </div>
                    </div>
                </div>
                <div class="tb">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "pos_app");
                            $shopname = $_SESSION['Store'];
                            $tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_product");
                            $sql = "SELECT * FROM `$tableName`";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                foreach ($query as $row) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['ProductName']); ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Quantity']; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row['Price'], 0, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($row['ProductImage'])) { ?>
                                                <img src="../../Asset/ProductImage/<?php echo $row['ProductImage']; ?>" style="max-width: 100px; height: 70px;">
                                            <?php } else { ?>
                                                No Image
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Rate']; ?>
                                        </td>
                                        <td>
                                            <a href="EditProduct.php?id=<?php echo $row['ID']; ?>" class="btn btn-outline-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="DeleteProduct.php?id=<?php echo $row['ID']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">No products found.</td>
                                </tr>
                            <?php
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA5yr2GU1hisSuRjVyEd51gDlP9boyD" crossorigin="anonymous"></script>
    <script src="../../Javascript/Product.js"></script>
</body>

</html>