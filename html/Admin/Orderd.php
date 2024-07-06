<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/abaut.css">
    <!-- <link rel="stylesheet" href="../../css/Admin.css"> -->
    <link rel="stylesheet" href="styel.css">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">

    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
        
      <!-- Header Section -->
   <?php include"Navbar.php";?>
   
</head>

<body>

<div class="row">
        <div class="col-md-2">
            <!-- Side Bar -->
            <div class="container-fluid custem_panal">
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="sidebar">
                            <ul class="nav flex-column side-link">

                                <li class="nav-item">
                                    <a class="nav-link" href="Add_product.php"><img src="../../ICONS/delivery-box_13082169.png" alt="">Add Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="procucts.php"><img src="../../ICONS/parcel_7135145.png" alt="">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Orderd_Products.php"><i class="fa-solid fa-cart-shopping"></i> Orderd Products</a>
                                </li>

                                <li class="nav-item">
                                     <a class="nav-link" href="Custemers.php"><i class="fa-solid fa-users"></i> Custemer Info</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 ">
                        <!-- Main content -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10  mt-4">
            <div class="row">
            <h3 class="text-center mt-3 mb-4"><i class="fa-solid fa-cart-shopping"></i>Orderd Product</h3>
          <!-- Table Sction -->
          <div class="col-md-10 container_table">
            <div class="card style="border-radius: 5px;"">
                <div class="card-body p-0">
                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; max-height: 700px;">
                        <table class="table table-striped mb-0" style="border-radius: 5px;">
                            <thead style="background-color: #313438;">
                                <tr>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Description</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">johndoe@example.com</td>
                                    <td><img src="/img/products/f7.jpg" alt="" class="rounded-circle" style="width: 50px; height: 50px;"></td>
                                    <td>25</td>
                                    <td>johndoe@example.comdfggggggg</td>
                                    <td>45Birr</td>
                                    <td><a href="#" class="btn btn-sm btn-danger">Remove</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

          <!-- SearchBar Section -->
          <div class="col-md-2 mr-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control no-outline" placeholder="Search Customer" aria-label="Search" aria-describedby="search-button">
                <button class="btn btn-dark no-outline" type="button" id="search-button">Search</button>
            </div>
        </div>

           </div>
            <!-- footer Section -->
         <?php include"../../php_script/footer.php";?>

        </div>
        
     </div> <!-- row end -->







</body>
<script src="../../java script/index.js"></script>

</html>