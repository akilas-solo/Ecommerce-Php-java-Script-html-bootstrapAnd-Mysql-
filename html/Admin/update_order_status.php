<?php
session_start();
include '../../Admin/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../Authentication/log.php");
    exit();
}

$order_id = $_POST['order_id'];
$status = $_POST['status'];

// Update order status
$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
$stmt->bind_param("si", $status, $order_id);

if ($stmt->execute()) {
    // Insert action into order_actions table
    $stmt_action = $conn->prepare("INSERT INTO order_actions (order_id, action) VALUES (?, ?)");
    $stmt_action->bind_param("is", $order_id, $status);
    $stmt_action->execute();
    $stmt_action->close();

    header("Location: Orderd_Products.php");
} else {
    echo "Error updating order status: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
