<?php
    include('dangnhap.php');
    unset($_SESSION['user']);
    header('location:trangchu.php');
?>