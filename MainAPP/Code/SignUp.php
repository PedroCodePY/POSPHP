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
    <title>Register</title>
</head>

<body>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="login.js" type="module"></script>
    <div class="Main">
        <div class="loginplace">
            <center>
                <img src="../Asset/Logo.png" alt="" class="logo" />
                <form name="Regist" action="SignUp.php" method="post">
                    <div class="userform">
                        <img src="../Asset/user.png" alt="" class="image" />
                        <input
                            type="text"
                            placeholder="Full Name"
                            name="Name"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                    <br />
                    <div class="userform">
                        <img src="../Asset/user.png" alt="" class="image" />
                        <input
                            type="text"
                            placeholder="Username"
                            name="Username"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                    <br />
                    <div class="userform">
                        <img src="../Asset/key.png" alt="" class="image" />
                        <input
                            type="password"
                            placeholder="Password"
                            name="Password"
                            class="passworddesing"
                            id="password"
                            required />
                        <img src="../Asset/eye.png" class="image" type="button" id="ShowHide" />
                    </div>
                    <br />
                    <div class="userform">
                        <img src="../Asset/user.png" alt="" class="image" />
                        <input
                            type="email"
                            placeholder="Email"
                            name="Email"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                    <br />
                    <button type="submit" name="submit" class="Loginbtn">Register</button>
                    <p>Already have an account?<a href="login.php">Login</a></p>
                </form>
                <p class="Copyright">&copy;Skydome 2025</p>
            </center>
        </div>
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'pos_app');
        function usernameExists($db, $username)
        {
            $sanitizedUsername = mysqli_real_escape_string($db, $username);
            $sql = "SELECT COUNT(*) FROM user WHERE Username = '$sanitizedUsername'";
            $result = mysqli_query($db, $sql);
            if ($result) {
                $row = mysqli_fetch_array($result);
                $count = $row[0];
                return $count > 0;
            } else {
                error_log("Database query error: " . mysqli_error($db));
                return false;
            }
        }
        if (isset($_POST['submit'])) {
            $Name = $_POST['Name'];
            $Username = $_POST['Username'];
            $Email = $_POST['Email'];
            $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            if (usernameExists($db, $Username)) {
                echo "<script>alert('Username already taken. Please choose a different username.');</script>";
            } else {
                // Username is available, proceed with registration
                $sql = "INSERT INTO user(Name, Username, Password, Email) VALUES('$Name', '$Username', '$Password', '$Email')";
                $send = mysqli_query($db, $sql);

                if ($send) {
                    echo "<script>alert('Registration Successful');</script>";
                } else {
                    echo "<script>alert('Registration Failed');</script>";
                }
            }
        }
        ?>
    </div>
    <script src="../Javascript/HideShow.js"></script>
</body>

</html>