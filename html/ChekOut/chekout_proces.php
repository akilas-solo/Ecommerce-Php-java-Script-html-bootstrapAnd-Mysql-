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

// Begin a transaction
$conn->begin_transaction();

try {
    // Retrieve customer balance
    $stmt_balance = $conn->prepare("SELECT balance FROM Customers WHERE customer_id = ?");
    $stmt_balance->bind_param("i", $customer_id);
    $stmt_balance->execute();
    $stmt_balance->bind_result($balance);
    $stmt_balance->fetch();
    $stmt_balance->close();

    // Check if the user has enough balance
    if ($balance < $total_price) {
        $_SESSION['alert_message'] = 'Insufficient balance. Please add funds to your account.';
        header("Location: ../cart.php");
        exit();
    }

    // Calculate new balance
    $new_balance = $balance - $total_price;

    // Update customer balance
    $stmt_update_balance = $conn->prepare("UPDATE Customers SET balance = ? WHERE customer_id = ?");
    $stmt_update_balance->bind_param("di", $new_balance, $customer_id);
    $stmt_update_balance->execute();
    $stmt_update_balance->close();

    // Insert order into orders table
    $stmt_order = $conn->prepare("INSERT INTO orders (customer_id, customer_name, customer_phone, customer_address, payment_method, shipping_address, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_order->bind_param("isssssd", $customer_id, $customer_name, $customer_phone, $customer_address, $payment_method, $shipping_address, $total_price);
    $stmt_order->execute();
    $order_id = $stmt_order->insert_id;
    $stmt_order->close();

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
    $stmt_clear_cart = $conn->prepare("DELETE FROM cart WHERE customer_id = ?");
    $stmt_clear_cart->bind_param("i", $customer_id);
    $stmt_clear_cart->execute();
    $stmt_clear_cart->close();

    // Commit the transaction
    $conn->commit();

    // Set success message and redirect to confirmation page
    $_SESSION['checkout_status'] = 'success';
    header("Location: comformation.php");
    exit();
} catch (Exception $e) {
    // Rollback the transaction in case of any errors
    $conn->rollback();

    // Set alert message and log the error
    $_SESSION['alert_message'] = 'There was an error during checkout. Please try again.';
    error_log($e->getMessage());

    // Redirect back to the cart page
    header("Location: ../cart.php");
    exit();
} finally {
    $conn->close();
}
?>
