<?php
session_start();
include '../Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Retrieve order history from the database
$stmt = $conn->prepare("SELECT order_id, customer_name, customer_phone, customer_address, payment_method, shipping_address, total_price, order_date FROM orders WHERE customer_id = ? ORDER BY order_date DESC");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$orderHistory = [];

while ($row = $result->fetch_assoc()) {
    $orderHistory[] = $row;
}

$stmt->close();

// Retrieve cart items from the database
$stmt = $conn->prepare("SELECT cart_id, product_id, name, price, quantity, image FROM cart WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
$totalPrice = 0;

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $totalPrice += $row['price'] * $row['quantity'];
}

$stmt->close();

// Retrieve cart count
$stmt = $conn->prepare("SELECT COUNT(*) AS cart_count FROM cart WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$stmt->bind_result($cart_count);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <style>
        /* Custom CSS */
        .navbar {
            background-color: #464647;
        }

        .navbar-nav .nav-link {
            color: #F8F4F4;
            background-color: #464647;
            font-size: 20px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: #464647;
        }

        .dropdown-menu {
            background-color: #464647;
        }

        .dropdown-item {
            color: #ffffff;
            padding: 10px 20px;
            background-color: #464647;
        }

        .nav-item .dropdown {
            background-color: #464647 !important;
            text-decoration: none;
        }

        .dropdown-menu .dropdown-item {
            background-color: #464647 !important;
            text-decoration: none;
            color: #FAFAFA;
        }

        .dropdown-toggle {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg">
        <a href="#"><img src="../../ICONS/Shopping Bag.png" alt="Shopping Bag"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul id="navbar" class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="../Order.php">Orders</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../mens_cloth.php">Man</a>
                        <a class="dropdown-item" href="../wmens_cloths.php">Women</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="../blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="../about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="../Contact.php">Contact</a></li>
                <li id="lg-bag" class="nav-item"><a class="nav-link" href="../cart.php"><i class="fas fa-shopping-bag"></i> <?php echo $cart_count; ?></a></li>
                <?php if (isset($_SESSION['customer_id'])) { ?>
                    <li class="nav-item"><a class="nav-link" href="../../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Order History</h2>
        <div class="row">
            <div class="col-12">
                <?php if (empty($orderHistory)) : ?>
                    <p>You have no orders yet.</p>
                <?php else : ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Payment Method</th>
                                <th>Shipping Address</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderHistory as $order) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_address']); ?></td>
                                    <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                                    <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                                    <td><?php echo number_format($order['total_price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <a href="../shop.php" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include "../../php_script/footer.php"; ?>

</body>
<script src="../../java script/index.js"></script>
<script src="../../css/bootstrap/jquery.js"></script>
<script src="../../css/bootstrap/bootstrap.min.js"></script>

</html>
