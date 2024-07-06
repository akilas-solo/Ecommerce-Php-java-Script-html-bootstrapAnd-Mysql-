<?php
include './Admin/database.php';
session_start();


if (!isset($_SESSION['customer_id'])) {
    $cart_count = 0;
} else {
    // Check if customer_id is set in session
    if (isset($_SESSION['customer_id'])) {
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
    } else {
        $cart_count = 0;
    }
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $comment = $_POST['comment'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Contacts (full_name, email, sex, address, comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $sex, $address, $comment);

    // Execute the statement
    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['success_message'] = 'Message Sent successfully';
    } else {
        // Set error message in session
        $_SESSION['error_message'] = 'Error: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Redirect to the same page to display the message
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}


?>

<!-- Rest of your HTML code -->


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/abaut.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
    <style>
        
    </style>

    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg " id="header">
        <a class="navbar-brand" href="#">
            <img src="../ICONS/Shopping Bag.png" alt="Shopping Bag">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul id="navbar" class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="Order.php">Orders</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="mens_cloth.php">Man</a>
                        <a class="dropdown-item" href="wmens_cloths.php">Wmen</a>
                    </div>
                </li>
                
                <li class="nav-item"><a class="nav-link" href="abaut.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="Contact.php">Contact</a></li>
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
                            <a class="nav-link" href="Profile.php">
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

                <li id="lg-bag" class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-bag"></i> <?php echo $cart_count; ?></a></li>
                <?php if (isset($_SESSION['customer_id'])) { ?>
                    <li class="nav-item"><a class="nav-link" href="../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

<body>

    <div class="row " id="home" style="background-image: url('../img/contact.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div id=" home-sec" class="col-md-12">
            <div class="content">
                <h3 class="text-center mt-5 con">Contact Us
                    <hr style="color: white; width:100%; height: 3px;">
                </h3>

                <!-- Contact Us form -->
                <div class="contact mb-0 pm-0">
                    <div class="row justify-content-start">
                        <div class="col-md-7"></div>

                        <div class="col-md-5 mb-2">
                            <div class="glass-form">
                                <!-- Display success or error message -->
                                <?php if (isset($_SESSION['success_message'])) : ?>
                                    <div class="container mt-4">
                                        <div class="alert alert-success text-center m-4" role="alert">
                                            <?php echo $_SESSION['success_message']; ?>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['success_message']); ?>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['error_message'])) : ?>
                                    <div class="container mt-4">
                                        <div class="alert alert-danger text-center m-4" role="alert">
                                            <?php echo $_SESSION['error_message']; ?>
                                        </div>
                                    </div>
                                    <?php unset($_SESSION['error_message']); ?>
                                <?php endif; ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select class="form-control" id="sex" name="sex">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-8"></div>
                    </div>

                </div>

            </div>
        </div>

        <!-- footer Section -->
        <?php include "../php_script/footer.php"; ?>
    </div>
</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>

</html>