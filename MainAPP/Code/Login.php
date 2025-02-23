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
    <script src="login.js" type="module"></script>
    <div class="Main">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="deamer"></div>
                <div class="carousel-item active">
                    <img src="../Asset/coffee_shop.jpeg" class="bg">
                </div>
            </div>
        </div>
        <div class="loginplace">
            <center>
                <img src="Logo.png" alt="" class="logo" />
                <form id="LoginForm">
                    <div class="userform">
                        <img src="profile-user.png" alt="" class="image" />
                        <input
                            type="email"
                            placeholder="IgnatiusMail"
                            name="user"
                            class="usernamedesing"
                            id="username"
                            focus />
                    </div>
                    <br />
                    <div class="userform">
                        <img src="padlock.png" alt="" class="image" />
                        <input
                            type="password"
                            placeholder="Password"
                            name="pass"
                            class="passworddesing"
                            id="password" />
                        <img src="eye.png" class="image" type="button" id="ShowHide" />
                    </div>
                    <p class="error" id="error">Email or Password incorrect</p>
                    <button type="submit" class="Loginbtn">Masuk</button>
                </form>
                <p class="Copyright">&copy;Skydome 2024</p>
            </center>
        </div>
        <?php
        ?>
    </div>
</body>

</html>