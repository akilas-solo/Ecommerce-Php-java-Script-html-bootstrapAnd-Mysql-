<?php
session_start();
include './Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

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
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header Section -->
    <?php include "../php_script/Navbar.php"; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 mb-4">
                <h2>Checkout</h2>
                <form action="./ChekOut/chekout_proces.php" method="post">
                    <div class="form-group">
                        <label for="customer_name">Name:</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Phone:</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Address:</label>
                        <input type="text" class="form-control" id="customer_address" name="customer_address" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method:</label>
                        <select class="form-control" id="payment_method" name="payment_method" required>
                            <option value="Credit Card">Credit Card</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address:</label>
                        <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price:</label>
                        <input type="text" class="form-control" id="total_price" name="total_price" readonly value="<?php echo number_format($totalPrice, 2, '.', ''); ?>">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Checkout
                    </button>
                    <a href="shop.php" class="btn btn-primary">
                        <i class="fa fa-shopping-cart"></i> Continue Shopping
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include "../php_script/footer.php"; ?>
</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>
</html>
