<?php
session_start();

if (isset($_POST['send'])) {
    $quantities = $_POST['quantity'];
    $orderDetails = [];

    $conn = mysqli_connect("localhost", "root", "", "pos_app");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    function generateRandomCode()
    {
        $conn = mysqli_connect("localhost", "root", "", "pos_app");
        $sqlCode = "SELECT ID FROM transaction";
        $RUNCode = mysqli_query($conn, $sqlCode);
        $tP = 1;
        for ($i = 0; $i < mysqli_num_rows($RUNCode); $i++) {
            $tP = $tP + 1;
        }
        $code = "OPHPC" . $tP;
        return $code;
    }
    $_SESSION['BuyerCode'] = generateRandomCode();

    foreach ($quantities as $itemId => $quantity) {
        if ($quantity > 0) {
            // Prepare to get item details
            $query = "SELECT * FROM menupos WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $itemId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $item = mysqli_fetch_assoc($result);

            if ($item) {
                $store = $item['Shop'];

                // Safe query for shop
                $query2 = "SELECT * FROM shoplist WHERE ShopName = ?";
                $stmt2 = mysqli_prepare($conn, $query2);
                mysqli_stmt_bind_param($stmt2, "s", $store);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);
                $final = mysqli_fetch_assoc($result2);

                $location = $final['ShopLocation'];
                $shopcode = $final['ShopCode'];

                $itemName = $item['Name'];
                $itemPrice = $item['Price'];
                $totalPrice = $itemPrice * $quantity;

                // Collect order details
                $orderDetails[] = [
                    'Item' => $itemName,
                    'Quantity' => $quantity,
                    'totalPrice' => $totalPrice
                ];
            } else {
                // If item not found
                header("Location: OrderNotValid.php");
                exit();
            }
        }
    }

    if (!empty($orderDetails)) {
        $_SESSION['ShopName2'] = $store;
        $_SESSION['ShopCode2'] = $shopcode;
        $_SESSION['Location'] = $location;
        $_SESSION['OrderDetail'] = $orderDetails;
        header("Location: CompletePayment.php");
        exit();
    } else {
        header("Location: Menu.php");
        exit();
    }
}
