<?php include("header.php"); ?>

<?php

    if(!isset($_SESSION['admin_logged_in'])){
        header('Location: login.php');
        exit();
    }

?>

<?php

  //Xac dinh so trang
  if(isset($_GET['page_no']) && $_GET['page_no'] !=""){

    //Neu nguoi dung da vao trang thi so trang la cai ma user chon
    $page_no = $_GET['page_no'];
  }else{
    //Neu nguoi dung moi vo trang thi mac dinh so trang la 1
    $page_no = 1;
  }

  //Tra ve so luong san pham
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //So luong san pham moi trang
  $total_records_per_page = 9;

  $offset = ($page_no-1) * $total_records_per_page;

  $previous_page = $page_no -1;
  $next_page = $page_no +1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records/$total_records_per_page);

  //Lay toan bo san pham
  $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $orders = $stmt2->get_result();

?>

<div class="container-fluid">
  <div class="row">
    <?php include("sidemenu.php"); ?>
  </div>
</div>

    
 

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <h2>Orders</h2>

      <?php if(isset($_GET['order_updated'])){?>
        <p class="text-center" style="color: pink;"><?php echo $_GET['order_updated'];?></p>
      <?php }?>

      <?php if(isset($_GET['order_failed'])){?>
        <p class="text-center" style="color: cyan;"><?php echo $_GET['order_failed'];?></p>
      <?php }?>

      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Order Status</th>
              <th scope="col">User Id</th>
              <th scope="col">Order Date</th>
              <th scope="col">User Phone Number</th>
              <th scope="col">User Address</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order){?>
            <tr>
              <td><?php echo $order['order_id'];?></td>
              <td><?php echo $order['order_status'];?></td>
              <td><?php echo $order['user_id'];?></td>
              <td><?php echo $order['order_date'];?></td>
              <td><?php echo $order['user_phone'];?></td>
              <td><?php echo $order['user_address'];?></td>

              <td><a class="btn btn-success" href="edit_order.php?order_id=<?php echo $order['order_id'];?>">Edit</a></td>
              <td><a class="btn btn-danger">Delete</a></td>
            </tr>
            <?php }?>
          </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination mt-5">

                <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                  <a href="<?php if($page_no <=1){echo '#';}else{echo "?page_no=".($page_no-1);}?>" class="page-link">Back</a></li>

                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                <?php if($page_no>=3){?>
                  <li class="page-item"><a href="#" class="page-link">..</a></li>
                  <li class="page-item"><a href="<?php echo "?page_no=".$page_no;?>" class="page-link"><?php echo $page_no;?></a></li>
                <?php } ?>

                <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>">
                  <a href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);}?>" class="page-link">Next</a></li>
            </ul>
        </nav>
      </div>
    </main>
  </div>
</div>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script><script src="dashboard.js"></script></body>
</html>
