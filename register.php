<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate
    $errors = [];
    if (!$name) $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';
    if (strlen($password) < 6) $errors[] = 'Password phải >= 6 ký tự.';

    if (empty($errors)) {
        // Kiểm tra email tồn tại
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email đã được đăng ký.';
        } else {
            // Chèn user mới
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('INSERT INTO users (name, phone, email, password_hash) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $phone, $email, $hash]);
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Shopin – Register</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />

<script src="js/jquery.min.js"></script>
<script src="js/jstarbox.js"></script>
<link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
<script>
jQuery(function() {
  jQuery('.starbox').each(function() {
    var starbox = jQuery(this);
    starbox.starbox({
      average: starbox.attr('data-start-value'),
      changeable: !starbox.hasClass('unchangeable'),
      ghosting: starbox.hasClass('ghosting'),
      autoUpdateAverage: starbox.hasClass('autoupdate'),
      buttons: starbox.attr('data-button-count') || 5,
      stars: starbox.attr('data-star-count') || 5
    });
  });
});
</script>

</head>
<body>
<!--header-->
<div class="header">
  <div class="container">
    <div class="head">
      <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt=""></a>	
      </div>
    </div>
  </div>
  <div class="header-top">
    <div class="container">
      <div class="col-sm-5 col-md-offset-2 header-login">
        <ul>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="#" style="color:#fff; text-decoration:none;">Xin chào, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="checkout.html">Checkout</a></li>
          <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="checkout.html">Checkout</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="col-sm-5 header-social">
        <ul>
          <li><a href="#"><i></i></a></li>
          <li><a href="#"><i class="ic1"></i></a></li>
          <li><a href="#"><i class="ic2"></i></a></li>
          <li><a href="#"><i class="ic3"></i></a></li>
          <li><a href="#"><i class="ic4"></i></a></li>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="container">
    <div class="head-top">
      <div class="col-sm-8 col-md-offset-2 h_menu4">
        <nav class="navbar nav_bottom" role="navigation">
          <div class="navbar-header nav_2">
            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
            <ul class="nav navbar-nav nav_1">
              <li><a class="color" href="index.php">Home</a></li>
              <li class="dropdown mega-dropdown active">
                <a class="color1" href="#" data-toggle="dropdown">Women<span class="caret"></span></a>
                <div class="dropdown-menu mega-dropdown-menu">
                  <div class="menu-top">
                    <div class="col1">
                      <div class="h_nav">
                        <h4>Submenu1</h4>
                        <ul>
                          <li><a href="product.html">Accessories</a></li>
                          <li><a href="product.html">Bags</a></li>
                          <li><a href="product.html">Caps & Hats</a></li>
                          <li><a href="product.html">Hoodies & Sweatshirts</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col1">
                      <div class="h_nav">
                        <h4>Submenu2</h4>
                        <ul>
                          <li><a href="product.html">Jackets & Coats</a></li>
                          <li><a href="product.html">Jeans</a></li>
                          <li><a href="product.html">Jewellery</a></li>
                          <li><a href="product.html">Jumpers & Cardigans</a></li>
                          <li><a href="product.html">Leather Jackets</a></li>
                          <li><a href="product.html">Long Sleeve T-Shirts</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col1">
                      <div class="h_nav">
                        <h4>Submenu3</h4>
                        <ul>
                          <li><a href="product.html">Shirts</a></li>
                          <li><a href="product.html">Shoes, Boots & Trainers</a></li>
                          <li><a href="product.html">Sunglasses</a></li>
                          <li><a href="product.html">Sweatpants</a></li>
                          <li><a href="product.html">Swimwear</a></li>
                          <li><a href="product.html">Trousers & Chinos</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col1">
                      <div class="h_nav">
                        <h4>Submenu4</h4>
                        <ul>
                          <li><a href="product.html">T-Shirts</a></li>
                          <li><a href="product.html">Underwear & Socks</a></li>
                          <li><a href="product.html">Vests</a></li>
                          <li><a href="product.html">Jackets & Coats</a></li>
                          <li><a href="product.html">Jeans</a></li>
                          <li><a href="product.html">Jewellery</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col1 col5">
                      <img src="images/me.png" class="img-responsive" alt="">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </li>
              <li class="dropdown mega-dropdown active">
                <a class="color2" href="#" data-toggle="dropdown">Men<span class="caret"></span></a>
                <div class="dropdown-menu mega-dropdown-menu">
                  <div class="menu-top">
                    <!-- tương tự Submenu1-4 cho Men -->
                  </div>
                </div>
              </li>
              <li><a class="color3" href="product.html">Sale</a></li>
              <li><a class="color4" href="404.html">About</a></li>
              <li><a class="color5" href="typo.html">Short Codes</a></li>
              <li><a class="color6" href="contact.html">Contact</a></li>
            </ul>
          </div> <!-- /.navbar-collapse -->
        </nav>
      </div>
      <div class="col-sm-2 search-right">
        <ul class="heart">
          <li><a href="wishlist.html"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></li>
          <li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"></i></a></li>
        </ul>
        <div class="cart box_1">
          <a href="checkout.html">
            <h3>
              <div class="total"><span class="simpleCart_total"></span></div>
              <img src="images/cart.png" alt=""/>
            </h3>
          </a>
          <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
        </div>
        <div class="clearfix"></div>
        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="js/jquery.magnific-popup.js"></script>
        <div id="small-dialog" class="mfp-hide">
          <div class="search-top">
            <div class="login-search">
              <input type="submit" value="">
              <input type="text" value="Search.." onfocus="this.value='';" onblur="if(this.value==''){this.value='Search..';}">
            </div>
            <p>Shopin</p>
          </div>
        </div>
        <script>
        $(document).ready(function() {
          $('.popup-with-zoom-anim').magnificPopup({type:'inline',fixedContentPos:false,fixedBgPos:true,overflowY:'auto',closeBtnInside:true,preloader:false,midClick:true,removalDelay:300,mainClass:'my-mfp-zoom-in'});
        });
        </script>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<!--banner-->
<div class="banner-top">
  <div class="container">
    <h1>Register</h1>
    <em></em>
    <h2><a href="index.php">Home</a><label>/</label>Register</h2>
  </div>
</div>

<!--login-->
<div class="container">
  <div class="login">
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="register.php" method="post">
      <div class="col-md-6 login-do">
        <div class="login-mail">
          <input 
            type="text" 
            name="name" 
            placeholder="Name" 
            required 
            value="<?php echo htmlspecialchars($name ?? ''); ?>">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="login-mail">
          <input 
            type="text" 
            name="phone" 
            placeholder="Phone Number" 
            required 
            value="<?php echo htmlspecialchars($phone ?? ''); ?>">
          <i class="glyphicon glyphicon-phone"></i>
        </div>
        <div class="login-mail">
          <input 
            type="text" 
            name="email" 
            placeholder="Email" 
            required 
            value="<?php echo htmlspecialchars($email ?? ''); ?>">
          <i class="glyphicon glyphicon-envelope"></i>
        </div>
        <div class="login-mail">
          <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            required>
          <i class="glyphicon glyphicon-lock"></i>
        </div>
        <label class="hvr-skew-backward">
          <input type="submit" value="Submit">
        </label>
      </div>

      <div class="col-md-6 login-right">
        <h3>Completely Free Account</h3>
        <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum.</p>
        <a href="login.php" class="hvr-skew-backward">Login</a>
      </div>

      <div class="clearfix"></div>
    </form>
  </div>
</div>
<!--//login-->

<!--brand-->
<div class="container">
  <div class="brand">
    <div class="col-md-3 brand-grid">
      <img src="images/ic.png" class="img-responsive" alt="">
    </div>
    <div class="col-md-3 brand-grid">
      <img src="images/ic1.png" class="img-responsive" alt="">
    </div>
    <div class="col-md-3 brand-grid">
      <img src="images/ic2.png" class="img-responsive" alt="">
    </div>
    <div class="col-md-3 brand-grid">
      <img src="images/ic3.png" class="img-responsive" alt="">
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!--//brand-->

<!--footer-->
<div class="footer">
  <div class="footer-middle">
    <div class="container">
      <!-- (Nội dung footer giữ nguyên như trong register.php) -->
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <ul class="footer-bottom-top">
        <li><a href="#"><img src="images/f1.png" class="img-responsive" alt=""></a></li>
        <li><a href="#"><img src="images/f2.png" class="img-responsive" alt=""></a></li>
        <li><a href="#"><img src="images/f3.png" class="img-responsive" alt=""></a></li>
      </ul>
      <p class="footer-class">&copy; 2016 Shopin. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!--//footer-->

<script src="js/simpleCart.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
