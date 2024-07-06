<?php

session_start();

// Check if the user is authenticated and is an admin
if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'admin') {
    // If not authenticated or not an admin, redirect to the login page
    header("Location: log.php");
    exit();
}


require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST["product_name"];
    $image_url = $_POST["image_url"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];
    $description = $_POST["description"];
    $product_id = $_POST["product_id"];

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE Products SET product_name = ?, image_url = ?, price = ?, category_id = ?, description = ? WHERE product_id = ?");
    $stmt->bind_param("ssdisi", $product_name, $image_url, $price, $category_id, $description, $product_id);

    // Execute the update statement
    if ($stmt->execute()) {
       // Commit the transaction
       $conn->commit();

       // Redirect to the success page
       header("Location: procucts.php");
       exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

?>

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
                      
                        // Retrieve the product ID from the form submission or query string
                        $product_id = $_POST["product_id"] ?? $_GET["product_id"];

                        // Retrieve the product data based on the product_id
                        $sql = "SELECT * FROM Products WHERE product_id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            ?>

                            <form method="POST" action="Update_Added_Cart.php">
                                <div class="form-group" style="margin-right: 25px;">
                                    <label for="" class="form-label">Product Name</label>
                                    <input name="product_name" type="text" class="form-control m-3 p-2"
                                        value="<?php echo $row["product_name"]; ?>">
                                    <label for="" class="form-label">Product Image</label>
                                    <input name="image_url" type="file" class="form-control m-3 p-2"
                                        value="<?php echo $row["image_url"]; ?>">
                                    <label for="" class="form-label">Product Price</label>
                                    <input name="price" type="number" step="0.01" class="form-control m-3 p-2"
                                        value="<?php echo $row["price"]; ?>">
                                    <label for="" class="form-label">Category ID</label>
                                    <input name="category_id" type="number" class="form-control m-3 p-2"
                                        value="<?php echo $row["category_id"]; ?>">
                                    <label for="" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control m-3 p-2" cols="20"
                                        rows="5"><?php echo $row["description"]; ?></textarea>

                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                </div>

                                <button class="text-white" id="back">
                                    <a class="text-white" style="text-decoration: none; "
                                        href="procucts.php">Back</a>
                                </button>
                                <button type="submit" class="text-white" id="save">Save</button>
                            </form>

                            <?php
                        } else {
                            echo "No product foundwith the provided product ID.";
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