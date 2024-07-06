<?php

include 'database.php';

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect user to login page or handle as needed
    header("Location: ../Authentication/log.php");
    exit();
}

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

// Retrieve cart count
$cart_count_query = "SELECT COUNT(*) AS cart_count FROM cart WHERE customer_id = $user_id";
$cart_count_result = $conn->query($cart_count_query);
if ($cart_count_result) {
    $cart_count_row = $cart_count_result->fetch_assoc();
    $cart_count = $cart_count_row['cart_count'];
} else {
    $cart_count = 0;
}

?>

<!-- Navbar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
<script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
<script src="../java script/index.js"></script>

<style>
    /* Custom CSS */
    .navbar {
        background-color: #464647;

    }

    .navbar-nav .nav-link {
        color: #ECE4E4;
        background-color: #464647;
        font-size: 20px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .navbar-nav .nav-link:hover {
        background-color: #464647;
        color: #20b066;
    }

    .dropdown-menu {
        background-color: #464647;
    }

    .dropdown-toggle {
        background-color: #464647;
        text-decoration: none;
    }

    .dropdown-item {
        padding: 10px 20px;
        background-color: #464647 !important;
        transition: background-color 0.3s;
    }

    .dropdown-menu .dropdown-item:hover {
        text-decoration: none;
        background-color: #464647;
        color: #2063B0;
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

<style>
    .nav-link {
        position: relative;
        /* Make the nav-link position relative */
    }

    .hover-box {
        position: absolute;
        top: 100%;
        left: 0;
        display: none;
        /* Initially hide the box */
        width: 250px;
        padding: 20px;
        background-color: #464647;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<nav class="navbar navbar-expand-lg mb-3" id="header">
    <a class="navbar-brand" href="#">
        <img src="../ICONS/Shopping Bag.png" alt="Shopping Bag">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul id="navbar" class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="../html/shop.php">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="../html/Order.php">Orders</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="mens_cloth.php">Man</a>
                    <a class="dropdown-item" href="wmens_cloths.php">Women</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="../html/abaut.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="../html/Contact.php">Contact</a></li>
            <!-- user only logd in -->
            <?php

            // Check if user is logged in and retrieve customer information
            if (isset($_SESSION['user'])) {
                // Retrieve customer information
                $stmt = $conn->prepare("SELECT first_name, last_name, email FROM Customers WHERE customer_id = ?");
                $stmt->bind_param("i", $_SESSION['user']['customer_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $customer = $result->fetch_assoc();
                $stmt->close();

                // Output the navigation item with the tooltip if customer information is available
                if ($customer) {
            ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/Profile.php">
                            <i class="fa-solid fa-user"></i>
                            <div class="hover-box">
                                <?php echo htmlspecialchars('User: ' . $customer['first_name'] . ' ' . $customer['last_name']); ?>
                            </div>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
            <li id="lg-bag" class="nav-item"><a class="nav-link" href="../html/cart.php"><i class="fas fa-shopping-bag"></i> <?php echo $cart_count; ?></a></li>
            <?php if (isset($_SESSION['customer_id'])) { ?>
                <li class="nav-item"><a class="nav-link" href="../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>