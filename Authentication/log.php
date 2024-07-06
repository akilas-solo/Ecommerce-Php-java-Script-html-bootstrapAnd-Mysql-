<?php 
 session_start();

if (isset($_POST['log'])) {
    // Retrieve form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['usertype'];

    // Include the database connection file
    require_once "database.php";

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM Customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check the password
        if ($password === $user["password"]) {
            // Set session variables
            $_SESSION["customer_id"] = $user["customer_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["user"] = $user;

            // Check the user type and redirect accordingly
            if ($user["usertype"] === $type) {
                if ($type === 'admin') {
                    $redirect = "../html/Admin/adminn.php";
                } else {
                    $redirect = "../index.php";
                }
                header("Location: $redirect");
                exit();
            } else {
                // Handle user type mismatch
                $_SESSION["alert_message"] = "User type does not match.";
                header("Location: log.php");
                exit();
            }
        } else {
            // Incorrect password
            $_SESSION["alert_message"] = "Password does not match.";
            header("Location: log.php");
            exit();
        }
    } else {
        // Email does not exist
        $_SESSION["alert_message"] = "Email does not exist.";
        header("Location: log.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>




<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./bootstrap/style.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">

        <h2>Login</h2>
        <form action="log.php" method="POST">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
                    if (isset($_SESSION["alert_message"])) {
                        echo "<div class='alert alert-danger'>" . $_SESSION["alert_message"] . "</div>";
                        unset($_SESSION["alert_message"]); // Unset the session variable after displaying the message
                    }
                    ?>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control mb-3" id="password" name="password" required>
                        <label for="usertype">User Type</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="usertype" value="user" required> User</label>
                        </div>
                        <div>
                            <label class="radio-inline"><input type="radio" name="usertype" value="admin" required> Admin</label>
                        </div>
                        <div class="form-btn mt-3">
                            <input type="submit" class="btn btn-primary btn_login" value="Login" name="log">
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <p>If You Not Registered <a href="register.php"> Register Here</a></p>
                    </div>
                    <div class="col-md-6 justify-content-end"><p>Forgot <a href="#"> Password</a></p></div>
                </div>
                
            </div>
            <div class="mt-3">
                <p>Back To<a href="../index.php"> <i class="fa-solid fa-house"></i>  Home</a></p>
            </div>
        </form>
    </div>
</body>

</html>