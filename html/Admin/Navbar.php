<?php

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">

<script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
<script src="../../java script/index.js"></script>
<style>
    .navbar {
        background-color: #464647;
    }

    .navbar-nav .nav-link {
        color: #ECE4E4;
        background-color: #464647;
        font-size: 20px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .navbar-nav .nav-link:hover {
        background-color: #464647;
        color: #20b066;
    }
</style>


<!-- Header Section -->

<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-md" id="header">
    <a class="ml-3" href="adminn.php"><img src="../../ICONS/Shopping Bag.png" alt="Shopping Bag"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul id="navbar" class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="adminn.php"><i class="fa-solid fa-user-tie"></i> Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Add_product.php"><i class="fa-solid fa-plus"></i> Add Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="procucts.php"><i class="fa-solid fa-cart-plus"></i> Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Orderd_Products.php"><i class="fa-solid fa-cart-shopping"></i> Orderd Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="Custemers.php"><i class="fa-solid fa-users"></i> Custemer Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="View_coment.php"><i class="fa-solid fa-comment"></i> Comment</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../../Authentication/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
</nav>

<style>
    /* Custom CSS for adjusting font size of navigation links */
    .navbar-nav .nav-link {
        font-size: 16px; /* Adjust the font size as needed */
    }
</style>






<script src="../../css/bootstrap/jquery.js"></script>
<script src="../../css/bootstrap/bootstrap.min.js"></script>