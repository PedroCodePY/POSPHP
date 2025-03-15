<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
if (isset($_POST['send'])) {
    $_SESSION['ShopLogo'] = $_POST['SLogo'];
    header("location:RulesAndRegulation.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/ShopRegist.css">
    <link rel="icon" type="image/icon" href="../Asset/Logo.ico" />
</head>

<body>
    <div class="main">
        <div class="imagec">
            <img src="../Asset/New employee-rafiki.svg" alt="" class="img">
        </div>
        <div class="component">
            <form id="LoginForm" method="post" class="Regist" action="Step3.php">
                <div class="component">
                    <p>Shop Logo</p>
                    <div class="userform">
                        <input
                            type="file"
                            name="SLogo"
                            class="usernamedesing"
                            accept=".jpg, .jpeg, .png"
                            id="username"
                            required />
                    </div>
                </div>
                <div class="btnclass">
                    <button type="button" id="back" class="btn btn-outline-danger">Back</button>
                    <button type="submit" name="send" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../Javascript/S2SR.js"></script>
</body>

</html>