<?php include('layouts/header.php');?>

<?php 

include ('server/connection.php');

if(isset($_POST['register'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  //Kiem tra neu mat khau khong khop
  if($password !== $confirmPassword){
    header('location: register.php?error= Password dont match');
  }

  //Kiem tra neu mat khau it hon 6 ky tu
  else if(strlen($password) < 6){
    header('location: register.php?error=Password must be atleast 6 characters');
  }

  //Neu nhu khong co loi
  else{

    //Kiem tra co tai khoan nao da su dung email nay khong
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    //Neu co user da dang ky tai khoan roi
    if($num_rows !=0){
      header('location: register.php?error=User with this email already exists');

    //Neu chua co nguoi nao dang ky email nay
    }else{

      //Tao acc moi
      $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                            VALUES (?,?,?)");

      $stmt->bind_param('sss',$name,$email,md5($password));

      //Neu tai khoan tao thanh cong
      if($stmt->execute()){
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        
        header('location: account.php?register_success=Registered successfully');

      //Neu tai khoan khong tao thanh cong
      }else{
        header('location: register.php?error=Could not make an account atm');
      }
    }
  }
//Khong cho user quay lai trang register sau khi da regist or dieu huong ve trang account
}else if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

?>
    
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">REGISTER</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form method="POST" id="register-form" action="register.php">
              <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" value="Register" name="register">
                </div>

                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
                </div>

            </form>
        </div>
    </section>

<?php include('layouts/footer.php'); ?>