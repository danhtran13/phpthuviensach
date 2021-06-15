<?php
include 'connect_db_login.php';
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    <link href="css/css.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <a href="trangchu.php"><img src="img/CDDĐ.png" alt="logo"></a>
        <form class="example" action="timkiem.php" method="post">
            <input type="text" class="example1" placeholder="Nhập tên truyện cần tìm" name="tukhoa" required/>
            <button type="submit" name="timkiem"><i class="fa fa-search"></i></button>
        </form>
        <div class="login">
            <?php if (isset($user['username'])) { ?>
                <button style="width:auto;">Hello, <?php echo $user['username'] ?></button>
                <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 15px; color: black;cursor: pointer;text-decoration: none;"> Giỏ hàng</i></a>
                &nbsp
                <a href="logout.php" id="login" class="fa fa-sign-in" style="font-size:15px;color: black;text-decoration: none;"> Logout</a>
                <a href="xemdonhang.php" style="text-decoration: none;font-size:15px">||  Đơn hàng</a>
            <?php } else { ?>
                <a href="dangnhap.php"><button style="width:auto;">Đăng nhập | Đăng kí</button></a>
            <?php } ?>
        </div>
    </div>
    <div class="navbar">
        <ul>
            <li><a href="trangchu.php" class="color">Home</a></li>
            <li><a href="#" class="color">Thể loại</a></li>
            <li class="submenu"><a href="#" class="color1">Loại truyện ⤈</a>
                <ul>
                    <li><a href="#">Truyện tranh</a></li>
                    <li><a href="#">Truyện chữ</a></li>
                </ul>
            </li>
            <li class="submenu1"><a href="#" class="color1">Sắp xếp ⤈</a>
                <ul>
                    <li><a href="#">Mới nhất</a></li>
                    <li><a href="#">Lượt xem nhiều nhất</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Giới thiệu</a></li>
            <li><a href="contact.php">Đóng góp ý kiến</a></li>
        </ul>
    </div>

    <?php
    include 'connect.php';
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 12;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $products = mysqli_query($con, "SELECT * FROM `sach` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
    $totalRecords = mysqli_query($con, "SELECT * FROM `sach`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    ?>
    <div class="container">
    <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                        <a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['img'] ?>" title="<?= $row['tensach'] ?>" /></a>
                        </div>
                        <strong><a href="detail.php?id=<?= $row['id'] ?>" style="font-size: 17px;"><?= $row['tensach'] ?></a></strong>
                        <br/>
                        <label>Tác giả: </label><span class="product-price"> <?= $row['tacgia'] ?></span><br/>
                        <?php if($row['kho']>0) {?>
                        <p>Tình trạng: <b style="color: black;">Còn hàng<b></p>
                        <?php } else { ?>
                        <p>Tình trạng: <b style="color: blue;">Hết hàng </b></p>
                        <?php }?>
                        <div class="buy-button">
                            <a href="detail.php?id=<?= $row['id'] ?>">Chi tiết</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear-both"></div>
                <?php
                include 'pagination.php';
                ?>
                <div class="clear-both"></div>
            </div>
        </div>
    <style>
        .container {
            width: auto;
            margin: 100px;
            margin-top: 0;
            margin-left: 270px;
        }

        .product-items {
            padding: 10px;
        }

        .product-item {
            float: left;
            width: 20%;
            margin: 1%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            line-height: 26px;
            height: 475px;
        }
        .product-item a{
            font-size: 16px;
        }
        .product-item p {
            margin: 0;
            line-height: 26px;
            overflow: hidden;
            font-size: 14px;
        }

        .product-price {
            color: red;
            font-weight: bold;
        }

        .product-img {
            padding: 5px;
            margin-bottom: 5px;
        }

        .product-item img {
            max-width: 100%;
        }

        .product-item ul {
            margin: 0;
            padding: 0;
            border-right: 1px solid #ccc;
        }

        .product-item ul li {
            float: left;
            width: 33.3333%;
            list-style: none;
            text-align: center;
            border: 1px solid #ccc;
            border-right: 0;
            box-sizing: border-box;
        }

        .clear-both {
            clear: both;
        }

        a {
            text-decoration: none;
        }

        .buy-button {
            text-align: left;
            margin-top: 10px;
        }

        .buy-button a {
            background: #444;
            padding: 3px 3px 4px 0.7px;
            color: #fff;
        }

        #pagination {
            text-align: left;
            margin-top: 15px;
            margin-left: 11px;
        }

        .page-item {
            border: 1px solid #ccc;
            padding: 5px 9px;
            color: #000;
        }

        .current-page {
            background: #000;
            color: #FFF;
        }
        footer{
            display: block;
            text-align: center;
            background-color: #2c7abe;
            height: 40px;
        }
        .footer{
            color: white;
            padding-top: 10px;
        }
    </style>
    <footer>
    <div class="footer">© Design by CDDĐ (2021)</div>
    </footer>
</body>

</html>