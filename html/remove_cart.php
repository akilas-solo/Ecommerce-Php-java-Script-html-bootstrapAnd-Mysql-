<?php
session_start();
include './Admin/database.php';

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ? AND customer_id = ?");
    $stmt->bind_param("ii", $cart_id, $_SESSION['customer_id']);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: cart.php");
exit();
?>
