<?php
// Assuming you have established a database connection
require_once "database.php";

// Check if a file was uploaded
if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
  $uploadedFile = $_FILES['imageFile'];

  // Generate a unique filename to avoid naming conflicts
  $filename = uniqid() . '_' . $uploadedFile['name'];
  
  // Specify the folder where the image will be stored
  $uploadDirectory = 'images/' . $filename;

  // Move the uploaded file to the specified folder
  if (move_uploaded_file($uploadedFile['tmp_name'], $uploadDirectory)) {
    // Insert the file path into the database
    $sql = "INSERT INTO Products (image_url) VALUES ('$uploadDirectory')";
    $conn->query($sql);

    echo "Image uploaded and stored successfully.";
  } else {
    echo "Failed to move the uploaded file.";
  }
} else {
  echo "No file was uploaded or an error occurred during upload.";
}
?>