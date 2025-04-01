<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
$db = mysqli_connect('localhost', 'root', '', 'pos_app');
function usernameExists($db, $SN)
{
    $sql = "SELECT COUNT(*) FROM shoplist WHERE ShopName = '$SN'";
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
if (isset($_GET['send'])) {
    $SN = $_GET['SN'];
    if (usernameExists($db, $SN)) {
        echo "<script>alert('Shop Name already taken. Please choose a different Shop Name.');</script>";
    } else {
        $_SESSION['ShopName'] = $_GET['SN'];
        header("location:Step2.php");
        exit;
    }
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
<div class="main">
    <div class="imagec">
        <img src="../Asset/New employee-rafiki.svg" alt="" class="img">
    </div>
    <div class="component">
        <form id="LoginForm" method="get" class="Regist" action="Main.php">
            <div class="component">
                <p>Shop Name</p>
                <div class="userform">
                    <input
                        type="text"
                        placeholder="Shop Name"
                        name="SN"
                        class="usernamedesing"
                        id="username"
                        required />
                </div>
            </div>
            <div class="btnclass">
                <button type="button" id="cancel" class="btn btn-outline-danger">Cancel</button>
                <button type="submit" name="send" class="btn btn-primary">Continue</button>
            </div>
        </form>
    </div>
</div>
<script src="../Javascript/S1SR.js"></script>
</body>

</html>