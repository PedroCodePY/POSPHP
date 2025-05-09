<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}

if (isset($_POST['save'])) {
    if (isset($_FILES['shoplogo']) && $_FILES['shoplogo']['error'] == 0) {
        $fileName = basename($_FILES['shoplogo']['name']);
        $tmp = $_FILES['shoplogo']['tmp_name'];
        $targetDir = "../../Asset/ShopLogo/";
        $targetPath = $targetDir . $fileName;

        // Move the uploaded file
        if (move_uploaded_file($tmp, $targetPath)) {
            // Update DB
            $username = $_SESSION['Username'];
            $con = mysqli_connect("localhost", "root", "", "pos_app");
            $location1 = $_POST['l1'];
            $location2 = $_POST['l2'];
            $phone = $_POST['pns'];
            $email = $_POST['es'];
            $website = $_POST['ws'];
            $updateSql = "UPDATE shoplist SET ShopLogo = '$fileName', ShopLocation = '$location1', ShopPostalCode = '$location2', ShopPN = '$phone', ShopEmail = '$email', ShopWebsite = '$website' WHERE ShopOwner = '$username'";
            mysqli_query($con, $updateSql);
            echo "<script>alert('Succesfully update.');</script>";
            header("location:Store.php");
            exit;
        } else {
            echo "<script>alert('Failed to upload file.');</script>";
        }
    } else {
        echo "<script>alert('No image uploaded.');</script>";
    }
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
    <style>
        #imageInput {
            display: none;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            object-fit: cover;
            cursor: pointer;
            transition: 0.3s;
        }

        .image-preview:hover {
            opacity: 0.8;
        }
    </style>
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
                                    </div>
                                </div>
                                <div class="shopInfo" style="height: auto; padding: 2%;">
                                    <form method="post" action="#" style="width: 100%; height: 100%;" enctype="multipart/form-data">
                                        <div class="content" style="width: 100%; display:flex; height: 96%;">
                                            <div class="Shoplogo">
                                                <div class="card" style="width: 240px; height:240px; align-items:center; justify-content:center; border-radius: 15px;">
                                                    <input type="file" id="imageInput" name="shoplogo" accept="image/*" value="<?php echo $row['ShopLogo'] ?>" required>
                                                    <label for="imageInput" style="width: 90%; height:90%;">
                                                        <img id="previewImage" class="image-preview" src="../../Asset/ShopLogo/<?php echo $row['ShopLogo'] ?>" alt="Shop Logo">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="shopDetail">
                                                <h1><?php echo $row['ShopName'] ?></h1>
                                                <div class="input" style="display: flex;">
                                                    <h4>Location: </h4>
                                                    <input name="l1" class="seinput1" type="text" value="<?php echo $row['ShopLocation'] ?>" required>
                                                    <h4 style="margin-left: 1px;">, </h4>
                                                    <input name="l2" class="seinput2" type="text" value="<?php echo $row['ShopPostalCode'] ?>" required>
                                                </div>
                                                <div class="input" style="display: flex;">
                                                    <h4>Phone Number: </h4>
                                                    <input name="pns" class="seinput" type="text" value="<?php echo $row['ShopPN'] ?>" required>
                                                </div>
                                                <div class="input" style="display: flex;">
                                                    <h4>Email: </h4>
                                                    <input name="es" class="seinput" type="text" value="<?php echo $row['ShopEmail'] ?>" required>
                                                </div>
                                                <div class="input" style="display: flex;">
                                                    <h4>Website: </h4>
                                                    <input name="ws" class="seinput" type="text" value="<?php echo $row['ShopWebsite'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn" style="width: 100%; display: flex; justify-content: space-between; margin-top: 1%;">
                                            <button type="button" class="btn btn-danger" style="width: 49%; height: 55px;" onclick="location.href = 'Store.php';">Cancel</button>
                                            <button type="submit" name="save" class="btn btn-success" style="width: 49%; height: 55px;">Save</button>
                                        </div>
                                    </form>
                                </div>
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
                            <img src="../Asset/Lost.svg" class="lost">
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
    <script>
        const imageInput = document.getElementById("imageInput");
        const previewImage = document.getElementById("previewImage");

        imageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
            }
        });
    </script>
</body>

</html>