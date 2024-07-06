<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
</head>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <h1>Thank You!</h1>
                <p>Your order has been placed successfully.</p>
                <p>Order details have been sent to your email.</p>
                <a href="../shop.php" class="btn btn-primary mt-3">
                    <i class="fa fa-shopping-cart"></i> Continue Shopping
                </a>
                <a href="Order_history.php" class="btn btn-success mt-3">
                    <i class="fa fa-list"></i> View Order History
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
