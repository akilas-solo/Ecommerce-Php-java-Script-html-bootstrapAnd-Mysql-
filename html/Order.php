<?php
session_start();
include './Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Retrieve customer information
$stmt = $conn->prepare("SELECT first_name, last_name FROM Customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$stmt->close();

// Retrieve orders from the database
$stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
    <style>

    </style>

</head>

<body>
    <!-- Header Section -->
    <?php include "../php_script/Navbar.php"; ?>

    <div class="container mt-5">
        <h2>My Orders</h2>
        <p>Customer: <?php echo htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?></p>
        <?php if (count($orders) > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Shipping Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td>ETB <?php echo htmlspecialchars($order['total_price']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                            <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No orders found.</p>
        <?php } ?>
    </div>

    <a href="shop.php" class="btn btn-primary mt-4 ml-4 mb-3">
        <i class="fa fa-shopping-cart"></i> Continue Shopping
    </a>

    <!-- Footer Section -->
    <?php include "../php_script/footer.php"; ?>

</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>

</html>