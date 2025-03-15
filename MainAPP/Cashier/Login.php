<?php
session_start();
$_SESSION['error'] = "";
function verifyLogin($conn, $username, $password)
{
    $sanitizedUsername = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT Password FROM user WHERE Username = '$sanitizedUsername'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDatabase = $row['Password'];
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
$conn = mysqli_connect("localhost", "root", "", "pos_app");
if (isset($_POST['loginbtn'])) {
    $Username = $_POST['user'];
    $password = $_POST['pass'];
    if (verifyLogin($conn, $Username, $password)) {
        $_SESSION['Username'] = $Username;
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION["error"] = "Invalid username or password";
        header("location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../Style/LoginStyle.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link rel="icon" type="image/icon" href="Logo.ico" />
    <title>Login</title>
</head>

<body>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <div class="Main">
        <div class="loginplace">
            <center>
                <img src="../Asset/Logo.png" alt="" class="logo" />
                <form id="LoginForm" method="post" action="Login.php">
                    <div class="userform">
                        <img src="../Asset/user.png" alt="" class="image" />
                        <input
                            type="text"
                            placeholder="Username"
                            name="user"
                            class="usernamedesing"
                            id="username"
                            focus />
                    </div>
                    <br />
                    <div class="userform">
                        <img src="../Asset/key.png" alt="" class="image" />
                        <input
                            type="password"
                            placeholder="Password"
                            name="pass"
                            class="passworddesing"
                            id="password" />
                        <img src="../Asset/eye.png" class="image" type="button" id="ShowHide" />
                    </div>
                    <br>
                    <div class="userform">
                        <img src="../Asset/user.png" alt="" class="image" />
                        <input
                            type="text"
                            placeholder="Shop Code"
                            name="SCODE"
                            class="usernamedesing"
                            id="username"
                            focus />
                    </div>
                    <button type="submit" class="Loginbtn" name="loginbtn">Masuk</button>
                    <p class="error" id="error"><?php echo $_SESSION['error'] ?></p>
                </form>
                <p class="Copyright">&copy;Skydome 2025</p>
            </center>
        </div>
        <script src="../Javascript/HideShow.js"></script>
    </div>
</body>

</html>