<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
if (isset($_POST['send'])) {
    header("location:uploud.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules&Regulation</title>
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
            <form id="LoginForm" method="post" class="Regist" action="RulesAndRegulation.php">
                <div class="form-check">
                    <input class="form-check-input" name="A1" type="checkbox" id="flexCheckDefault" value="True" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        I Agree into Terms & Condition
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="A2" type="checkbox" id="flexCheckDefault" value="True" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        I Agree to all the Regulation that had been made
                    </label>
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