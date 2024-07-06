<?php
session_start();
include '../Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['customer_phone'];
$customer_address = $_POST['customer_address'];
$payment_method = $_POST['payment_method'];
$shipping_address = $_POST['shipping_address'];
$total_price = $_POST['total_price'];

// Format total price to ensure it's a decimal with 2 decimal places
$total_price = number_format((float)$total_price, 2, '.', '');

// Insert order into orders table
$stmt = $conn->prepare("INSERT INTO orders (customer_id, customer_name, customer_phone, customer_address, payment_method, shipping_address, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssd", $customer_id, $customer_name, $customer_phone, $customer_address, $payment_method, $shipping_address, $total_price);

if ($stmt->execute()) {
    // Get the order ID of the newly inserted order
    $order_id = $stmt->insert_id;

    // Insert each cart item into the order_items table
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt_item->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt_item->execute();
        $stmt_item->close();
    }

    // Clear the cart after successful order
    $stmt = $conn->prepare("DELETE FROM cart WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $stmt->close();

    header("Location: comformation.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
