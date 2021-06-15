<?php
include 'connect.php';
if (isset($_POST['themsach'])) {
    $idsach = $_POST['idsach'];
    $tensach = $_POST['tensach'];
    $tacgia = $_POST['tacgia'];
    $theloai = $_POST['theloai'];
    $noidung = $_POST['noidung'];
    $anhsach = $_POST['anhsach'];
    $soluong = $_POST['soluong'];
    $sql_themsach = mysqli_query($con,"INSERT INTO sach(idsach,tensach,tacgia,theloai,noidung,img,kho) VALUES ('$idsach','$tensach','$tacgia','$theloai','$noidung','$anhsach','$soluong')");
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

    <title>Admin-Thêm sách</title>
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
            <a class="navbar-brand" href="admin">Trang chủ</a>
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
                                    <!-- <a href="#"> <span class="fa arrow"></span></a> -->
                                    <!-- <ul class="nav nav-third-level">
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
                        <h1 class="page-header">Thêm sách</h1>

                    </div>
                </div>

                <!-- ... Your content goes here ... -->
                <div class="container">
                    <form action="" method="post">
                        <label for="fname">Id sách</label>
                        <input type="text" name="idsach" placeholder="" required>

                        <label for="fname">Tên sách</label>
                        <input type="text" name="tensach" placeholder="" required>

                        <label for="lname">Tên tác giả</label>
                        <input type="text" name="tacgia" placeholder="" required>

                        <label for="country">Thể loại</label>
                        <input type="text" name="theloai" placeholder="" required>

                        <label for="subject">Nội dung</label>
                        <textarea id="subject" name="noidung" placeholder="" style="height:100px" required></textarea>

                        <label for="fname">Ảnh sách</label>
                        <input type="text" name="anhsach" placeholder="Sử dụng link để chèn ảnh." required>

                        <label for="country">Số lượng</label>
                        <input type="text" name="soluong" placeholder="" required>

                        <input type="submit" name="themsach" value="Submit">

                    </form>
                </div>
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
        input[type=text],
        select,
        textarea {
            width: 100%;
            /* Full width */
            padding: 12px;
            /* Some padding */
            border: 1px solid #ccc;
            /* Gray border */
            border-radius: 4px;
            /* Rounded borders */
            box-sizing: border-box;
            /* Make sure that padding and width stays in place */
            margin-top: 6px;
            /* Add a top margin */
            margin-bottom: 16px;
            /* Bottom margin */
            resize: vertical
                /* Allow the user to vertically resize the textarea (not horizontally) */
        }

        /* Style the submit button with a specific background color etc */
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* When moving the mouse over the submit button, add a darker green color */
        input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Add a background color and some padding around the form */
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</body>

</html>