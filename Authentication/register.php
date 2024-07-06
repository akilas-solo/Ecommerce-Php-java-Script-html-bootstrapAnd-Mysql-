<?php
include 'database.php';
$errors = array();

if (isset($_POST["submit"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $zip_code = $_POST["zip_code"];
    $gender = $_POST["gender"];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password) || empty($address) || empty($city) || empty($state) || empty($country) || empty($zip_code) || empty($gender)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $confirm_password) {
        array_push($errors, "Passwords do not match");
    }

    if (count($errors) === 0) {
        // Check if email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCount = $result->num_rows;

        if ($rowCount > 0) {
            array_push($errors, "Email already exists");
        } else {
            // Insert the data into the database
            $sql = "INSERT INTO customers (first_name, last_name, email, password, address, city, state, country, zip_code, gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $password, $address, $city, $state, $country, $zip_code, $gender);
            $stmt->execute();

            echo "<div class='alert alert-success'>You are registered successfully.</div>";
            $stmt->close();
            header("Location: log.php");
            exit();
        }
    }
}
?>


<html>

<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./bootstrap/style.css">
</head>

<body>
    <div class="container">
        <?php
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
        ?>
        <h2>Registration Form</h2>
        <form action="register.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip_code">Zip Code:</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group flex-row">
                        <label for="gender">Gender:</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="gender" value="male" required> Male</label>
                        </div>
                        <div>
                            <label class="radio-inline"><input type="radio" name="gender" value="female" required> Female</label>
                        </div>
                        <div>
                            <label class="radio-inline"><input type="radio" name="gender" value="other" required> Other</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary btn_register" value="Register" name="submit">
            </div>
            <div class="mt-3">
                <p>Already Registered <a href="log.php">Login Here</a></p>
                <div class="mt-3"><p>Back To <a href="../Home.php"><i class="fa-regular fa-house"></i>Home</a></p></div>
     
            </div>
        </form>
    </div>
</body>

</html>