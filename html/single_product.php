
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <script src="https://kit.fontawesome.com/4db27522de.js" crossorigin="anonymous"></script>
</head>

<body>
   <!-- Header Section -->
   <?php include"../php_script/Navbar.php";?>


    <!-- Product Detel -->
    <section class="detaile_box section-m1 section-p1">
        <div class="single-img">
            <img id="main-img" width="100%" src="../img/products/f7.jpg" alt="">
               
            <!-- other choice -->
            <div class="small-img-group">
                <div class="small-img-col">
                    <img class="small-img"  width="100%" src="/img/products/f4.jpg" alt="">
                </div>
                <div class="small-img-col">
                    <img  class="small-img" width="100%" src="/img/products/f2.jpg" alt="">
                </div>
                <div class="small-img-col">
                    <img class="small-img" width="100%"src="/img/products/f3.jpg" alt="">
                </div>
                <div class="small-img-col">
                    <img class="small-img" width="100%" src="/img/products/f1.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="product-description">
            <h3>Home/T-shert</h3>
            <h2 id="detaile_cart_name">Men`s Fashion T shert</h2>
            <h3  id="detaile_price">Product Price: <span class="text-warnig">$112.00</span> </h3>
            
            <button id="add_to_cart" >Add To Cart</button>
            <h4>Product Details</h4>
            <div class="para">
                <p class="text-center">Lorem, ipsum dolor sit amet
                    consectetur adipisicing elit.
                    Nesciunt labore cum voluptatum hic
                    ut quibusdam repudiandae optio tenetur
                    officiis necessitatibus? Harum itaque
                    ducimus a nostrum
                    excepturi vero voluptas quas ab.
                </p>
          </div>
        </div>
    </section>

     <!-- product Card -->
     <section id="product1" class="section-p1">
        <h2>Featurd Product</h2>
        <p>Summer Colection New Modern Design</p>
        <div class="pro-container">
            <!-- Single Card -->
            <div class="pro">
                <img src="/img/products/f1.jpg" alt="">
                <div class="des">
                    <span>Adidas</span>
                    <h5>Carton Astronat T-sheerts</h5>
                    <!-- star -->
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                <!-- Price -->
                <h4>$78</h4>
                </div>
                <!-- Add Cart Icon -->
                <a href="#"><i class="fa-solid fa-cart-shopping " id="cart"></i></i></a>
            </div>
            <!-- product 2 -->
            <div class="pro">
                <img src="/img/products/f2.jpg" alt="">
                <div class="des">
                    <span>Adidas</span>
                    <h5>Carton Astronat T-sheerts</h5>
                    <!-- star -->
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                <!-- Price -->
                <h4>$78</h4>
                </div>
                <!-- Add Cart Icon -->
                <a href="#"><i class="fa-solid fa-cart-shopping " id="cart"></i></i></a>
            </div>
            <!-- product 3 -->
            <div class="pro">
                <img src="/img/products/f3.jpg" alt="">
                <div class="des">
                    <span>Adidas</span>
                    <h5>Carton Astronat T-sheerts</h5>
                    <!-- star -->
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                <!-- Price -->
                <h4>$78</h4>
                </div>
                <!-- Add Cart Icon -->
                <a href="#"><i class="fa-solid fa-cart-shopping " id="cart"></i></i></a>
            </div>
            <!-- product 4 -->
            <div class="pro">
                <img src="/img/products/f4.jpg" alt="">
                <div class="des">
                    <span>Adidas</span>
                    <h5>Carton Astronat T-sheerts</h5>
                    <!-- star -->
                    <div class="star">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                <!-- Price -->
                <h4>$78</h4>
                </div>
                <!-- Add Cart Icon -->
                <a href="#"><i class="fa-solid fa-cart-shopping " id="cart"></i></i></a>
            </div>
        </div>
    </section>

    <!-- New latter -->
    <section id="newslatter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail Updata abaut our latest Shop And <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your Email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

  <!-- footer Section -->
  <?php include"../php_script/footer.php";?>


</body>
<script src="../java script/index.js"></script>
<script src="../java script/cart.js"></script>
 
<script>
   var main_img = document.getElementById('main-img');
   var smal_img = document.getElementsByClassName('small-img');

   smal_img[0].onclick=()=>{
      main_img.src=smal_img[0].src;
   }
   smal_img[1].onclick=()=>{
      main_img.src=smal_img[1].src;
   }
   smal_img[2].onclick=()=>{
      main_img.src=smal_img[2].src;
   }
   smal_img[3].onclick=()=>{
      main_img.src=smal_img[3].src;
   }
</script>

</html>