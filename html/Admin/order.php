<?php
session_start();
include_once './Admin/database.php'; // Include database connection file

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../Authentication/register.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $totalPrice = $_POST['total_price']; // Total price of the order
    $status = 'Pending'; // Set initial order status

    // Insert order details into the Orders table
    $stmt = $conn->prepare("INSERT INTO Orders (customer_id, order_date, total_amount, status) VALUES (?, CURRENT_DATE(), ?, ?)");
    $stmt->bind_param("ids", $userId, $totalPrice, $status);
    $stmt->execute();
    $orderId = $stmt->insert_id; // Get the ID of the inserted order
    $stmt->close();

    // Redirect to order confirmation page or any other page as needed
    header("Location: order_confirmation.php?order_id=$orderId");
    exit();
}
?>
