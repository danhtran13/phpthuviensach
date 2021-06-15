<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Phản hồi</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/contact-form.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
    <a href="trangchu.php"><img src="img/CDDĐ.png" alt="logo"></a>
    <form class="example" action="">
      <input type="text" class="example1" placeholder="Nhập tên truyện cần tìm" />
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <div class="login">
    <?php if(isset( $user['username'])){?>
    <button style="width:auto;">Hello, <?php echo $user['username']?></button>
    <a href="logout.php" id="login" class="fa fa-sign-in" style="font-size:20px;color: black;text-decoration: none;"></a>
    <?php } else{?>
        <a href="dangnhap.php"><button style="width:auto;">Đăng nhập | Đăng kí</button></a>
        <?php }?>
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
      <li><a href="contact.html">Đóng góp ý kiến</a></li>
    </ul>
  </div>
 <div class="fcf-body">

    <div id="fcf-form">
    <h3 class="fcf-h3">Contact us</h3>

    <form id="fcf-form-id" class="fcf-form-class" method="post" action="contact-form-process.php">
        
        <div class="fcf-form-group">
            <label for="Name" class="fcf-label">Your name</label>
            <div class="fcf-input-group">
                <input type="text" id="Name" name="Name" class="fcf-form-control" placeholder="Vui lòng điền tên..." required>
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Email" class="fcf-label">Your email address</label>
            <div class="fcf-input-group">
                <input type="email" id="Email" name="Email" class="fcf-form-control" placeholder="Vui lòng điền Email..." required>
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Message" class="fcf-label">Your message</label>
            <div class="fcf-input-group">
                <textarea id="Message" name="Message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
            </div>
        </div>

        <div class="fcf-form-group">
            <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send Message</button>
        </div>


    </form>
    </div>

</div>
</body>
</html>