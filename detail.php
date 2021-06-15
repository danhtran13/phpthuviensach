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
                <a href="logout.php" id="login" class="fa fa-sign-in" style="font-size:15px;color: black;text-decoration: none;"> Giỏ hàng</a>
                &nbsp
                <a href="xemdonhang.php" style="text-decoration: none;font-size:15px">|| Đơn hàng</a>
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
                $result = mysqli_query($con, "SELECT * FROM `sach` WHERE `id` = " . $_GET['id']);
                $product = mysqli_fetch_assoc($result);
    ?>
    <div class="container">
        <div id="product-detail">
            <div id="product-img">
                <img src="<?= $product['img'] ?>" />
            </div>
            <div id="product-info">
                <h1><?= $product['tensach'] ?></h1>
                <label>Tác giả: </label><span class="product-price"><?= $product['tacgia'] ?></span><br />
                <label>Thể loại: </label><span class=""><?= $product['theloai'] ?></span><br />
            <?php if($product['kho']>0) {?>
                <form id="add-to-cart-form" action="cart.php" method="post">
                    <br>
                    <input type="hidden" name="id" value="<?php echo $product['id']?>">
                    <input type="hidden" name="tensach" value="<?php echo $product['tensach']?>">
                    <input type="hidden" name="img" value="<?php echo $product['img']?>">
                    <input type="hidden" name="soluong" value="1">
                    <input class="muonsach1" name="muonsach" type="submit" onclick="alert('Mượn thành công, truy cập giỏ hàng để xem cập nhật.\nLưu ý: Mỗi quyển sách chỉ được mượn 1 quyển.')" value="Mượn sách"/>
                </form>
                <?php }else {?>
                    <br>
                    <input class="muonsach1" name="muonsach" type="submit" onclick="alert('Sách tạm thời hết hàng')" value="Mượn sách"/>
                <?php }?>
            </div>
        </div>
        <div class="description">
            <p> <b> Giới thiệu sách <?php echo "$product[tensach]" ?></b></p> <?= $product['noidung'] ?>
        </div>
    </div>
<?php } else { ?>
    <a href="dangnhap.php"><button style="width:auto;">Đăng nhập | Đăng kí</button></a>
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
                $result = mysqli_query($con, "SELECT * FROM `sach` WHERE `id` = " . $_GET['id']);
                $product = mysqli_fetch_assoc($result);
    ?>
    <div class="container">
        <div id="product-detail">
            <div id="product-img">
                <img src="<?= $product['img'] ?>" />
            </div>
            <div id="product-info">
                <h1><?= $product['tensach'] ?></h1>
                <label>Tác giả: </label><span class="product-price"><?= $product['tacgia'] ?></span><br />
                <label>Thể loại: </label><span class=""><?= $product['theloai'] ?></span><br />
                <br>
                <input class="muonsach1" type="button" onclick="alert('Vui lòng đăng nhập để mượn sách')" value="Mượn sách" />
            </div>
        </div>
        <div class="description">
            <p> <b> Giới thiệu sách <?php echo "$product[tensach]" ?></b></p> <?= $product['noidung'] ?>
        </div>
    </div>
<?php } ?>

<style>
    .container {
        width: 1000px;
        margin: 100px;
        margin-top: 0;
        margin-left: 270px;
    }

    #product-detail {
        padding: 15px 0 0 0;
    }

    #product-img {
        float: left;
    }

    #product-info {
        float: right;
        width: 70%;
        padding-left: 50px;
        line-height: 26px;
        margin-left: 10%;
    }

    .product-price {
        color: #2c7abe;
        font-weight: bold;
    }

    #product-img img {
        max-width: 100%;
        padding: 5px;
        border: 1px solid #000;
        background: #eee;
        margin-left: 58%;
    }

    #add-to-cart-form input[type='number'] {
        height: 26px;
        width: 50px;
    }

    .muonsach1 {
        background: #f96c09;
        border: 1px solid #000;
        margin-top: 10px;
        padding: 10px;
        display: inline-block;
        color: #fff;
        cursor: pointer;
        width: 90px;
    }

    label a {
        color: white;
        font-size: 18px;
        text-decoration: none;
    }

    .description {
        margin-top: 31%;
        margin-left: 10%;
        width: 65%;
        font-size: 16px;
    }

    .description p {
        font-size: 22px;
    }

    * {
        box-sizing: border-box;
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