<?php include ('layouts/header.php'); ?>

<section id="home">
  <div class="container">
    <h5>NEW PRODUCTS</h5>
    <h1><span>Best Prices</span></h1>
    <p>MASSIVE SALE AT 75%</p>
    <button>Buy Now</button>
    <img src="../imgs/banner-main.jpg" alt="">
  </div>
</section>

<section id="brand" class="container my-5 pb-5">
  <div class="row">
    <img src="assets/imgs/champion.png" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
    <img src="assets/imgs/chanel.jpg" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
    <img src="assets/imgs/nike.png" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">
    <img src="assets/imgs/47.png" alt="" class="img-fluid col-lg-3 col-md-6 col-sm-12">

  </div>
</section>

<section id="new" class="w-100">
  <div class="row p-0 m-0">

    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assets/imgs/champion_1.jpg" alt="" class="img-fluid">
      <div class="details">
        <h2>Product 1</h2>
        <button class="text-uppercase">Buy</button>
      </div>
    </div>

    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assets/imgs/chanel_1.jpg" alt="" class="img-fluid">
      <div class="details">
        <h2>Product 2</h2>
        <button class="text-uppercase">Buy</button>
      </div>
    </div>

    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assets/imgs/nike_1.png" alt="" class="img-fluid">
      <div class="details">
        <h2>Product 3</h2>
        <button class="text-uppercase">Buy</button>
      </div>
    </div>

  </div>
</section>

<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured</h3>
    <hr>
    <p class="text-dark">Check out our new products</p>
  </div>

  <div class="row mx-auto container-fluid">
    <?php include ('server/get_featured.php'); ?>
    <?php while ($row = $featured_products->fetch_assoc()) { ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3">
        <!--rating add here-->
        <h5 class="p-name text-dark">
          <?php echo $row['product_name']; ?>
        </h5>
        <h4 class="p-price">
          <?php echo $row['product_price']; ?>kVND
        </h4>
        <a href="<?php echo "single.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy
            Now</button></a>
      </div>
    <?php } ?>
  </div>
</section>

<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>SEASON'S SALE</h4>
    <h1>Summer <br> 45% OFF</h1>
    <button class="text-uppercase">Buy Now</button>
  </div>
</section>

<section id="featured" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Shirts</h3>
    <hr>
    <p class="text-dark">Check out our new products</p>
  </div>

  <div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="assets/imgs/product_1.png" alt="" class="img-fluid mb-3">
      <!--rating add here-->
      <h5 class="p-name text-dark">Clothes A</h5>
      <h4 class="p-price">2.030kVND</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="assets/imgs/product_2.png" alt="" class="img-fluid mb-3">
      <!--rating add here-->
      <h5 class="p-name text-dark">Product B</h5>
      <h4 class="p-price">950kVND</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="assets/imgs/product_3.png" alt="" class="img-fluid mb-3">
      <!--rating add here-->
      <h5 class="p-name text-dark">Clothes C</h5>
      <h4 class="p-price">2.030kVND</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img src="assets/imgs/product_4.png" alt="" class="img-fluid mb-3">
      <!--rating add here-->
      <h5 class="p-name text-dark">Product D</h5>
      <h4 class="p-price">950kVND</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

</section>

<?php include ('layouts/footer.php'); ?>