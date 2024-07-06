<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Coments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="styel.css">
</head>
<style>
    .input-width-30px {
        width: 100px !important;
    }
</style>

<body>

    <!-- Header Section -->
    <?php include "Navbar.php"; ?>

        <div class="row">
             <div class="col-md-12 mt-3 ">
                <div class="container-fluid ">
                    <div class="row">
                       <div class="col-md-8"></div>
                       <div class="col-md-4 mb-4">
                       <form class="form-inline " method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label class="mr-2 mb-2" for="text">Inter Limit of Comment </label>
                            <div class="input-group">
                                <input type="number" id="limit" name="limit" class=" form-control form-control-sm input-width-30px" min="1" max="20">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                </div>
                            </div>
                        </form>
                       </div>
                        <?php
                        // Include database connection
                        include 'database.php';

                        // Default limit
                        $limit = 6;

                        // Check if limit is provided in the URL query string
                        if (isset($_GET['limit']) && !empty($_GET['limit'])) {
                            $limit = intval($_GET['limit']);
                        }

                        // Fetch user comments from the database with the specified limit
                        $sql = "SELECT * FROM Contacts LIMIT $limit";
                        $result = $conn->query($sql);

                        // Display each customer contact as a Bootstrap 4 card
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['full_name']; ?></h5>
                                            <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                            <p class="card-text"><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
                                            <p class="card-text"><strong>Address:</strong> <?php echo $row['address']; ?></p>
                                            <p class="card-text"><strong>Comment:</strong> <?php echo $row['comment']; ?></p>
                                            <p class="card-text"><small class="text-muted">Created at: <?php echo $row['created_at']; ?></small></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No customer contacts found.";
                        }
                        ?>
                    </div>
                </div>
             
            </div>


        </div>
    </div>

   <!-- footer Section -->
   <div class="col-md-12 mt-5 p-0 ml-0">
                    <?php include "../../php_script/footer.php"; ?>
                </div>
                <!-- footer end -->

    <script src="../../java script/index.js"></script>
</body>

</html>