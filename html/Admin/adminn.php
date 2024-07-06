
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/abaut.css">
    <link rel="stylesheet" href="../../css/Admin.css">
    <link rel="stylesheet" href="styel.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->

    <!-- Header Section -->
    <?php include "Navbar.php"; ?>
</head>

<body>
    <div class="row">
        <div class="col-md-12 mt-3">
            <!-- Form and submission section -->
            <div class="container-fluid">
                <div class="row">
                    <?php
                    include 'database.php';
                    // Fetch counts
                    $customers_count = $conn->query("SELECT COUNT(*) AS count FROM Customers")->fetch_assoc()['count'];
                    $orders_count = $conn->query("SELECT COUNT(*) AS count FROM orders")->fetch_assoc()['count'];
                    $comments_count = $conn->query("SELECT COUNT(*) AS count FROM Contacts")->fetch_assoc()['count'];
                    $products_count = $conn->query("SELECT COUNT(*) AS count FROM Products")->fetch_assoc()['count'];
                    ?>

                    <!-- Users Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-icon fa fa-users"></div>
                                <h5 class="card-title">Users</h5>
                                <p class="card-text"><?php echo $customers_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-icon fa fa-shopping-cart"></div>
                                <h5 class="card-title">Orders</h5>
                                <p class="card-text"><?php echo $orders_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-icon fa fa-comments"></div>
                                <h5 class="card-title">Comments</h5>
                                <p class="card-text"><?php echo $comments_count; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Products Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-icon fa fa-cube"></div>
                                <h5 class="card-title">Products</h5>
                                <p class="card-text"><?php echo $products_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphs Section -->
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="ordersChart" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="productsChart" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row end -->
    </div> <!-- container-fluid end -->

    <!-- footer Section -->
    <div class="col-md-12 mt-4">
        <?php include '../../php_script/footer.php'; ?>
    </div> <!-- footer end -->

    <script src="../../java script/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Orders Chart
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Orders', 'Comments', 'Customers', 'Products'],
                datasets: [{
                    label: '# of Counts',
                    data: [<?php echo $orders_count; ?>, <?php echo $comments_count; ?>, <?php echo $customers_count; ?>, <?php echo $products_count; ?>],
                    backgroundColor: [
                        'rgba(44, 62, 80, 0.8)',
                        'rgba(52, 73, 94, 0.8)',
                        'rgba(149, 165, 166, 0.8)',
                        'rgba(127, 140, 141, 0.8)'
                    ],
                    borderColor: [
                        'rgba(44, 62, 80, 1)',
                        'rgba(52, 73, 94, 1)',
                        'rgba(149, 165, 166, 1)',
                        'rgba(127, 140, 141, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                animation: false, // Disable animation
                hover: {
                    animationDuration: 0 // Disable hover animation
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Products Chart
        var ctx2 = document.getElementById('productsChart').getContext('2d');
        var productsChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Orders', 'Comments', 'Customers', 'Products'],
                datasets: [{
                    label: '# of Counts',
                    data: [<?php echo $orders_count; ?>, <?php echo $comments_count; ?>, <?php echo $customers_count; ?>, <?php echo $products_count; ?>],
                    backgroundColor: [
                        'rgba(44, 62, 80, 0.8)',
                        'rgba(52, 73, 94, 0.8)',
                        'rgba(149, 165, 166, 0.8)',
                        'rgba(127, 140, 141, 0.8)'
                    ],
                    borderColor: [
                        'rgba(44, 62, 80, 1)',
                        'rgba(52, 73, 94, 1)',
                        'rgba(149, 165, 166, 1)',
                        'rgba(127, 140, 141, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                animation: false, // Disable animation
                hover: {
                    animationDuration: 0 // Disable hover animation
                }
            }
        });
    </script>
</body>

</html>
