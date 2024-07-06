<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/abaut.css">
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="styel.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">

    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header Section -->
    <?php include "Navbar.php"; ?>

    <div class="container-fuid m-5 ">
        <div class="row">
            <div class="col-md-4"> </div>
            <div class="col-md-4">
                <div class="card Update">
                    <div class="card-heder bg-dark ">
                        <h3 class="text-center mt-3 text-white">Update Form</h3>
                    </div>

                    <div class="card-body">
                        <?php
                        
                        include 'database.php';
                        // Retrieve the product ID from the form submission or query string
                        $product_id = $_POST["product_id"] ?? $_GET["product_id"];

                        // Retrieve the product data based on the product_id
                        $sql = "SELECT * FROM Products WHERE product_id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        ?>

                            <form method="POST" action="./db Manipulation/Update_products.php" enctype="multipart/form-data">
                                <div class="form-group" style="margin-right: 25px;">
                                    <label for="" class="form-label">Product Name</label>
                                    <input name="product_name" type="text" class="form-control m-3 p-2" value="<?php echo $row["product_name"]; ?>">
                                    <label for="" class="form-label">Product Image</label>
                                    <input name="image" type="file" class="form-control m-3 p-2">
                                    <label for="" class="form-label">Product Price</label>
                                    <input name="price" type="number" step="1" class="form-control m-3 p-2" value="<?php echo $row["price"]; ?>">
                                    <label for="" class="form-label">Product Quantity</label>
                                    <input name="quantity" type="number" step="1" class="form-control m-3 p-2" value="<?php echo $row["quantity"]; ?>">
                                    <label for="" class="form-label">Category ID</label>
                                    <input name="category_id" type="number" class="form-control m-3 p-2" value="<?php echo $row["category_id"]; ?>">
                                    <label for="" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control m-3 p-2" cols="20" rows="5"><?php echo $row["description"]; ?></textarea>

                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                </div>

                                <button class="text-white" id="back">
                                    <a class="text-white" style="text-decoration: none;" href="products.php">Back</a>
                                </button>
                                <button type="submit" class="text-white" id="save">Save</button>
                            </form>

                        <?php
                        } else {
                            echo "No product found with the provided product ID.";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </div>

                </div>
            </div>
            <div class="col-md-4"> </div>
        </div>
    </div>

    <?php include "../../php_script/footer.php"; ?>
</body>
<script src="../../java script/index.js"></script>

</html>
