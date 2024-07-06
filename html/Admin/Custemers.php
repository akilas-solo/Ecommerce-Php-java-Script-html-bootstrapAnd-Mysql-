<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custemers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/Admin.css">
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
        }
    </style>
    <!-- Header Section -->
    <?php include 'Navbar.php' ?>
</head>

<body>
    <div class="row">
            <h3 class="text-center mt-4"><i class="fas fa-users"></i> Customer Information</h3>
            <div class="container-fluid custem_panal p-3 mb-3">
                <div class="row">
                    <!-- Table Section -->
                    <div class="col-md-10">
                        <?php
                        require_once "../../Authentication/database.php";
                        // Query to fetch data from the users table
                        $sql = "SELECT * FROM Customers";
                        $result = $conn->query($sql);
                        ?>

                        <div class="table-responsive">
                            <table class="table p-3 border-3 rounded">
                                <thead class="p-3" style="background: linear-gradient(135deg, #1f1e1ed7, #1c1c1d);">
                                    <tr class="p-3 m-2">
                                        <th scope="col">Customer ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Zip Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM Customers";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr scope='row'>";
                                            echo "<td>" . $row["customer_id"] . "</td>";
                                            echo "<td>" . $row["first_name"] . "</td>";
                                            echo "<td>" . $row["last_name"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["password"] . "</td>";
                                            echo "<td>" . $row["address"] . "</td>";
                                            echo "<td>" . $row["city"] . "</td>";
                                            echo "<td>" . $row["state"] . "</td>";
                                            echo "<td>" . $row["country"] . "</td>";
                                            echo "<td>" . $row["zip_code"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No customers found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- SearchBar Section -->
                    <div class="col-md-2">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control no-outline" placeholder="Search Customer" aria-label="Search" id="search-input">
                            <button class="btn btn-dark no-outline" type="button" id="search-button">Search</button>
                            <div class="input-group-append" id="search-method-buttons">
                                <hr><br>
                                <h4>Search By</h4>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="search-method" id="search-method-id" value="id" checked>
                                    <label class="form-check-label" for="search-method-id">ID</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="search-method" id="search-method-name" value="name">
                                    <label class="form-check-label" for="search-method-name">Name</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="search-method" id="search-method-phone" value="phone">
                                    <label class="form-check-label" for="search-method-phone">Phone</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="search-method" id="search-method-email" value="email">
                                    <label class="form-check-label" for="search-method-email">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="search-method" id="search-method-address" value="address">
                                    <label class="form-check-label" for="search-method-address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
         
        </div>
 
 <!-- Footer Section -->
            <div class="col-md-12 mt-4">
                <?php include '../../php_script/footer.php' ?>
            </div>
    <!-- row end -->
</body>
<script>
    var searchInput = document.getElementById("search-input");
    var searchButton = document.getElementById("search-button");
    var searchMethodButtons = document.getElementById("search-method-buttons");
    var tableRows = document.querySelectorAll("tbody tr");

    var searchMethod = "id"; // Default search method is set to "ID"

    function performSearch() {
        var searchValue = searchInput.value.toLowerCase();

        tableRows.forEach(function(row) {
            var searchColumnIndex = 0; // Default search column index is set to 0 (ID column)

            switch (searchMethod) {
                case "name":
                    searchColumnIndex = 1;
                    break;
                case "phone":
                    searchColumnIndex = 4;
                    break;
                case "email":
                    searchColumnIndex = 3;
                    break;
                case "address":
                    searchColumnIndex = 5;
                    break;
                default:
                    searchColumnIndex = 0;
                    break;
            }

            var searchColumnValue = row.querySelector("td:nth-child(" + (searchColumnIndex + 1) + ")").textContent.toLowerCase();

            if (searchColumnValue.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function updateSearchMethod() {
        var selectedMethodButton = searchMethodButtons.querySelector("input[name='search-method']:checked");
        searchMethod = selectedMethodButton.value;
    }

    searchMethodButtons.addEventListener("change", updateSearchMethod);
    searchInput.addEventListener("keyup", performSearch);
    searchButton.addEventListener("click", performSearch);
</script>
<script src="../../java script/index.js"></script>
<script src="../../css/bootstrap/jquery.js"></script>
<script src="../../css/bootstrap/bootstrap.min.js"></script>

</html>