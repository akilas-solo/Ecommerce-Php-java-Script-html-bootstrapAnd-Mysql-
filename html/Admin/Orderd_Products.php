<?php
// Include database connection
include 'database.php';
include 'populate_order_items.php';
session_start();

// Check if the form is submitted for updating order status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if order_id and status are set
    if (isset($_POST["order_id"]) && isset($_POST["status"])) {
        $order_id = $_POST["order_id"];
        $status = $_POST["status"];

        // Update the order status in the database
        $updateQuery = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            echo "Error updating order status: " . mysqli_error($conn);
        } else {
        }
    } else {
        echo "Order ID and status are required.";
    }
}

// Fetch existing orders with their details
$orderQuery = "
    SELECT o.order_id, o.order_date, o.total_price, o.payment_method, o.shipping_address, o.status, 
           c.first_name, c.last_name, c.email, c.address AS customer_address,
           p.product_name, oi.quantity, oi.product_price
    FROM orders o
    JOIN customers c ON o.customer_id = c.customer_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.product_id
    ORDER BY o.order_date DESC
";
$orderResult = mysqli_query($conn, $orderQuery);

// Check if there are any orders
if (!$orderResult) {
    die("Error fetching orders: " . mysqli_error($conn));
}

// Initialize an array to store order details
$orderHistory = [];

// Fetch and store order details
while ($row = mysqli_fetch_assoc($orderResult)) {
    $orderHistory[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orderd Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <style>
        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            height: 100vh;
            padding: 20px;
            background: linear-gradient(135deg, #1f1e1ed7, #1c1c1d);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .side-link {
            justify-content: flex-start;
            align-items: flex-start;
        }

        .side-link i,
        img {
            margin-right: 20px;
        }

        .side-link a {
            color: rgb(219, 219, 219);
            font-size: 19px;
            justify-content: center;
            align-items: start;
        }

        .side-link a:hover {
            color: rgb(254, 255, 255);
            font-size: 20.5px;
        }

        .side-link img {
            width: 30px;
        }
    </style>

</head>

<body>

    <!-- Header Section -->
    <?php include 'Navbar.php' ?>

    <div class="row">

        <div class="col-12   mx-auto">
            <h3 class="text-center mt-4"><i class="fa-solid fa-cart-shopping"></i>Orderd Product</h3>
            <div class="container-fluid custem_panal p-3 mb-3">
                <div class="row">
                    <!-- Table Section -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table p-3 border-3 rounded">
                                <thead class="p-3" style="background: linear-gradient(135deg, #1f1e1ed7, #1c1c1d); color:white;">
                                    <tr class="p-3 m-2">
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($orderHistory)) : ?>
                                        <tr>
                                            <td colspan="10">No orders found.</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($orderHistory as $order) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                                <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
                                                <td><?php echo htmlspecialchars($order['email']); ?></td>
                                                <td><?php echo htmlspecialchars($order['customer_address']); ?></td>
                                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                                <td><?php echo number_format($order['product_price'], 2); ?></td>
                                                <td><?php echo number_format($order['total_price'], 2); ?></td>
                                                <td><?php echo htmlspecialchars($order['status']); ?></td>
                                                <td>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                                        <select name="status" class="form-control" required>
                                                            <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="Approved" <?php echo $order['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                                                            <option value="Rejected" <?php echo $order['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Footer Section -->
    <div class="col-md-12 p-0 m-0 mt-4">
        <?php include '../../php_script/footer.php' ?>
    </div>


</body>
<script src="../../java script/index.js"></script>
<script src="../../css/bootstrap/jquery.js"></script>
<script src="../../css/bootstrap/bootstrap.min.js"></script>

</html>