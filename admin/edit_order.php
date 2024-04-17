<?php 

include("header.php");

?>

<?php

if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=? ");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order = $stmt->get_result();
}else if(isset($_POST['edit_order'])){

        $order_status = $_POST['order_status'];
        $order_id = $_POST['order_id'];
        $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");

        $stmt->bind_param('si', $order_status, $order_id);

        if($stmt->execute()){
            header("location: index.php?order_updated=Updated successfully");
        }else{
            header("location: products.php?order_failed=Could not update");
        }
}else {
    header('location: index.php');
}

?>

<div class="container-fluid">
  <div class="row">
    <?php include("sidemenu.php"); ?>

    
  </div>
</div>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">

            </div>
        </div>
      </div>

      <h2>Edit Orders</h2>
      <div class="table-responsive">
        <div class="mx-auto container">
            <form id="edit-order-form" method="POST" action="edit_order.php">
                <?php foreach($order as $r){?>
                    <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                    <div class="form-group my-3">

                        <label>Order Id</label>
                        <p class="my-4"><?php echo $r['order_id'];?></p>
                    </div>

                    <div class="form-group mt-3">

                        <label>Order Price</label>
                        <p class="my-4"><?php echo $r['order_cost'];?></p>
                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>"/>

                    <div class="form-group my-3">

                        <label>Order Date</label>
                        <p class="my-4"><?php echo $r['order_date'];?></p>
                    </div>

                    <div class="form-group my-3">
                        <label>Order Status</label>
                        <select class="form-select" required name="order_status">
        
                            <option value="Not paid" <?php if($r['order_status']=='Not paid'){echo "selected";}?>>Not paid</option>
                            <option value="Paid" <?php if($r['order_status']=='Paid'){echo "selected";}?>>Paid</option>
                            <option value="Shipped" <?php if($r['order_status']=='Shipped'){echo "selected";}?>>Shipped</option>
                            <option value="Delivered" <?php if($r['order_status']=='Delivered'){echo "selected";}?>>Delivered</option>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-success" name="edit_order" value="Edit"/>
                    </div>
                <?php }?>
                </form>
        </div>
      </div>
    </main>