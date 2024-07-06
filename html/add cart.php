<?php

include './Admin/database.php';
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is not logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location:../Authentication/log.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['customer_id'];

    // Check if the necessary POST data is set
    if (!isset($_POST['product_id']) || !isset($_POST['product_name']) || !isset($_POST['product_price']) || !isset($_POST['product_image'])) {
        die('Required POST data is missing');
    }

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    // Check if the product already exists in the cart
    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND customer_id = ? AND product_id =?" );
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sii", $product_name, $user_id,$product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result === false) {
        die('Get result failed: ' . htmlspecialchars($stmt->error));
    }

    // Include HTML header for Bootstrap CSS
    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Cart Status</title>
              <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
              <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
              <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
              </head>
          <body>';

    if ($result->num_rows > 0) {
        // Product already exists in cart
        echo '<div class="container mt-5">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="alert alert-warning text-center" role="alert">
                            <h4 class="alert-heading">Product Already in Cart!</h4>
                            <p>The product is already in your cart.</p>
                            <a href="shop.php" class="btn btn-primary mt-3">
                                <i class="fa fa-shopping-cart"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
              </div>';
    } else {
        // Insert the product into the cart table
        $stmt = $conn->prepare("INSERT INTO `cart` (`customer_id`, `product_id`, `name`, `price`, `quantity`, `image`) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("iisids", $user_id, $product_id, $product_name, $product_price, $product_quantity, $product_image);
        $stmt->execute();
        if ($stmt->error) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        // Product successfully added to the cart
        echo '<div class="container mt-5">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="alert alert-success text-center" role="alert">
                            <h4 class="alert-heading">Item Added to Cart!</h4>
                            <p>Your item has been added to the cart successfully.</p>
                            <a href="shop.php" class="btn btn-primary mt-3">
                                <i class="fa fa-shopping-cart"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
              </div>';
    }

    // Include HTML footer for closing tags
    echo '</body></html>';
}
?>
