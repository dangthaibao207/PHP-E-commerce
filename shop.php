<?php include ('layouts/header.php'); ?>

<?php

include ('server/connection.php');

//Su dung search product
if (isset($_POST['search'])) {

  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {

    //Neu nguoi dung da vao trang thi so trang la cai ma user chon
    $page_no = $_GET['page_no'];
  } else {
    //Neu nguoi dung moi vo trang thi mac dinh so trang la 1
    $page_no = 1;
  }

  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
  $stmt1->bind_param('si', $category, $price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  $total_records_per_page = 2;

  $offset = ($page_no - 1) * $total_records_per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
  $stmt2->bind_param("si", $category, $price);
  $stmt2->execute();
  $products = $stmt2->get_result();

  //Tra ve toan bo san pham va phan trang
} else {

  //Xac dinh so trang
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {

    //Neu nguoi dung da vao trang thi so trang la cai ma user chon
    $page_no = $_GET['page_no'];
  } else {
    //Neu nguoi dung moi vo trang thi mac dinh so trang la 1
    $page_no = 1;
  }

  //Tra ve so luong san pham
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //So luong san pham moi trang
  $total_records_per_page = 4;

  $offset = ($page_no - 1) * $total_records_per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "3";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  //Lay toan bo san pham
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result();
}

// $stmt = $conn->prepare("SELECT * FROM products");

// $stmt->execute();

// $products = $stmt->get_result();

?>

<section id="search" class="my-5 py-5 ms-2">
  <div class="container mt-5 py-5">
    <p>Search Products</p>
    <hr />
  </div>

  <form action="shop.php" method="POST">
    <div class="row mx-auto container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Category</p>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="category" id="category_one" value="shoes" <?php if (isset($category) && $category == 'shoes') {
            echo 'checked';
          } ?>>
          <label class="form-check-label" for="flexRadioDefault1">
            Shoes
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="category" id="category_two" value="coats" <?php if (isset($category) && $category == 'coats') {
            echo 'checked';
          } ?>>
          <label class="form-check-label" for="flexRadioDefault2">
            Coats
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="category" id="category_three" value="watches" <?php if (isset($category) && $category == 'watches') {
            echo 'checked';
          } ?>>
          <label class="form-check-label" for="flexRadioDefault3">
            Watches
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="category" id="category_four" value="bags" <?php if (isset($category) && $category == 'bags') {
            echo 'checked';
          } ?>>
          <label class="form-check-label" for="flexRadioDefault4">
            Bags
          </label>
        </div>
      </div>
    </div>

    <div class="row mx-auto container mt-5">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Price</p>
        <input type="range" class="form-range w-58" min="1" max="1000" id="customRange2" name="price" value="<?php if (isset($price)) {
          echo $price;
        } else {
          echo "1000";
        } ?>" />
        <div class="w-58">
          <span style="float: left;">1</span>
          <span style="float: right;">1000</span>
        </div>
      </div>
    </div>

    <div class="form-group my-3 mx-3">
      <input type="submit" name="search" value="Search" class="btn btn-primary" />
    </div>

  </form>
</section>

<section id="shop" class="my-5 py-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Products</h3>
    <hr>
    <p class="text-dark">Check out our new products</p>
  </div>


  <?php while ($row = $products->fetch_assoc()) { ?>

    <div class="row mx-auto container">
      <div onclick="window.location.href='single.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row['product_image']; ?>">

        <!--rating add here-->

        <h5 class="p-name text-dark"><?php echo $row['product_name']; ?></h5>

        <h4 class="p-price"><?php echo $row['product_price']; ?>kVND</h4>

        <a class="btn buy-btn" href="<?php echo "single.php?product_id=" . $row['product_id']; ?>">Buy Now</a>
      </div>
    <?php } ?>

    <nav aria-label="Page navigation example">
      <ul class="pagination mt-5">

        <li class="page-item <?php if ($page_no <= 1) {
          echo 'disabled';
        } ?>">
          <a href="<?php if ($page_no <= 1) {
            echo '#';
          } else {
            echo "?page_no=" . ($page_no - 1);
          } ?>" class="page-link">Back</a>
        </li>

        <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
        <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

        <?php if ($page_no >= 3) { ?>
          <li class="page-item"><a href="#" class="page-link">..</a></li>
          <li class="page-item"><a href="<?php echo "?page_no=" . $page_no; ?>"
              class="page-link"><?php echo $page_no; ?></a>
          </li>
        <?php } ?>

        <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
          echo 'disabled';
        } ?>">
          <a href="<?php if ($page_no >= $total_no_of_pages) {
            echo '#';
          } else {
            echo "?page_no=" . ($page_no + 1);
          } ?>" class="page-link">Next</a>
        </li>
      </ul>
    </nav>
  </div>

</section>

<?php include ('layouts/footer.php'); ?>