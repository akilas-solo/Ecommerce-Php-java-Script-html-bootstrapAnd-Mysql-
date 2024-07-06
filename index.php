<?php
include './html/Admin/database.php';
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
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/AddStyle.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <style>
        .explore {
            background-color: #D38E26;
            padding: 5px 25px 5px 25px;
            color: white;
            margin-top: 10px;
            border-color: #FFFFFF;
        }

        .explore:hover {
            color: white;
        }
    </style>

    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 584px;
            /* Adjust height as needed */
            background: linear-gradient(rgba(254, 254, 255, 0.184), rgba(221, 162, 35, 0.636));
            z-index: 1;
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
            top: 80px;
            margin-top: 70px !important;
        }

        .btncon {
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


        .content h3,
        h2 {
            animation: fadeInUp 1s ease-out 0.9s forwards;
            opacity: 0;
        }

        .contact {
            background-color: #FFFFFFEF;
            border: none;
            /* Optional: remove border */
            backdrop-filter: blur(10px);
            /* Frosted glass effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Optional: subtle shadow */
            border-radius: 15px;
            /* Optional: rounded corners */
            padding: 20px;
            /* Add padding for better spacing */
        }
    </style>

    <style>
        .carousel-item {
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .carousel-item.active {
            opacity: 1;
            animation: slideIn 0.8s forwards;
        }

        .carousel-indicators li {
            background-color: black;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
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
    <a class="" href="#">
        <img src="./ICONS/Shopping Bag.png" alt="Shopping Bag">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul id="navbar" class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="./html/shop.php">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="./html/Order.php">Orders</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./html/mens_cloth.php">Man</a>
                    <a class="dropdown-item" href="./html/wmens_cloths.php">Wmen</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="./html/abaut.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="./html/Contact.php">Contact</a></li>
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
                        <a class="nav-link" href="./html/Profile.php">
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
            <li id="lg-bag" class="nav-item"><a class="nav-link" href="./html/cart.php"><i class="fas fa-shopping-bag"></i> <?php echo $cart_count; ?></a></li>
            <?php if (isset($_SESSION['customer_id'])) { ?>
                <li class="nav-item"><a class="nav-link" href="./Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>

</head>




<body>

         <!-- Baner -->
    <div class="row " id="home" style="background-image: url('./Traditional_Clothses/Ethiopia.jfif'),url('./Traditional_Clothses/caro.jpg'); background-repeat: no-repeat,no-repeat; background-size: 50%,50%; background-position: left center,right center;">
        <div class="overlay">
            <h1>On all Products</h1>
        </div>
        <div id=" home-sec" class="col-md-12">
            <div class="content">
                <div class="content" style="position: relative; z-index: 1; width: 100%;">
                    <h3 class="text-center mt-5 con">Bringing Modern and Traditional Styles - Shop Now! </h4>
                        <a href="./html/shop.php" class="text-decoration-none aligh-center"><button class="btn1">Shop Now <i class="fa fa-shopping-cart icon"></i></button></a>
                        <hr style="color: white; width:100%; height: 3px;">
                </div>
            </div>
        </div>
    </div>



    <!-- Sume Sax -->
    <div class="container section-p1">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mt-5 text-warning">WELL COME TO ABISSINYA MODERN AND CULTURAL SHOP!</h5>
            </div>
            <div class="col-md-6">
                <p class="text-muted">
                    Embrace the Rich Heritage of Ethiopia with Our Exquisite Traditional Products:
                    Crafted by Expert Artisans and Traditional Workers, Our High-Quality Range of Clothing,
                    Accessories, Home Goods, and Spices are a True Representation of Ethiopia’s Rich Culture.
                    Proudly Made in Our Country and Seamlessly Shipped Worldwide,
                    Experience the Authenticity of Ethiopia’s Traditional Products Today!
                </p>
            </div>
        </div>
    </div>

    <!-- Image Baner Section -->
    <div class="container my-5">
        <h2 class="text-center mt-3 mb-3">Colections</h2>

        <div class="row">
            <div class="col-md-3">
                <div class="column-content">
                    <img src="./images/wmens/w1 (1).jfif" alt="Image 1">
                    <div class="column-description">
                        <p>Gorgeous Tilf Habesha Kemis with Shimena Dress</p>
                        <a href="./html/Colections/kemis.php" class="btn explore">Explore</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="column-content">
                    <img src="./images/modern wmen/mg1 (16).png" alt="Image 2">
                    <div class="column-description">
                        <p>Womens One Shoulder Ruffle Formal Dress</p>
                        <a href="./html/Colections/modern_wmen.php" class="btn explore">Explore</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="column-content">
                    <img src="./images/shemiz/f3.jpg" alt="Image 3">
                    <div class="column-description">
                        <p>Men's Button Down Dress Shirts Short Sleeve Casual Shirts</p>
                        <a href="./html/Colections/shemiz.php" class="btn explore">Explore</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="column-content">
                    <img src="./images/tra/chata 1 (3).jpg" alt="Image 4">
                    <div class="column-description">
                        <p>Men's Extreme Motion Flat Front Regular Straight Pant</p>
                        <a href="./html/Colections/suri.php" class="btn explore">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- carosel -->
    <div class="content" style="position: relative; z-index: 1; width: 100%;">
        <!-- Carousel -->
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000"> <!-- Set data-interval to auto-advance every 3 seconds -->
            <div class="carousel-inner">
                <!-- First Carousel Item -->
                <div class="carousel-item active">
                    <div class="row no-gutters align-items-center">

                        <div class="col" style="background-image: url('./Traditional_Clothses/T-sher2.jfif'),url('./Traditional_Clothses/konjo-700\ .png'),url('./Traditional_Clothses/T-sher3.jfif'); background-repeat: no-repeat,no-repeat,no-repeat; background-size: 30%,40%,30%; background-position: left center,center,right center; width:100%;height: 60vh;">
                            <h3 class="text-center my-5 pt-5 con text-white">Wear Ethiopian pride today!</h3>
                        </div>

                    </div>
                </div>
                <!-- Second Carousel Item -->
                <div class="carousel-item">
                    <div class="row no-gutters align-items-center">
                        <!-- First Column -->
                        <div class="col" style="background-image: url('./Traditional_Clothses/Ethiopia.jfif'),url('./Traditional_Clothses/Tigray_girl.jfif'),url('./Traditional_Clothses/Gojjam Amhara.jfif'); background-repeat: no-repeat,no-repeat,no-repeat; background-size: 30%,40%,30%; background-position: left center,center,right center; width:100%;height: 60vh;">

                            <h3 class="text-center my-5 pt-5 con text-white">Embrace Ethiopian tradition!</h3>

                        </div>

                    </div>
                </div>
                <!-- Add more carousel items here if needed -->
            </div>
            <!-- Carousel Navigation Controls -->
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!-- Navigation Icons at the Bottom -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExample" data-slide-to="1"></li>
                <!-- Add more indicators if needed -->
            </ol>
        </div>
    </div>


  
    <!-- New Arival Product  -->
    <section id="product1" class="section-p1">

        <h2>New Arrivals</h2>

        <div class="pro-container">
            <!-- Single Card -->
            <?php
            require_once "./html/Admin/database.php";

            // Retrieve the product data from the database
            $result = $conn->query("SELECT * FROM Products LIMIT 8");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $productName = $row["product_name"];
                    $productImage = $row["image_url"];
                    $productPrice = $row["price"];
                    $productDescription = $row["description"];
                    echo '<style> 
                        .limited-text {
                        max-width: 300px;
                        max-height: 50px;
                        overflow: hidden;
                        }
                         </style>';
                    echo '<div class="pro" onclick="window.location.href=\'./html/single_product.php\'">';
                    echo '<img src="./html/Admin/db Manipulation/' . $productImage . '" alt="">';
                    echo '<div class="des">';
                    echo '<h5>' . $productName . '</h5>';
                    echo '<span  class="d-flex flex-fill limited-text">' . $productDescription . '</span>';
                    echo '<div class="star">';
                    echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                    echo '</div>';
                    echo '<h4>ETB  ' . $productPrice . '</h4>';
                    echo '</div>';
                    echo '<a href="./html/shop.php"><i class="fa-solid fa-cart-shopping " id="cart"></i></i></a>';
                    echo '</div>';
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


    </section>



    <h2 class="text-center mt-4"> Testimonials </h2>
    <!-- Carousel wrapper -->
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-ride="carousel">

        <!-- Inner -->
        <div class="carousel-inner py-4">
            <!-- Single item -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="img/people/face1 (1).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                As a UX designer with a keen eye for detail and cultural authenticity, I'm always on the lookout for platforms that not only provide a seamless user experience but also showcase the richness of diverse cultures. My experience with [Your E-commerce Website] was nothing short of exceptional.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 d-none d-lg-block">
                            <img class="rounded-circle shadow-1-strong mb-4" src="img/people/newface4.jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Weynshet</h5>
                            <p>Web Developer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                As a web developer tasked with creating user-friendly and visually appealing online platforms, I've had the opportunity to collaborate with various e-commerce websites. However, my experience with [Your E-commerce Website] stood out as a testament to excellence in web development
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star-half-alt fa-sm"></i></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 d-none d-lg-block">
                            <img class="rounded-circle shadow-1-strong mb-4" src="img/people/face1 (3).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Maria Kate</h5>
                            <p>Photographer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                As a photographer specializing in cultural and traditional portraits, finding authentic attire that not only captures the essence of Ethiopian heritage but also accentuates the beauty of my subjects has always been a priority. I stumbled upon [Your E-commerce Website] while searching for Ethiopian traditional clothing for a special photoshoot, and I must say, it was a game-changer.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="far fa-star fa-sm"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single item -->
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/face1 (6).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/face1 (5).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>

                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/face1 (7).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/neface1.jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/newface2.jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <img class="rounded-circle shadow-1-strong mb-4" src="./img/people/face1 (4).jfif" alt="avatar" style="width: 150px;" />
                            <h5 class="mb-3">Anna Deynah</h5>
                            <p>UX Designer</p>
                            <p class="text-muted">
                                <i class="fas fa-quote-left pe-2"></i>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                            </p>
                            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                                <li><i class="fas fa-star fa-sm"></i></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Inner -->
        <!-- Controls -->
        <div class="d-flex justify-content-center mb-4">
            <button class="carousel-control-prev position-relative" type="button" data-target="#carouselMultiItemExample" data-slide="prev">
                <span class="carousel-control-prev-icon text-body" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next position-relative" type="button" data-target="#carouselMultiItemExample" data-slide="next">
                <span class="carousel-control-next-icon text-body" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>



    <!-- footer Section -->
    <div class="col-md-12 p-0 m- mt-4">
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <h5>About Us</h5>
                        <p>We are committed to providing high-quality
                            products and excellent customer service.<a href="./html/abaut.php">more</a></p>

                    </div>
                    <div class="col-md-3">
                        <h5>Our Products</h5>
                        <p>Discover our latest collection of premium products.
                            <a href="./html/Contact.php">Contact</a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h5>Contact Us</h5>
                        <p>Have questions? Reach out to our customer support team.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Connect with Us</h5>
                        <div class="social-icons">
                            <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copy-right">
            <p>&copy; 2024, Akilas etc - HTML CSS E-commerce Template</p>
        </div>
    </div>


</body>

<script src="./java script/index.js"></script>
<script src="./css/bootstrap/jquery.js"></script>
<script src="./css/bootstrap/bootstrap.min.js"></script>

</html>