<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pos_app");

if (isset($_POST['confirm_transaction'])) {
    $transactionCode = $_POST['TransactionCode'];

    // Update the status to "Done"
    $updateSql = "UPDATE transaction SET Status = 'Done' WHERE TransactionCode = '$transactionCode'";
    if (mysqli_query($conn, $updateSql)) {
        header("Location: Transaction.php");
        exit;
    } else {
        echo "Error updating transaction: " . mysqli_error($conn);
    }
}
