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
                <a href="card.php"><i class="fa fa-shopping-cart" style="font-size: 15px; color: black;cursor: pointer;text-decoration: none;"> Giỏ hàng</i></a>
                &nbsp
                <a href="logout.php" id="login" class="fa fa-sign-in" style="font-size:17px;color: black;text-decoration: none;"></a>
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
    if (isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
    }
    $products = mysqli_query($con, "SELECT * FROM `sach` WHERE sach.tensach LIKE '%".$tukhoa."%'");
    $num = mysqli_num_rows($products);
    ?>
    <div class="container">
    <h2>Từ khóa tìm kiếm: <?= $_POST['tukhoa']?></h2>
    <?php if ($num>0) {?>
    <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                        <a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['img'] ?>" title="<?= $row['tensach'] ?>" /></a>
                        </div>
                        <strong><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['tensach'] ?></strong><br/>
                        <label>Tác giả: </label><span class="product-price"> <?= $row['tacgia'] ?></span><br/>
                        <p>Tình trạng: </p>
                        <div class="buy-button">
                            <a href="detail.php?id=<?= $row['id'] ?>">Chi tiết</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } else {?>
            <p>Không tìm thấy</p>
            <?php }?>
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
    </style>
</body>

</html>