<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/abaut.css">
    <!-- <link rel="stylesheet" href="../../css/Admin.css"> -->
    <link rel="stylesheet" href="styel.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">

    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-size: 1rem;
        }

        h3 {
            font-size: 1.5rem;
        }

        .table th,
        .table td {
            font-size: 0.875rem;
        }

        .form-check-label {
            font-size: 0.875rem;
        }

        .input-group .form-control {
            font-size: 0.875rem;
        }

        .product-description {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            /* Increase the max-width */
        }

        @media (max-width: 768px) {
            body {
                font-size: 0.875rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            .table th,
            .table td {
                font-size: 0.75rem;
            }

            .form-check-label {
                font-size: 0.75rem;
            }

            .input-group .form-control {
                font-size: 0.75rem;
            }

            .product-description {
                max-width: 150px;
                /* Adjust for smaller screens */
            }
        }

        @media (max-width: 576px) {
            body {
                font-size: 0.75rem;
            }

            h3 {
                font-size: 1rem;
            }

            .table th,
            .table td {
                font-size: 0.625rem;
            }

            .form-check-label {
                font-size: 0.625rem;
            }

            .input-group .form-control {
                font-size: 0.625rem;
            }

            .product-description {
                max-width: 100px;
                /* Adjust for smaller screens */
            }
        }

        .product-image {
            width: 80px;
            height: 80px;
            transition: transform 0.2s;
        }

        .product-image:hover {
            transform: scale(2.2);
        }

        .container_table {
            padding: 0 15px;
        }
    </style>
    <!-- Header Section -->
    <?php include "Navbar.php"; ?>

</head>

<body>

    <div class="row">
       
        <!-- Table Section -->
        <div class="col-md-12  mt-4 mx-auto">
            <h3 class="text-center mt-2 mb-5"><i class="fa-solid fa-cart-plus"></i> Products</h3>
            <div class="col-md-12 container_table mb-3">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card" style="border-radius: 5px;">
                            <div class="card-body p-0">
                                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; max-height: 700px;">
                                    <table class="table mb-0" style="border-radius: 5px;">
                                        <thead style="background-color: #313438; color: white;">
                                            <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Product Description</th>
                                                <th scope="col">Product Price</th>
                                                <th scope="col">Quantity</th> <!-- New header for quantity -->
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-table-body">
                                            <?php
                                            // Assuming you have established a database connection
                                            require_once "database.php";

                                            // Retrieve the data from the database
                                            $result = $conn->query("SELECT * FROM Products");
                                            if ($result) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["product_id"] . "</td>";
                                                    echo "<td>" . $row["product_name"] . "</td>";

                                                    // Retrieve the image URL from the database
                                                    $imageUrl = $row["image_url"];

                                                    echo "<td><img src='./db Manipulation/" . $imageUrl . "' alt='' class='rounded-circle product-image' style='max-width: 100px;'></td>"; // Adjust max-width as needed
                                                    echo "<td class='product-description'>" . $row["description"] . "</td>";
                                                    echo "<td>ETB " . $row["price"] . "</td>";
                                                    echo "<td>" . $row["quantity"] . "</td>"; // Displaying quantity
                                                    echo "<td>
        <a href='Update_Prodact.php?product_id=" . $row["product_id"] . "' class='btn btn-sm btn-success'>Update</a>
        <a href='delete_product.php?id=" . $row["product_id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to remove this product?\");'>Remove</a>
        </td>";
                                                    echo "</tr>";
                                                }
                                                // Free the result set
                                                $result->free();
                                            } else {
                                                echo "Error retrieving products.";
                                            }

                                            // Close the database connection
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SearchBar Section -->
                    <div class="col-md-2 p-0 ml-0 mr-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control no-outline" placeholder="Search Product" aria-label="Search" aria-describedby="search-button" id="search-input">
                            <button class="btn btn-dark no-outline" type="button" id="search-button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer Section -->
            <div class="col-md-12 mt-5">
                <?php include "../../php_script/footer.php"; ?>
            </div> <!--footer end-->
        </div>

    </div>

    </div> <!-- row end -->

</body>
<script src="../../java script/index.js"></script>
<script>
    const searchInput = document.getElementById('search-input');
    const productTableBody = document.getElementById('product-table-body');

    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        const rows = productTableBody.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            const productId = rows[i].getElementsByTagName('td')[0];
            const productName = rows[i].getElementsByTagName('td')[1];
            const productPrice = rows[i].getElementsByTagName('td')[4];
            if (productId && productName && productPrice) {
                const id = productId.textContent || productId.innerText;
                const name = productName.textContent || productName.innerText;
                const price = productPrice.textContent || productPrice.innerText;
                if (id.toLowerCase().indexOf(searchValue) > -1 || name.toLowerCase().indexOf(searchValue) > -1 || price.toLowerCase().indexOf(searchValue) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
</script>

</html>