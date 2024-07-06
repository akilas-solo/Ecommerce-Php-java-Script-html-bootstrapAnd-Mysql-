<?php
session_start();
include './Admin/database.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Authentication/log.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Retrieve customer information including balance
$stmt = $conn->prepare("SELECT first_name, last_name, balance, email FROM Customers WHERE customer_id = ?");
if ($stmt) {
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $balance, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info p {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <?php include "../php_script/Navbar.php"; ?>

    <!-- Profile Section -->
    <div class="container profile-container">
        <h2 class="profile-heading">Profile Information</h2>
        <div class="profile-info">
            <label>Name:</label>
            <p><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>
        </div>
        <div class="profile-info">
            <label>Email:</label>
            <p><?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="profile-info">
            <label>Balance:</label>
            <p><?php echo htmlspecialchars($balance) . ' ETB'; ?></p>
        </div>

        <!-- Add balance charging form -->
        <div class="row">
            <div class="col-md-4">
                <form action="charge_balance.php" method="post">
                    <div class="form-group">
                        <label for="amount">Amount to charge (ETB):</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                    
                    </div>
                    <button type="submit" class="btn btn-primary">Charge Balance</button>
                </form>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>

    </div>

    <!-- Footer Section -->
    <?php include "../php_script/footer.php"; ?>
</body>

</html>