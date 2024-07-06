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
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaut</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/abaut.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <!-- nav -->
    <style>
        /* Custom CSS */
        .navbar {
            background-color: #464647;
            /* Change background color */
        }

        .navbar-nav .nav-link {
            color: #F8F4F4;
            /* Change text color */
            background-color: #464647;
            font-size: 24px;
            padding: 10px 20px;
            transition: background-color 0.3s;
            /* Add transition for smooth hover effect */
        }

        .navbar-nav .nav-link:hover {
            background-color: #464647;
            /* Change background color on hover */
        }

        .dropdown-menu {
            background-color: #464647;
            /* Change background color of dropdown menu */
        }

        .dropdown-item {
            color: #ffffff;
            /* Change text color of dropdown items */
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

    <style>
        body {
            font-family: Arial, sans-serif;

            color: #fff;
            margin: 0;
            padding: 0;
        }

        .feature-item {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            transition: transform 0.8s;
        }

        .feature-item h2,
        h3 {
            color: #20b066;
            margin-bottom: 20px;
        }

        .feature-item p,
        .feature-item ul {
            color: black;
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #20b066;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            color: #fff;
            text-decoration: none;
            background-color: #1a8c5e;
        }



        .section-m1 .discription {
            color: #000000;
            /* Set text color to black */
        }



        /* contact us form */


        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #464647 !important;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .form-control:focus {
            border-color: #464647 !important;
            box-shadow: 0 0 0 0.2rem rgba(70, 70, 71, 0.25);
        }

        .btn-primary {
            background-color: #464647 !important;
            border-color: #464647 !important;
        }

        .btn-primary:hover {
            background-color: #2a2b2b;
            border-color: #2a2b2b;
        }


        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 584px;
            /* Adjust height as needed */
            background: linear-gradient(rgba(254, 254, 255, 0.184), rgba(221, 162, 35, 0.636));
            z-index: 2;
            /* Ensure the overlay is above other elements */
        }


        #home {
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            width: 100%;
            height: 500px;
            padding: 0;
            margin: 0;
            background: linear-gradient(rgba(254, 254, 255, 0.184), rgba(221, 162, 35, 0.636));

        }

        #home-sec {
            position: relative;
            z-index: 1;
        }

        .con {
            color: white;
            font-size: 40px;
            top: 50px;
            margin-top: 70px !important;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }


        .content h3 {
            animation: fadeInUp 1s ease-out 0.9s forwards;
            opacity: 0;
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

    <div class="row " id="home" style="background-image: url('../Traditional_Clothses/Ethiopia.jfif'),url('../Traditional_Clothses/Tigray_girl.jfif'); background-repeat: no-repeat,no-repeat; background-size: 50%,50%; background-position: left center,right center;">
        <div class="overlay"></div>
        <div id=" home-sec" class="col-md-12">
            <div class="content">
                <h3 class="text-center mt-5 con">ABOUT ABISSINYA SHOP
                    <hr style="color: white; width:100%; height: 3px;">
                </h3>
            </div>
        </div>
    </div>


    <!-- Scetion Tow landing page -->

    <!-- Who We Are -->
    <section id="who-we-are" class="my-2 align-left">
        <div class="container mt-5">
            <div class="row mt-5">
                <div class="col-md-6 mt-5">
                    <div class="description">
                        <h3 class="text-center">ABISINYA MODERN AND CULTURAL ClOSETS SHOP</h3>
                        <p style="color: #2E2D2C;">Discover the vibrant and diverse fashion heritage of Ethiopia at ABISINYA, your ultimate online destination for exquisite Ethiopian cultural and contemporary clothing, as well as beautifully designed closets to store your cherished garments.</p>
                        <p style="color: #2E2D2B;">Our carefully curated collection showcases the richness of Ethiopia's traditional attire alongside chic modern designs, offering a unique blend of past and present.</p>
                        <marquee behavior="" direction="left">
                            <p style="color: #EEAC57;">Welcome to ABISINYA MODERN AND CULTURAL Closet SHOP! We are thrilled to have you join us on our journey to explore the vibrant and diverse fashion heritage of Ethiopia</p>
                        </marquee>
                        <a href="shop.php" class="cta-button">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sume sax -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="feature-item">
                    <h2>Our Collection</h2>
                    <h3>Cultural Dresses</h3>
                    <p style="color: #2E2D2C;">Explore our selection of traditional Ethiopian dresses, known for their intricate handwoven patterns and stunning embroidery. Each piece is a testament to the skilled craftsmanship passed down through generations. From the elegant Habesha Kemis to the vibrant Tibeb dresses, our cultural attire is perfect for weddings, cultural events, and special occasions.</p>
                    <h3>Custom Closets</h3>
                    <p style="color: #2E2D2C;">Organizing your wardrobe can be a game-changer in terms of efficiency and aesthetics. With our custom-designed closets, you're not just getting a storage solution; you're investing in a tailored experience that harmonizes functionality with style. Our closets are meticulously crafted to cater to your unique requirements. Need more hanging space for your collection of dresses? No problem. Require specialized compartments for your accessories, from jewelry to handbags? Consider it done. We understand that every individual has different storage needs</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-item">
                    <h2>Why Shop with Us?</h2>
                    <ul>
                        <li style="color: #2E2D2C;"><strong>Authenticity</strong>: We are committed to promoting authentic Ethiopian craftsmanship. Every item in our store is sourced directly from local artisans and designers.</li>
                        <li style="color: #2E2D2C;"><strong>Quality</strong>: We prioritize quality in every piece we offer. Our clothing and closets are made from high-quality materials to ensure comfort, durability, and style.</li>
                        <li style="color: #2E2D2C;"><strong>Cultural Heritage</strong>: By shopping with us, you are supporting Ethiopian culture and the artisans who keep these traditions alive.</li>
                        <li style="color: #2E2D2C;"><strong>Customer Satisfaction</strong>: We strive to provide an excellent shopping experience with secure payment options, reliable shipping, and responsive customer service.</li>
                    </ul>
                    <h2>Join Our Community</h2>
                    <p>ABISINYA is more than just a store; it's a celebration of Ethiopian culture and fashion. Join our community of fashion enthusiasts and cultural aficionados. Follow us on social media, subscribe to our newsletter, and be the first to know about new arrivals, special offers, and cultural insights.</p>
                </div>
            </div>
        </div>

    </div>


    <!-- footer Section -->
    <?php include "../php_script/footer.php"; ?>
</body>
<script src="../java script/index.js"></script>
<script src="../css/bootstrap/jquery.js"></script>
<script src="../css/bootstrap/bootstrap.min.js"></script>

</html>