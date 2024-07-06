<?php
session_start();
include './Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the amount
    $amount = trim($_POST["amount"]);
    if (!is_numeric($amount) || $amount <= 0) {
        echo "Invalid amount.";
        exit();
    }

    // Update balance in the database
    $stmt = $conn->prepare("UPDATE Customers SET balance = balance + ? WHERE customer_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $amount, $customer_id);
        if ($stmt->execute()) {
            $stmt->close();
            // Redirect to profile page after successful recharge
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating balance: " . $conn->error;
            exit();
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }
}

$conn->close();
?>
