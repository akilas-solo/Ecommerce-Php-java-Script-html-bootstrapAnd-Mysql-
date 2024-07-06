<?php
// Assuming you have established a database connection
require_once "database.php";

// Check if a file was uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['Product-img']) && $_FILES['Product-img']['error'] === UPLOAD_ERR_OK) {
    // Retrieve the form data
    $productName = $_POST["Product-name"];
    $productDescription = $_POST["Product-description"];
    $productPrice = $_POST["Product-price"];
    $productCategory = $_POST["chatagori_id"];
    $productCategoryname = $_POST["chatagori_name"];

    $uploadedFile = $_FILES['Product-img'];

    // Generate a unique filename to avoid naming conflicts
    $filename = uniqid() . '_' . $uploadedFile['name'];

    // Specify the folder where the image will be stored
    $uploadDirectory = 'images/' . $filename;

    // Move the uploaded file to the specified folder
    if (move_uploaded_file($uploadedFile['tmp_name'], $uploadDirectory)) {
        // Perform any necessary data validation or sanitization

        // Prepare the SQL query
        $sql = "INSERT INTO Products (product_name, description, price, image_url, category_id,category_name)
            VALUES (?, ?, ?, ?, ?,?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("ssdsss", $productName, $productDescription, $productPrice, $uploadDirectory, $productCategory,$productCategoryname);

            // Execute the statement
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->affected_rows > 0) {
                // Redirect to the success page
                header("Location: ../procucts.php");
                exit();
            } else {
                echo "Error inserting product.";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement.";
        }
    } else {
        echo "Failed to move the uploaded file.";
    }
} else {
    echo "No file was uploaded or an error occurred during upload.";
}

// Close the database connection
$conn->close();
?>