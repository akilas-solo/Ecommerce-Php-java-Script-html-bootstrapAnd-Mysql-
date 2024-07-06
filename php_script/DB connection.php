<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "node";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Get form data
    $cartName = $_POST["cart-name"];
    $cartDescription = $_POST["cart-description"];
    $cartPrice = $_POST["cart-price"];

    // Read image file
    $imageData = file_get_contents($_FILES["cart-img"]["tmp_name"]);

    // Prepare SQL statement
    $sql = "INSERT INTO new_cart (cart_name, cart_image, cart_description, cart_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $cartName, $imageData, $cartDescription, $cartPrice);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
