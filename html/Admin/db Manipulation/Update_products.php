<?php
// Assuming you have established a database connection
include "../database.php";

// Function to sanitize inputs
function sanitize($conn, $data) {
    return mysqli_real_escape_string($conn, htmlspecialchars(stripslashes(trim($data))));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the product ID and updated data from the form
    $product_id = sanitize($conn, $_POST["product_id"]);
    $updated_name = sanitize($conn, $_POST["product_name"]);
    $updated_description = sanitize($conn, $_POST["description"]);
    $updated_price = sanitize($conn, $_POST["price"]);
    $updated_quantity = sanitize($conn, $_POST["quantity"]);
    $updated_category_id = sanitize($conn, $_POST["category_id"]);

    // Check if a file was uploaded
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        // Retrieve the file information
        $image_name = basename($_FILES["image"]["name"]); // Get the original file name
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/WEB PROJECT 1/html/Admin/db Manipulation/images/'; // Ensure there's a leading slash

        // Move the uploaded file to the target directory
        $temp_name = $_FILES["image"]["tmp_name"];
        $target_path = $target_dir . $image_name;

        // Ensure the target directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // If the file already exists in the target directory, rename it
        $counter = 1;
        while (file_exists($target_path)) {
            $image_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $target_path = $target_dir . $image_name;
            $counter++;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($temp_name, $target_path)) {
            // Relative path to be stored in the database
            $relative_path = 'images/' . $image_name;

            // Delete the old image if it exists
            $sql = "SELECT image_url FROM Products WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $stmt->bind_result($old_image_url);
            if ($stmt->fetch() && !empty($old_image_url)) {
                $old_image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $old_image_url;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
            $stmt->close();

            // Update the database with the new file path and other product data
            $update_query = "UPDATE Products SET product_name=?, description=?, price=?, quantity=?, category_id=?, image_url=? WHERE product_id=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssdisss", $updated_name, $updated_description, $updated_price, $updated_quantity, $updated_category_id, $relative_path, $product_id);

            if ($stmt->execute()) {
                // Product data updated successfully
                header("Location: ../procucts.php");
                exit(); // Ensure no further code execution after redirection
            } else {
                // Error occurred while updating product data
                echo "Error updating product data: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // Error uploading file
            echo "Error uploading file.";
        }
    } else {
        // If no new image is uploaded, update other product data without changing the image
        $update_query = "UPDATE Products SET product_name=?, description=?, price=?, quantity=?, category_id=? WHERE product_id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssdiss", $updated_name, $updated_description, $updated_price, $updated_quantity, $updated_category_id, $product_id);

        if ($stmt->execute()) {
            // Product data updated successfully
            header("Location: ../procucts.php");
            exit(); // Ensure no further code execution after redirection
        } else {
            // Error occurred while updating product data
            echo "Error updating product data: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }
}
?>
