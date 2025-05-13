<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once 'cart_total.php';
require_once 'db.php';

// Yêu cầu đăng nhập trước khi vào trang liên hệ
if (empty($_SESSION['user_id'])) {
    header('Location: login.php?redirect=contact.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
$user_phone = $_SESSION['user_phone'] ?? '';
$total_price = 0;
if ($user_id) {
    $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll();
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}

$stmt = $pdo->query('SELECT DISTINCT category FROM products ORDER BY category');
$navbar_categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Xử lý form liên hệ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $user_name;
    $email = $_POST['email'] ?? $user_email;
    $phone = $_POST['phone'] ?? $user_phone;
    $message = $_POST['message'] ?? '';
    $errors = [];

    // Validate
    if (empty($message)) $errors[] = 'Vui lòng nhập nội dung tin nhắn';
    if (empty($email)) $errors[] = 'Vui lòng nhập email';
    if (empty($phone)) $errors[] = 'Vui lòng nhập số điện thoại';

    if (empty($errors)) {
        // Lưu vào bảng feedback
        $stmt = $pdo->prepare('INSERT INTO feedback (user_id, name, email, phone, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        $ok = $stmt->execute([$user_id, $name, $email, $phone, $message]);
        if ($ok) {
            $success = 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!';
        } else {
            $errors[] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
        }
    }
}
?>
<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Liên hệ - ShopQuanAo</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--theme-style-->
<link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<script src="js/jquery.min.js"></script>
<!--- start-rate---->
<script src="js/jstarbox.js"></script>
	<link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
		</script>
<!---//End-rate---->
<style>
.contact-section {
    padding: 60px 0;
    background: #f8f9fa;
}
.contact-info {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.contact-info h3 {
    color: #333;
    margin-bottom: 20px;
    font-weight: 600;
}
.contact-info ul li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}
.contact-info ul li i {
    margin-right: 10px;
    color: #ff6b6b;
    font-size: 20px;
}
.contact-form {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}
.form-control {
    height: 50px;
    border-radius: 5px;
    margin-bottom: 20px;
}
textarea.form-control {
    height: 150px;
}
.btn-submit {
    background: #ff6b6b;
    color: #fff;
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-submit:hover {
    background: #ff5252;
    transform: translateY(-2px);
}
.social-links {
    margin-top: 20px;
}
.social-links a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: #f8f9fa;
    border-radius: 50%;
    margin-right: 10px;
    color: #333;
    transition: all 0.3s;
}
.social-links a:hover {
    background: #ff6b6b;
    color: #fff;
}
.map-container {
    height: 400px;
    margin-top: 50px;
}
.map-container iframe {
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 10px;
}
.alert {
    border-radius: 5px;
    margin-bottom: 20px;
}
.navbar-nav > .dropdown:hover > .dropdown-menu {
    display: block;
    margin-top: 0;
}
.dropdown-menu {
    min-width: 180px;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    padding: 10px 0;
}
.dropdown-menu > li > a {
    padding: 8px 20px;
    color: #333;
    transition: background 0.2s;
}
.dropdown-menu > li > a:hover {
    background: #f5f5f5;
    color: #ff6b6b;
}
</style>
</head>
<body>
<!--header-->
<div class="header">
<div class="container">
		<div class="head">
			<div class=" logo">
				<a href="index.php"><img src="images/logo.png" alt=""></a>	
			</div>
		</div>
	</div>
	<div class="header-top">
		<div class="container">
		<div class="col-sm-5 col-md-offset-2  header-login">
					<ul >
						<?php if (isset($_SESSION['user_id'])): ?>
							<li><a href="#">Xin chào, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="checkout.php">Checkout</a></li>
						<?php else: ?>
							<li><a href="login.php">Login</a></li>
							<li><a href="register.php">Register</a></li>
							<li><a href="checkout.php">Checkout</a></li>
						<?php endif; ?>
					</ul>
				</div>
				
			<div class="col-sm-5 header-social">		
					<ul >
						<li><a href="#"><i></i></a></li>
						<li><a href="#"><i class="ic1"></i></a></li>
						<li><a href="#"><i class="ic2"></i></a></li>
						<li><a href="#"><i class="ic3"></i></a></li>
						<li><a href="#"><i class="ic4"></i></a></li>
					</ul>
					
			</div>
				<div class="clearfix"> </div>
		</div>
		</div>
		
		<div class="container">
		
			<div class="head-top">
			
		 <div class="col-sm-8 col-md-offset-2 h_menu4">
				<nav class="navbar nav_bottom" role="navigation">
 
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header nav_2">
      <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
   </div> 
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
            <li><a class="color" href="index.php">Home</a></li>
            <li class="dropdown mega-dropdown">
                <a href="#" class="color dropdown-toggle" data-toggle="dropdown">Product <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($navbar_categories as $cat): ?>
                        <li><a href="product.php?category=<?php echo urlencode($cat); ?>"> <?php echo htmlspecialchars($cat); ?> </a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a class="color4" href="404.php">About</a></li>
            <li><a class="color5" href="typo.php">Short Codes</a></li>
            <li ><a class="color6" href="contact.php">Contact</a></li>
        </ul>
     </div><!-- /.navbar-collapse -->

</nav>
			</div>
			<div class="col-sm-2 search-right">
				<ul class="heart">
				<li>
				<a href="wishlist.php" >
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
				</a></li>
				<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i></a></li>
					</ul>
					<div class="cart box_1">
						<a href="checkout.php">
						<h3>
							<div class="total">
								<!-- Đã xóa hiển thị số tiền giỏ hàng -->
							</div>
							<img src="images/cart.png" alt=""/>
						</h3>
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

					</div>
					<div class="clearfix"> </div>
					
						<!----->

						<!---pop-up-box---->					  
			<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
			<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
			<!---//pop-up-box---->
			<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
					<div class="login-search">
						<input type="submit" value="">
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">		
					</div>
					<p>Shopin</p>
				</div>				
			</div>
		 <script>
			$(document).ready(function() {
			$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
			});
																						
			});
		</script>		
						<!----->
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>	
</div>
<!--banner-->
<div class="banner-top">
	<div class="container">
		<h1>Liên hệ</h1>
		<em></em>
		<h2><a href="index.php">Trang chủ</a><label>/</label>Liên hệ</h2>
	</div>
</div>
<!--contact-->
	<!-- <div class="page-head">
		<div class="container">
			<h3>Contact Us</h3>
		</div>
	</div> -->
	<!--contact-->
		<div class="contact-section">
			<div class="container">
				<?php if (!empty($success)): ?>
					<div class="alert alert-success">
						<?php echo htmlspecialchars($success); ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($errors)): ?>
					<div class="alert alert-danger">
						<ul class="mb-0">
							<?php foreach ($errors as $error): ?>
								<li><?php echo htmlspecialchars($error); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-md-4">
						<div class="contact-info">
							<h3>Thông tin liên hệ</h3>
							<ul>
								<li>
									<i class="glyphicon glyphicon-map-marker"></i>
									<span>123 Đường ABC, Quận XYZ, TP.HCM</span>
								</li>
								<li>
									<i class="glyphicon glyphicon-envelope"></i>
									<span>contact@shopquanao.com</span>
								</li>
								<li>
									<i class="glyphicon glyphicon-earphone"></i>
									<span>+84 123 456 789</span>
								</li>
							</ul>
							<div class="social-links">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-youtube"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="contact-form">
							<h3>Gửi tin nhắn cho chúng tôi</h3>
							<form method="post" action="contact.php">
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="name" class="form-control" placeholder="Họ và tên" required value="<?php echo htmlspecialchars($user_name); ?>" readonly>
									</div>
									<div class="col-md-6">
										<input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo htmlspecialchars($user_email); ?>">
									</div>
								</div>
								<input type="tel" name="phone" class="form-control" placeholder="Số điện thoại" required value="<?php echo htmlspecialchars($user_phone); ?>">
								<textarea name="message" class="form-control" placeholder="Nội dung tin nhắn" required></textarea>
								<button type="submit" class="btn btn-submit">Gửi tin nhắn</button>
							</form>
						</div>
					</div>
				</div>

				<div class="map-container">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.424167650401!2d106.6981!3d10.7756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ2JzMyLjEiTiAxMDbCsDQxJzUzLjIiRQ!5e0!3m2!1svi!2s!4v1620000000000!5m2!1svi!2s" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	<!--//contact-->
		<!--map-->
		<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1sen!2sus!4v1510729095945" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<!--//map-->
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
		
	<!--//content-->
		<!--//footer-->
	<div class="footer">
	<div class="footer-middle">
				<div class="container">
					<div class="col-md-3 footer-middle-in">
						<a href="index.php"><img src="images/log.png" alt=""></a>
						<p>Suspendisse sed accumsan risus. Curabitur rhoncus, elit vel tincidunt elementum, nunc urna tristique nisi, in interdum libero magna tristique ante. adipiscing varius. Vestibulum dolor lorem.</p>
					</div>
					
					<div class="col-md-3 footer-middle-in">
						<h6>Information</h6>
						<ul class=" in">
							<li><a href="404.php">About</a></li>
							<li><a href="contact.php">Contact Us</a></li>
							<li><a href="#">Returns</a></li>
							<li><a href="contact.php">Site Map</a></li>
						</ul>
						<ul class="in in1">
							<li><a href="#">Order History</a></li>
							<li><a href="wishlist.php">Wish List</a></li>
							<li><a href="login.php">Login</a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-3 footer-middle-in">
						<h6>Tags</h6>
						<ul class="tag-in">
							<li><a href="#">Lorem</a></li>
							<li><a href="#">Sed</a></li>
							<li><a href="#">Ipsum</a></li>
							<li><a href="#">Contrary</a></li>
							<li><a href="#">Chunk</a></li>
							<li><a href="#">Amet</a></li>
							<li><a href="#">Omnis</a></li>
						</ul>
					</div>
					<div class="col-md-3 footer-middle-in">
						<h6>Newsletter</h6>
						<span>Sign up for News Letter</span>
							<form>
								<input type="text" value="Enter your E-mail" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Enter your E-mail';}">
								<input type="submit" value="Subscribe">	
							</form>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<ul class="footer-bottom-top">
						<li><a href="#"><img src="images/f1.png" class="img-responsive" alt=""></a></li>
						<li><a href="#"><img src="images/f2.png" class="img-responsive" alt=""></a></li>
						<li><a href="#"><img src="images/f3.png" class="img-responsive" alt=""></a></li>
					</ul>
					<p class="footer-class">&copy; 2016 Shopin. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!--//footer-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script src="js/simpleCart.min.js"> </script>
<!-- slide -->
<script src="js/bootstrap.min.js"></script>
 
</body>
</html> 