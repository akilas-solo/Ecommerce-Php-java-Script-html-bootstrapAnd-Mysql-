<?php
// Include database connection
include 'database.php';

// Fetch existing orders
$orderQuery = "SELECT order_id, quantity FROM orders";
$orderResult = mysqli_query($conn, $orderQuery);

if (!$orderResult) {
    die("Error fetching orders: " . mysqli_error($conn));
}

// Fetch existing products
$productQuery = "SELECT product_id, price FROM Products";
$productResult = mysqli_query($conn, $productQuery);

if (!$productResult) {
    die("Error fetching products: " . mysqli_error($conn));
}

// Prepare an array to store products
$products = [];
while ($productRow = mysqli_fetch_assoc($productResult)) {
    $products[] = $productRow;
}

// Function to get a product
function getProduct($products, $index)
{
    return $products[$index % count($products)];
}

// Insert order items for each order
while ($orderRow = mysqli_fetch_assoc($orderResult)) {
    $order_id = $orderRow['order_id'];
    $quantity = $orderRow['quantity'];

    // Check if order items already exist for this order
    $checkOrderItemQuery = "SELECT COUNT(*) AS num_order_items FROM order_items WHERE order_id = $order_id";
    $checkOrderItemResult = mysqli_query($conn, $checkOrderItemQuery);

    if (!$checkOrderItemResult) {
        die("Error checking order items: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($checkOrderItemResult);
    $num_order_items = $row['num_order_items'];

    if ($num_order_items == 0) { // If no order items exist for this order ID
        // Insert new order items
        for ($i = 0; $i < $quantity; $i++) {
            $product = getProduct($products, $i);
            $product_id = $product['product_id'];
            $product_price = $product['price'];

            $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, product_price) 
                                     VALUES ($order_id, $product_id, 1, $product_price)"; // Set quantity to 1

            if (!mysqli_query($conn, $insertOrderItemQuery)) {
                // Handle error
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
