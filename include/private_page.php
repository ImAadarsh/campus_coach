<?php 
session_start();
if(!isset($_SESSION['token'])&&!isset($_SESSION['cart_id'])&&!isset($_SESSION['email'])){
    echo "<script>alert('Session Expired. Please login again.');
    window.location.href='../login.php';
    </script>";

}