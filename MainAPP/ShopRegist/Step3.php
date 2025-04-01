<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location:login.php");
    exit;
}
if (!isset($_SESSION['ShopCode'])) {
    if (!isset($_SESSION['ShopCode'])) {
        function generateRandomCode($length = 5)
        {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $code . $_SESSION['ShopName'];
        }
        $_SESSION['ShopCode'] = generateRandomCode();
    }
}
if (isset($_POST['send'])) {
    $ImageName = $_FILES['SLogo']['name'];
    $tmp = $_FILES['SLogo']['tmp_name'];
    $folder = '../Asset/ShopLogo/' . $ImageName;
    if (move_uploaded_file($tmp, $folder)) {
        $_SESSION['ShopLogo'] = $ImageName;
        $_SESSION['ShopCode'] = $_POST['SC'];
        header("location:RulesAndRegulation.php");
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

<body>
    <div class="main">
        <div class="imagec">
            <img src="../Asset/New employee-rafiki.svg" alt="" class="img">
        </div>
        <div class="component">
            <form id="LoginForm" method="post" class="Regist" action="Step3.php" enctype="multipart/form-data" autocomplete="off">
                <div class="component">
                    <p>Shop Logo</p>
                    <div class="userform">
                        <input
                            type="file"
                            name="SLogo"
                            accept=".png, .jpeg, .jpg"
                            class="usernamedesing"
                            id="username"
                            required />
                    </div>
                </div>
                <br>
                <div class="component">
                    <p>Shop Code</p>
                    <div class="userform">
                        <input
                            type="text"
                            name="SC"
                            value="<?php echo $_SESSION['ShopCode']; ?>"
                            class="usernamedesing"
                            id="shopcode"
                            readonly />
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