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
            <input type="text" class="example1" placeholder="Nhập tên truyện cần tìm" name="tukhoa" required />
            <button type="submit" name="timkiem"><i class="fa fa-search"></i></button>
        </form>
        <div class="login">
            <?php if (isset($user['username'])) { ?>
                <button style="width:auto;">Hello, <?php echo $user['username'] ?></button>
                <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 15px; color: black;cursor: pointer;text-decoration: none;"> Giỏ hàng</i></a>
                &nbsp
                <a href="logout.php" id="login" class="fa fa-sign-in" style="font-size:15px;color: black;text-decoration: none;"> Logout</a>
                &nbsp
                <a href="xemdonhang.php" style="text-decoration: none;font-size:15px">|| Đơn hàng</a>
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
    $sql_danhsachdonhang = mysqli_query($con, "SELECT * FROM hoadon ORDER BY hoadon_id DESC");
    if (isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        $sql_deletehoadon = mysqli_query($con, "DELETE FROM hoadon WHERE mahoadon='$id'");
    }
    ?>
    <!-- ... Your content goes here ... -->
    <div class="donhang">
    <form id="cart-form" action="" method="POST">
        <table class="table">
            <tr>
                <th class="product-number">STT</th>
                <th class="product-img">Mã đơn hàng</th>
                <th class="product-quantity">Tên khách hàng</th>
                <th class="product-quantity">Ngày mượn sách</th>
                <th class="product-quantity">Số ngày mượn</th>
                <th class="product-quantity">Tình trạng</th>
                <th class="product-delete">Quản lý</th>
            </tr>
            <?php
            $i = 0;
            while ($row_donhang = mysqli_fetch_array($sql_danhsachdonhang)) {
                $i++;
            ?>
                <tr>
                    <td class="product-number"><?php echo $i ?></td>
                    <td class="product-img"><?= $row_donhang['mahoadon'] ?></td>
                    <td class="product-quantity"><?php echo $row_donhang['tenkhachhang'] ?></td>
                    <td class="product-quantity"><?php echo $row_donhang['ngaymuon'] ?></td>
                    <td class="product-quantity"><?php echo $row_donhang['songaymuon'] ?></td>
                    <td class="product-quantity"><?php
                                                    if ($row_donhang['tinhtrang'] == 0) {
                                                        echo "Chưa xử lý";
                                                    } else {
                                                        echo "Đã xử lý";
                                                    }
                                                    ?></td>
                    <td class="product-delete"><a href="?xoa=<?php echo $row_donhang['mahoadon'] ?>">Hủy đơn hàng </a>||<a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahoadon'] ?>"> Xem chi tiết</a></td>
                </tr>
            <?php } ?>
        </table>
    </form>
    <?php
    if (isset($_GET['quanly']) == 'xemdonhang') {
        $mahang = $_GET['mahang'];
        $sql_xemdonhang = mysqli_query($con, "SELECT * FROM donhang,sach WHERE donhang.sach_id=sach.id AND donhang.mahang='$mahang'");
    ?>
        <h4>Chi tiết hóa đơn</h4>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <th class="product-number">STT</th>
                    <th class="product-img">Ảnh sách</th>
                    <th class="product-quantity">Tên sách</th>
                    <th class="product-quantity">Tác giả</th>
                    <th class="product-quantity">Số lượng</th>
                </tr>
                <?php
                $i = 0;
                while ($row_chitiethoadon = mysqli_fetch_array($sql_xemdonhang)) {
                    $i++;
                ?>
                    <tr>
                        <td class="product-number"><?php echo $i ?></td>
                        <td class="product-img"><img src="<?= $row_chitiethoadon['img'] ?>" alt=""></td>
                        <td class="product-quantity"><?php echo $row_chitiethoadon['tensach'] ?></td>
                        <td class="product-quantity"><?php echo $row_chitiethoadon['tacgia'] ?></td>
                        <td class="product-quantity"><?php echo $row_chitiethoadon['soluong'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
                </div>
    <?php } else { ?>

    <?php } ?>
    <style>
        a{
            text-decoration: none;
            color: blue;
        }
        .donhang {
            margin-left: 260px;
            margin-top: 50px;
        }
        table.table {
            border-collapse: collapse;
            width: 1000px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table .product-img img {
            width: 100px;
        }

        table .product-name {
            width: 200px;
            padding-left: 20px;
        }

        table .product-img {
            width: 5px;
            text-align: center;
        }

        table .product-number {
            width: 2px;
            text-align: center;
        }

        table .product-price {
            width: 100px;
            text-align: center;
        }

        table .product-quantity input {
            width: 40px;
            text-align: center;
        }

        table .product-quantity {
            width: 10px;
            text-align: center;
        }

        #form-button {
            text-align: right;
            margin-top: 15px;
        }

        .product-delete {
            width: 100px;
            text-align: center;
        }

        .product-delete a {
            text-decoration: none;
        }

        #cart-form label {
            width: 100px;
            display: inline-block;
            margin-top: 15px;
        }

        #cart-form textarea {
            margin-top: 15px;
        }

        #cart-form input {
            line-height: 30px;
            height: 30px;
        }

    </style>
</body>

</html>