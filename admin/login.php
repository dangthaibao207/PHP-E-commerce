<?php include("header.php"); ?>

<?php 

  include('../server/connection.php');

  if(isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
  }

  if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email= ? AND admin_password= ? LIMIT 1");

    $stmt->bind_param('ss',$email,$password);

    if($stmt->execute()){
      $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
      $stmt->store_result();

      if($stmt->num_rows() == 1){
        $stmt->fetch();

        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_email'] = $admin_email;
        $_SESSION['admin_logged_in'] = true;

        header('location: index.php?login_success=Logged in successfully');

      }else{
        header('location: login.php?error=Could not verify your account');
      }

    }else{
      header('location: login.php?error=Something went wrong');
    }

  }

?>

<main class="form-signin w-100 m-auto">
<form action="login.php" method="POST" id="login-form">
                <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" value="login" name="login_btn">
                </div>

                <div class="form-group">
                    <a href="register.php" id="register-url" class="btn">Don't have an account?</a>
                </div>

            </form>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>
