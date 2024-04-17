<?php

include ('header.php');

?>


<div class="container-fluid">
  <div class="row">
    <?php include ("sidemenu.php"); ?>


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
  <h2>User Accounts</h2>
  <div class="container">
    <p>Id: <?php echo $_SESSION['admin_id']; ?></p>
    <p>Name: <?php echo $_SESSION['admin_name']; ?></p>
    <p>Email: <?php echo $_SESSION['admin_email']; ?></p>
  </div>

</main>