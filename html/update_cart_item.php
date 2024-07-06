<?php
session_start();
include './Admin/database.php';

if (isset($_POST['update_cart'])) {
    $quantities = $_POST['quantity'];

    foreach ($quantities as $cart_id => $quantity) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ? AND customer_id = ?");
        $stmt->bind_param("iii", $quantity, $cart_id, $_SESSION['customer_id']);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header("Location: cart.php");
exit();
?>
