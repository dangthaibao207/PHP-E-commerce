<?php include('layouts/header.php');?>

<?php 

  if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
  }

?>
  
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">PAYMENT</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">

      <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "Not paid"){?>
        <?php $amount = strval($_POST['order_total_price']); ?>
        <?php $order_id = $_POST['order_id']; ?>
        <p>Total payment: kVND<?php echo $_POST['order_total_price'];?></p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now"/> -->
        <div id="paypal-button-container"></div>

      <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){?>
        <?php $amount = strval($_SESSION['total']); ?>
        <?php $order_id = $_SESSION['order_id']; ?>
        <p>Total payment: <?php echo $_SESSION['total'];?>kVND</p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now"/> -->
        <div id="paypal-button-container"></div>

      <?php } else {?>
        <p>You don't have an order</p>
      <?php } ?>
      
    </div>
</section>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AfYiFo-GaDi5xmwRJplYuqkEV5NGXhuhd2ZvmUpyyHaFnX2TY1wfGiEpmFRKvyYz1QTUKMsFORZTFhNI&currency=USD"></script>
        <!-- Set up a container element for the button -->
        
        <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '<?php echo $amount;?>'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData) {
        console.log('Transaction completed by ', orderData, JSON.stringify(orderData, null, 2));
        alert('Transaction completed. Thank you!');
        var transaction = orderData.purchase_units[0].payments.captures[0];
        window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id;?>;
      });
    },
    onError: function(err) {
      console.error('PayPal error:', err);
      alert('An error occurred. Please try again later.');
    }
  }).render('#paypal-button-container');
</script>


<?php include('layouts/footer.php'); ?>