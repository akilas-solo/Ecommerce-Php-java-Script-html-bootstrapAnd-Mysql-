<?php
session_start();
include './Admin/database.php';

$user_id = $_SESSION['customer_id'];

// Retrieve cart items from the database
$stmt = $conn->prepare("SELECT cart_id, product_id, name, price, quantity, image FROM cart WHERE customer_id = ?");
$stmt->bind_param("i", $user_id);
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
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/cart.css">

    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
    <style>
        /* Add your custom CSS for table styling here */
        .table-container {
            position: relative;
            margin-bottom: 50px;
            /* Ensure space below the table for the button */
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include "../php_script/Navbar.php"; ?>

    <!-- Cart Section -->

    <section id="cart" class="section-p1 section-m1">
        <div class="container mb-2">
            <div class="table-container mt-3">

                <form action="update_cart_item.php" method="post">
                    <?php if (empty($cartItems)) { ?>
                        <p>No items in the cart</p>
                    <?php } else { ?>
                        <table class="cart-table mb-4">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Remove</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                <?php foreach ($cartItems as $item) { ?>
                                    <tr>
                                        <td><img src="./Admin/db Manipulation/<?php echo htmlspecialchars($item['image']); ?>" alt="Cart Image" width="100"></td>
                                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                                        <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                                        <td><a href="remove_cart.php?cart_id=<?php echo htmlspecialchars($item['cart_id']); ?>" class="btn btn-danger">Remove</a></td>
                                        <td><input type="number" name="quantity[<?php echo htmlspecialchars($item['cart_id']); ?>]" class="quantity-input" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1"></td>
                                        <td>$<?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>

            </div><!-- Update Cart button -->
            <button type="submit" name="update_cart" class="btn btn-success ">Update Cart</button>
            </form>
        </div>
        <!-- Cart Description -->
        <div class="cart-desc">
            <div class="disc">
                <div id="discription" class="text-center">
                    <h6>Total Price: <span id="total-price">$<?php echo $totalPrice; ?></span></h6>

                    <div class="d-inline-block">
                        <a href="shop.php" class="btn btn-primary mx-2">
                            <i class="fa fa-shopping-cart"></i> Continue Shopping
                        </a>
                        <a href="Checkout.php" class="btn btn-success mx-2">
                            <i class="fa fa-check"></i> Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>


        </div>

    </section>

    <!-- Footer Section -->
    <?php include "../php_script/footer.php"; ?>
</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>
<script>

</script>

</html>