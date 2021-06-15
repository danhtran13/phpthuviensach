<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/dangnhap.css">
    <title>Document</title>
</head>

<body>
    <div class="limit">
        <div class="login-container">
            <div class="bb-login">
                <form class="bb-form validate-form" method="POST"> <span class="bb-form-title p-b-26"> Welcome </span> <span class="bb-form-title p-b-48"> <i class="mdi mdi-symfony"></i> </span>
                    <div class="wrap-input100 validate-input"> <input class="input100" type="text" name="username" placeholder="Tên đăng nhập"></div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password"><input class="input100" type="password" name="password" placeholder="Mật khẩu"></div>
                    <div class="login-container-form-btn">
                        <?php
                        include 'connect_db_login.php';
                        if (isset($_POST['submit'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $sql = "select * from user where username = '$username' and password = '$password' ";
                            $result = $conn->query($sql)->fetch_assoc();
                            if ($result['password'] == $password) {
                                $_SESSION['user'] = $result;
                                header('location:trangchu.php');
                            }
                            else{
                                echo"Sai thông tin đăng nhập";
                            }
                            $admin = "select * from admin where username = '$username' and password = '$password'";
                            $resultadmin = $conn->query($admin)->fetch_assoc();
                            if($resultadmin['password'] == $password){
                                $_SESSION['admin'] = $resultadmin;
                                header('location:admin.php');
                            }
                            
                        }
                        ?>
                        <div class="bb-login-form-btn">
                            <div class="bb-form-bgbtn"></div> <button class="bb-form-btn" name="submit"> Đăng Nhập </button>
                        </div>
                    </div>
                    <div class="text-center p-t-115"> <span class="txt1"> Bạn chưa có tài khoản? </span> <a class="txt2" href="dangki.php"> Đăng kí </a> </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>