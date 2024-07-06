<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/abaut.css">
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="styel.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">

    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

    <!-- Header Section -->
    <?php include "Navbar.php"; ?>

</head>

<body>

    <div class="row">

        <div class="col-md-12 mt-4">

            <!-- Add New Card section -->
            <div class="col-md-11  m-3">
                <h3 class="text-center mt-3 mb-4"><i class="fa-solid fa-plus"></i>Add Product</h3>

                <section class="Admin-section section-p1 section-m1">
                    <!-- data insertion form -->
                    <div class="container_form">
                        <div class="title">Add New Product</div>
                        <div class="content">

                            <form action="http://localhost/WEB%20PROJECT%201/html/Admin/db Manipulation/Add_product.php" method="post" enctype="multipart/form-data">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Product Name</span>
                                        <input name="Product-name" class="input" type="text" placeholder="Enter Product name" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Product Image</span>
                                        <div class="file-input">
                                            <input name="Product-img" type="file" id="cart-image" accept="image/*" required>
                                            <label for="Product-image">
                                                <span class="file-icon"><i class="fas fa-upload"></i></span>
                                                <span class="file-name">Choose a file</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Product Description</span>
                                        <textarea name="Product-description" class="textarea" placeholder="Enter Product Description" required></textarea>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Product Price</span>
                                        <input name="Product-price" class="input" type="text" placeholder="Enter Product Price" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Product Chatagori ID</span>
                                        <input name="chatagori_id" class="input" type="text" placeholder="Enter Product Chatagori" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Product Chatagori Name</span>
                                        <input name="chatagori_name" class="input" type="text" placeholder="Enter Product Chatagori" required>
                                    </div>

                                </div>
                                <div class="button">
                                    <input type="submit" value="Add Cart">
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- data Information -->
                    <div class="cart-database">
                        <div class="cart-database-info">
                            <div class="orderd-cart">
                                <h3 class="text-success p-2">Ordered Products</h3>
                                <span>
                                    <?php
                                    require_once "database.php"; // Ensure this file contains the database connection code

                                    // Query to count the number of orders
                                    $orderCountSql = "SELECT COUNT(*) as total_orders FROM orders";
                                    $orderResult = $conn->query($orderCountSql);

                                    if ($orderResult->num_rows > 0) {
                                        $orderRow = $orderResult->fetch_assoc();
                                        $totalOrders = $orderRow['total_orders'];
                                    } else {
                                        $totalOrders = 0;
                                    }

                                    echo $totalOrders;
                                    ?>
                                </span>
                            </div>

                            <?php
                            // Query to count the number of product rows
                            $countSql = "SELECT COUNT(*) as total FROM Products";
                            $result = $conn->query($countSql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $totalRows = $row['total'];
                            } else {
                                $totalRows = 0;
                            }
                            ?>

                            <div class="Totall-cart-admin">
                                <h3 class="text-success p-2">Total Products</h3>
                                <span><?php echo $totalRows; ?></span>
                            </div>
                            <hr style="color:blueviolet">
                        </div>
                    </div>


                </section>
            </div>

        </div>
    </div> <!-- row end -->
    <!-- footer Section -->
    <div class="col-md-12 p-0 m-0 mt-4">
        <?php include '../../php_script/footer.php' ?>
    </div> <!--footer end-->






</body>
<script src="../../java script/index.js"></script>

</html>