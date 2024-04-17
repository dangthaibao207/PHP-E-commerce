<?php 

session_start();

include('connection.php');

//User phai login vo moi duoc order
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login to place an order');
    exit;
}

//Lay thong tin user va luu vao db
if(isset($_POST['place_order'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "Not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                    VALUES (?,?,?,?,?,?,?);");

    $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

    $stmt_status = $stmt->execute();

    if(!$stmt_status){
        header('location: index.php');
        exit;
    }

    //Tao order moi va luu thong tin order vao csdl
    $order_id = $stmt->insert_id;

    //Lay san pham tu gio hang (tu session)
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        
    //Luu chi tiet moi san pham vao order-item trong phpadmin
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                        VALUES (?,?,?,?,?,?,?,?)");

        $stmt1->bind_param("iissiiis",$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

        $stmt1->execute();
    }

    $_SESSION['order_id'] = $order_id;
    //Bao cho nguoi dung khi co loi hoac ok
    header('location: ../payment.php?order_status=Order placed successfully');
}

?>