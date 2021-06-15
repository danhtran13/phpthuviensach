<?php
    include 'connect.php';
    if (isset($_POST['capnhat'])) {
        $xuly = $_POST['xuly'];
        $mahang = $_POST['mahang_xuly'];
        $sql_updatetinhtrang = mysqli_query($con,"UPDATE hoadon SET tinhtrang='$xuly' WHERE mahoadon='$mahang'");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin-Quản lý sách</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin.php">Trang chủ Admin</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav navbar-left navbar-top-links">
                <li><a href="trangchu.php"><i class="fa fa-home fa-fw"></i> Home</a></li>
            </ul>

            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Welcome, admin <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <!-- <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li> -->
                        <li>
                            <a href="admin.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Đơn hàng</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Quản lý sách<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="themsach.php">Thêm sách</a>
                                </li>
                                <li>
                                    <a href="quanlysach.php">Xóa sách</a>
                                    <!-- <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul> -->
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý đơn hàng</h1>

                    </div>
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
                                    if($row_donhang['tinhtrang']==0){
                                        echo"Chưa xử lý";
                                    }
                                    else{
                                        echo"Đã xử lý";
                                    }
                                ?></td>
                                <td class="product-delete"><a href="?xoa=<?php echo $row_donhang['mahoadon'] ?>">Xóa </a>||<a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahoadon']?>"> Xem chi tiết</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
                <?php
                if (isset($_GET['quanly'])=='xemdonhang') {
                    $mahang = $_GET['mahang'];
                    $sql_xemdonhang = mysqli_query($con,"SELECT * FROM donhang,sach WHERE donhang.sach_id=sach.id AND donhang.mahang='$mahang'");
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
                                <input type="hidden" name="mahang_xuly" value="<?php echo $row_chitiethoadon['mahang']?>">
                            </tr>
                        <?php } ?>
                    </table>
                    <select name="xuly" style="height: 27px;">
                        <option value="1">Đã xử lý</option>
                        <option value="0">Chưa xử lý</option>
                    </select>
                    <input type="submit" name="capnhat" value="Cập nhật trạng thái" style="background-color: #04AA6D;color: white;border: none;border-radius: 7px;cursor: pointer;height: 26px;">
                    </form>
                <?php } else{?>

                    <?php } ?>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/startmin.js"></script>
    <style>
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