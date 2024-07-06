<?php
// Assuming you have established a valid database connection
require_once "database.php";
// Check if the product_id parameter is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Delete the product from the database
    $sql = "DELETE FROM Products WHERE product_id = $productId";
    if ($conn->query($sql) === TRUE) {
         // Redirect to the success page
       header("Location: procucts.php");
       exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Product ID not provided.";
}

// Close the database connection
$conn->close();
?>