<?php include('layouts/header.php');?>

<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

  $stmt->bind_param("i", $_GET["product_id"]);

  $stmt->execute();

  $product = $stmt->get_result();

} else {
  header('location: index.php');
}

?>

  <section class="single-product my-5 py-5">
    <div class="row mt-5">
      <?php while ($row = $product->fetch_assoc()) { ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
          <img class="img-fluid pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
        </div>


        <div class="col-lg-6 col-md-12 col-12">
          <h3 class="py-4">
            <?php echo $row['product_name']; ?>
          </h3>
          <h2>
            <?php echo $row['product_price']; ?>kVND
          </h2>

          <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
            <input type="number" name="product_quantity" value="1">
            <button class="atc-btn" type="submit" name="add_to_cart">Add to Cart</button>
          </form>


          <h4 class="mt-5 mb-5">Details</h4>
          <span>
            <?php echo $row['product_description']; ?>
          </span>
        </div>



      <?php } ?>
    </div>
  </section>

  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr>
      <p class="text-dark">Check out more products</p>
    </div>

    <div class="row mx-auto container-fluid">
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/product_9.png" alt="" class="img-fluid mb-3">
        <!--rating add here-->
        <h5 class="p-name text-dark">Nike Flex Runner 2 Older</h5>
        <h4 class="p-price">2.030kVND</h4>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/product_7.png" alt="" class="img-fluid mb-3">
        <!--rating add here-->
        <h5 class="p-name text-dark">Puma Hoodie for Male</h5>
        <h4 class="p-price">950kVND</h4>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/product_6.png" alt="" class="img-fluid mb-3">
        <!--rating add here-->
        <h5 class="p-name text-dark">Nike Downshifter 12 Men</h5>
        <h4 class="p-price">1.930kVND</h4>
        <button class="buy-btn">Buy Now</button>
      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/product_8.png" alt="" class="img-fluid mb-3">
        <!--rating add here-->
        <h5 class="p-name text-dark">Chanel Black Caviar</h5>
        <h4 class="p-price">136.000kVND</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>

  </section>

  <script>

    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for(let i=0; i<4; i++){
        smallImg[i].onClick = function(){
        mainImg.src = smallImg[i].src;
      }
    }

  </script>
<?php include('layouts/footer.php'); ?>