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
    <link rel="icon" type="image/icon" href="../Asset/Logo.ico" />
    <link rel="stylesheet" href="../Style/Dashboard.css">
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
                        <a class="nav-link" href="DineIn.php"><img class="icon" src="../Asset/transaction-history.png">Dine In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img class="icon" src="../Asset/settings.png">Settings</a>
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
            <div class="manage" style="height: 100%; justify-items: center; padding-top:1%">
                <div class="card" style="width: 98%; height:35%; border-radius: 15px;">
                    <div class="card-body">
                        <div class="card-title" style="display: flex; width: 100%; flex-direction: column;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="mb-0">User Profile</h3>
                                <a href="#" class="btn btn-outline-primary btn-lg" onclick="alert('Under maintenance!')">Edit</a>
                            </div>
                        </div>
                        <div class="shopInfo">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "pos_app");
                            $table2 = "shop_" . $_SESSION['ShopCode'] . "_users";
                            $sql2 = "SELECT * FROM $table2 WHERE Username = '" . $_SESSION['Username2'] . "'";
                            $query2 = mysqli_query($conn, $sql2);
                            $query2 = mysqli_query($conn, $sql2);
                            if ($row2 = mysqli_fetch_assoc($query2)) {
                                if (!empty($row2['ProfilePicture'])) {
                            ?>
                                    <div class="Shoplogo">
                                        <div class="card" style="width: 200px; height:200px; align-items:center; justify-content:center; border-radius: 50%; padding: 5px;">
                                            <img class='pps' src='../Asset/PP/"<?php htmlspecialchars($row2['ProfilePicture']) ?>' alt="Profile Picture">
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="Shoplogo">
                                        <div class="card" style="width: 200px; height:200px; align-items:center; justify-content:center; border-radius: 50%; padding: 5px;">
                                            <img class='pps' src='../Asset/PP/profile-user.png' alt="Profile Picture">
                                        </div>
                                    </div>
                                    <div class="shopDetail">
                                        <h1><?php echo $row2['Name'] ?></h1>
                                        <h3>Username: <?php echo $row2['Username'] ?></h3>
                                        <h3>Email: <?php echo $row2['Email'] ?></h3>
                                        <div class="mb-3" style="display: flex;">
                                            <label for="passwordInput" class="form-label">
                                                <h3>Password:</h3>
                                            </label>
                                            <div class="input-group" style="max-width: 400px; height: 30px; margin-left: 10px;">
                                                <input type="password" class="form-control" id="passwordInput" value="<?php echo $row2['Password']; ?>" readonly style="cursor: default;">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">Show</button>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("passwordInput");
            const toggleButton = passwordInput.nextElementSibling;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                toggleButton.textContent = "Show";
            }
        }
    </script>
</body>

</html>