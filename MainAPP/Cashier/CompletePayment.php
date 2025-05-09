<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/CP.css">
    <title>Complete Payment</title>
    <style>
        .receipt {
            font-family: 'Courier New', Courier, monospace;
            font-size: 18px;
            text-align: left;
            padding-left: 2%;
            padding-right: 2%;
        }

        .receipt-line {
            display: flex;
            justify-content: space-between;
            margin: 0;
            line-height: 1.2;
            margin-top: 10px;
        }

        .total-line {
            font-weight: bold;
            border-top: 2px solid black;
            margin-top: 15px;
            padding-top: 8px;
        }

        hr {
            margin: 8px 0;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="card" style="width: 95%; height: 95%;">
            <div class="card-body text-center" style="padding: 10px 0;">
                <h1 style="margin-bottom: 10px;">Receipt</h1>
                <h3 style="margin-bottom: 5px;">
                    <?php
                    $time = date("d-m-Y H:i:s");
                    $_SESSION['Time'] = $time;
                    echo $_SESSION['ShopName2'];
                    ?>
                </h3>
                <h3 style="margin-bottom: 15px; border-bottom: 2px dashed #ccc; padding-bottom: 5px;">
                    <?php echo htmlspecialchars($_SESSION['Location']); ?>
                </h3>

                <div class="receipt">
                    <h5>Time: <?php echo $time; ?></h5>
                    <h5>Transaction Code: <?php echo $_SESSION['BuyerCode']; ?></h5>
                    <h5>Payment Type: Cash & COD</h5>
                    <div class="receipt-line" style="font-weight: bold;">
                        <div>Item</div>
                        <div>Qty</div>
                        <div>Price</div>
                    </div>
                    <hr>

                    <?php
                    $totalAll = 0;
                    if (isset($_SESSION['OrderDetail']) && is_array($_SESSION['OrderDetail'])) {
                        foreach ($_SESSION['OrderDetail'] as $order) {
                            echo '<div class="receipt-line">';
                            echo '<div>' . $order['Item'] . '</div>';
                            echo '<div>' . "x" . $order['Quantity'] . '</div>';
                            echo '<div>Rp ' . $order['totalPrice'] . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<div>No order details found.</div>";
                    }
                    ?>

                    <div class="receipt-line" style="margin-top: 20px;">
                        <div>Subtotal</div>
                        <div></div>
                        <div>Rp <?php echo number_format($totalAll); ?></div>
                    </div>

                    <div class="receipt-line total-line">
                        <div>Total</div>
                        <div></div>
                        <div>Rp <?php echo number_format($totalAll); ?></div>
                    </div>
                    <hr>
                    <p style="text-align: center;">Note: Please download this invoice or screenshot to varify it originality. Every fake invoice that spotted will be lead to multiple of sanction, and lastly please show this invoice to take your product thank you.</p>
                    <p style="text-align: center;">&copy; Skydome2025</p>
                    <hr>
                    <div class="btn" style="width: 100; text-align:center; display: flex;">
                        <a href="CancelOrder.php" style="width: 50%;"><button type="button" style="width: 96%;" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel order?')">Cancel</button></a>
                        <a href="FinishOrderFunction.php" style="width: 50%;"><button type="button" style="width: 96%;" class="btn btn-success" onclick="return confirm('Do you want to finish order?')">Finish it</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>