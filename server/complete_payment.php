<?php

session_start();

include('connection.php');

if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $order_status = "paid";
    $transaction_id = $_GET['transaction_id'];
    $user_id = $_SESSION['user_id'];

    //Doi trang thai tu chua tra sang da or da tra
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);

    $stmt->execute();
    
    //Luu thong tin thanh toan
    $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id)
                    VALUES (?,?,?); ");

    $stmt1->bind_param('iis',$order_id,$user_id,$transaction_id);

    $stmt1->execute();

    //Di den acc user sau khi payment voi paypal xong aka complete payment
    header("location: ../account.php?payment_message=Paid successfully, thks");

} else {
    header("location: index.php");
    exit;
}


?>