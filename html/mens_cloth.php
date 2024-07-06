<?php
include './Admin/database.php';
session_start();

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <style>
        .column-content {
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .column-content img {
            max-width: 100%;
            width: 300px;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .column-content:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .column-content:hover img {
            transform: scale(1.1);
        }

        .column-description {
            margin-top: 10px;
            font-size: 20px;
            color: #bd971d;
        }

        .carousel-control-icon {
            color: #007bff;
            font-size: 30px;
            margin: 0 5px;
        }

        .carousel-control-icon:hover {
            color: #0056b3;
        }

        .carousel-indicators {
            bottom: -30px;
        }

        .carousel-indicators li {
            background-color: #ccc;
            border-radius: 50%;
            width: 12px;
            height: 12px;
        }

        .carousel-indicators .active {
            background-color: #bd971d;
        }



        /*  */
        .pro-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .pro {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(33.333% - 40px);
            /* Adjusted for gap and padding */
            max-width: 300px;
            text-align: center;
            transition: transform 0.3s;
        }

        .pro img {
            width: 100%;
            height: auto;
        }

        .des {
            padding: 20px;
        }

        .des h5 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .limited-text {
            font-size: 14px;
            color: #777;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .star {
            margin: 10px 0;
        }

        .price-cart {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-cart h4 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .price-cart form {
            margin: 0;
        }

        .price-cart button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .price-cart button i {
            font-size: 20px;
            color: #333;
        }

        .pro:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include "../php_script/Navbar.php"; ?>


    <!-- Product Card -->
    <section id="product1" class="section-p1">
        <h2>Discover Abissinya Closet: Bridging Modern and Traditional Styles - Shop Now!</h2>
        <p> New Modern Design Collection</p>

        <div class="container mt-4">

            <div class="pro-container">
                <?php
                // Assuming you have established a database connection
                require_once "./Admin/database.php";
                $category_id = 1;
                // Retrieve the product data from the database
                $result = $conn->query("SELECT * FROM Products WHERE category_id = $category_id LIMIT 8");
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row["product_id"];
                        $productName = $row["product_name"];
                        $productImage = $row["image_url"];
                        $productPrice = $row["price"];
                        $productDescription = $row["description"];
                ?>
                        <div class="pro">
                            <img src="./Admin/db Manipulation/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                            <div class="des">
                                <h5><?php echo $productName; ?></h5>
                                <span class="d-flex flex-fill limited-text"><?php echo $productDescription; ?></span>
                                <div class="star">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                                <div class="price-cart">
                                    <h4>$<?php echo $productPrice; ?></h4>
                                    <form id="cartForm_<?php echo $productId; ?>" action="add cart.php" method="POST">
                                        <!-- Include hidden input fields for product details -->
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
                                        <button type="submit" name="submit">
                                            <i class="fa-solid fa-cart-shopping" id="cart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }

                    // Free the result set
                    $result->free();
                } else {
                    echo "Error retrieving products.";
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>

        </div>


    </section>


    <!-- footer Section -->
    <?php include "../php_script/footer.php"; ?>

</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>

</html>