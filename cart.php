<?php
include 'connect_db_login.php';
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
?>
<?php if (isset($user['username'])) { ?>
    <?php
    include 'connect.php';
    if (isset($_POST['muonsach'])) {
        $tensach = $_POST['tensach'];
        $id = $_POST['id'];
        $img = $_POST['img'];
        $soluong = $_POST['soluong'];
        $sql_select_giohang = mysqli_query($con, "SELECT * FROM giohang WHERE sach_id='$id'");
        $count = mysqli_num_rows($sql_select_giohang);
        if ($count > 0) {
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'];
            $sql_giohang = "UPDATE giohang SET soluong='$soluong' WHERE sach_id='$id'";
        } else {
            $soluong = $soluong;
            $sql_giohang = "INSERT INTO giohang(tensach,sach_id,img,soluong) VALUES ('$tensach','$id','$img','$soluong')";
        }
        $insert_row = mysqli_query($con, $sql_giohang);
        if ($insert_row == 1) {
            header('location:detail.php?id=' . $id);
        }
    }
    if (isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        $sql_delete = mysqli_query($con, "DELETE FROM giohang WHERE giohang_id='$id'");
    }
    if (isset($_POST['thanhtoan'])) {
        $name = $_POST['name'];
        $sdt = $_POST['sdt'];
        $songaymuon = $_POST['songaymuon'];
        $note = $_POST['note'];
        $sql_khachhang = mysqli_query($con,"INSERT INTO khachhang(hoten,sdt,songaymuon,ghichu) VALUES ('$name','$sdt','$songaymuon','$note')");
        if ($sql_khachhang) {
            $sql_select_khachhang = mysqli_query($con, "SELECT * FROM khachhang ORDER BY khachhang_id DESC LIMIT 1");
            $mahang = rand(0,9999);
            $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
            $khachhang_id = $row_khachhang['khachhang_id'];
            $sql_hoadon = mysqli_query($con,"INSERT INTO hoadon(mahoadon,tenkhachhang,songaymuon) VALUES ('$mahang','$name','$songaymuon')");
            for ($i=0; $i<count($_POST['thanhtoanproduct_id']) ; $i++) {
                $sanpham_id = $_POST['thanhtoanproduct_id'][$i];
                $soluong = $_POST['thanhtoansoluong'][$i];
                $sql_donhang = mysqli_query($con,"INSERT INTO donhang(sach_id,soluong,mahang,khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
                $sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM giohang WHERE sach_id='$sanpham_id'");
            }
            
        }
    }

    ?>
    <!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang ch???</title>
    <link href="css/css.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <a href="trangchu.php"><img src="img/CDD??.png" alt="logo"></a>
        <form class="example" action="timkiem.php" method="post">
            <input type="text" class="example1" placeholder="Nh???p t??n truy???n c???n t??m" name="tukhoa" required/>
            <button type="submit" name="timkiem"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="navbar">
        <ul>
            <li><a href="trangchu.php" class="color">Home</a></li>
            <li><a href="#" class="color">Th??? lo???i</a></li>
            <li class="submenu"><a href="#" class="color1">Lo???i truy???n</a>
                <ul>
                    <li><a href="#">Truy???n tranh</a></li>
                    <li><a href="#">Truy???n ch???</a></li>
                </ul>
            </li>
            <li class="submenu1"><a href="#" class="color1">S???p x???p</a>
                <ul>
                    <li><a href="#">M???i nh???t</a></li>
                    <li><a href="#">L?????t xem nhi???u nh???t</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Gi???i thi???u</a></li>
            <li><a href="contact.php">????ng g??p ?? ki???n</a></li>
        </ul>
    </div>

        <div class="container">
            <h1>Gi??? h??ng</h1>
            <?php $laygiohang = mysqli_query($con, "SELECT * FROM giohang ORDER BY giohang_id DESC") ?>
            <form id="cart-form" action="" method="POST">
                <table class="table">
                    <tr>
                        <th class="product-number">STT</th>
                        <th class="product-img">???nh s??ch</th>
                        <th class="product-name">T??n s??ch</th>
                        <th class="product-quantity">S??? l?????ng</th>
                        <th class="product-delete">Qu???n l??</th>
                    </tr>
                    <?php
                    $num = 0;
                    while ($row_giohang = mysqli_fetch_array($laygiohang)) {
                        $num++; ?>
                        <tr>
                            <td class="product-number"><?php echo $num ?></td>
                            <td class="product-img"><img src="<?= $row_giohang['img'] ?>" alt=""></td>
                            <td class="product-name"><?php echo $row_giohang['tensach'] ?></td>
                            <td class="product-quantity"><?php echo $row_giohang['soluong'] ?></td>
                            <td class="product-delete"><a href="?xoa=<?php echo $row_giohang['giohang_id'] ?>">X??a</a></td>
                        </tr>
                    <?php } ?>
                </table>
                <!-- <div id="form-button">
                    <input type="submit" name="update_click" value="X??c nh???n m?????n s??ch" />
                </div> -->
                <div>
                <form action="" method="post">
                    <h3>Th??ng tin kh??ch h??ng</h3>
                    <input type="text" name="name" placeholder="H??? v?? t??n" required>
                    <input type="tel" name="sdt" placeholder="S??? ??i???n tho???i" required>
                    <select name="songaymuon">
                        <option value="M?????n 7 ng??y">M?????n 7 ng??y</option>
                        <option value="M?????n 14 ng??y">M?????n 14 ng??y</option>
                        <option value="M?????n 30 ng??y">M?????n 30 ng??y</option>
                    </select>
                    <textarea name="note" placeholder="Ghi ch??" style="height:100px"></textarea>
                    <br>
                    <?php
                    $sql_laysach = mysqli_query($con,"SELECT * FROM giohang ORDER BY giohang_id DESC");
                    while ($row_thanhtoan = mysqli_fetch_array($sql_laysach)) {
                    ?>
                        <input type="hidden" name="thanhtoanproduct_id[]" value="<?= $row_thanhtoan['sach_id'] ?>" >
                        <input type="hidden" name="thanhtoansoluong[]" value="<?= $row_thanhtoan['soluong'] ?>">  
                    <?php }?>
                    <input class="button" type="submit" name="thanhtoan" onclick="alert('Th??nh c??ng')" value="M?????n s??ch" >

                </form>
                </div>
            </form>
        </div>
    <?php } else { ?>
        <!doctype html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Trang ch???</title>
            <link href="css/css.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <div class="header">
            <a href="trangchu.php"><img src="img/CDD??.png" alt="logo"></a>
            <form class="example" action="">
                <input type="text" class="example1" placeholder="Nh???p t??n truy???n c???n t??m" />
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="trangchu.php" class="color">Home</a></li>
                <li><a href="#" class="color">Th??? lo???i</a></li>
                <li class="submenu"><a href="#" class="color1">Lo???i truy???n ???</a>
                    <ul>
                        <li><a href="#">Truy???n tranh</a></li>
                        <li><a href="#">Truy???n ch???</a></li>
                    </ul>
                </li>
                <li class="submenu1"><a href="#" class="color1">S???p x???p ???</a>
                    <ul>
                        <li><a href="#">M???i nh???t</a></li>
                        <li><a href="#">L?????t xem nhi???u nh???t</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Gi???i thi???u</a></li>
                <li><a href="contact.php">????ng g??p ?? ki???n</a></li>
            </ul>
        </div>

        <div class="container">
            <p style="text-align: center;margin-top:30px">B???n c???n ????ng nh???p ????? m?????n s??ch</p>
        </div>
    <?php } ?>
    <style>
        .container {
            width: 1000px;
            margin: 0 auto;
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

        input[name="order_click"] {
            margin-top: 15px;
        }

        #row-total {
            background: #eee;
            color: #000;
        }
        input[name=sdt],
        input[name=name],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical
        }
        .button {
            font-size: 16px;
            background-color: #04AA6D;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }
    </style>

    </body>

    </html>