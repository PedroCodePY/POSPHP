<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
$db = mysqli_connect('localhost', 'root', '', 'pos_app');
$shopname = $_SESSION['Store'];
$tableName = preg_replace("/[^a-zA-Z0-9_]/", "", "shop_" . $shopname . "_users");
function usernameExists($db, $SN, $tableName)
{
    $sql = "SELECT COUNT(*) FROM `$tableName` WHERE Username = '$SN'";
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
if (isset($_POST['send'])) {
    $SN = $_POST['FN'];
    if (usernameExists($db, $SN, $tableName)) {
        echo "<script>alert('Username has already taken!');</script>";
    } else {
        $_SESSION['FullName'] = $_POST['FN'];
        $_SESSION['Email'] = $_POST['Email'];
        $_SESSION['USER'] = $_POST['USN'];
        $_SESSION['Password'] = $_POST['PSSD'];
        header("location:ASubmit.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Style/ShopRegist.css">
    <link rel="icon" type="image/icon" href="../../Asset/Logo.ico" />
</head>

<body>
    <div class="main1">
        <div class="form-box">
            <form id="LoginForm" method="post" class="Regist" action="Main.php" autocomplete="false">
                <div class="component">
                    <p>Full Name*</p>
                    <div class="userform">
                        <input
                            type="text"
                            placeholder="John Doe"
                            name="FN"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Email*</p>
                    <div class="userform">
                        <input
                            type="Email"
                            placeholder="johndoe@example.example"
                            name="Email"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Username*</p>
                    <div class="userform">
                        <input
                            type="text"
                            placeholder="JohnDoe123"
                            name="USN"
                            class="usernamedesing"
                            id="username"
                            autocomplete="off"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Password*</p>
                    <div class="userform">
                        <input
                            type="Password"
                            name="PSSD"
                            placeholder="JOHN1234"
                            class="usernamedesing"
                            id="shopcode"
                            autocomplete="off"
                            required />
                    </div>
                </div>
                <div class="btnclass">
                    <button type="button" id="BTN2" class="btn btn-outline-danger" onclick="window.location.href='../Menu/User.php'">Cancel</button>
                    <button type="submit" name="send" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../../Javascript/AP.js"></script>
</body>

</html>