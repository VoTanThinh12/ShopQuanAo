<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once 'cart_total.php';
require_once 'db.php';

// Lấy thông tin sản phẩm từ database
$product_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: product.php');
    exit;
}

// Xử lý thêm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'] ?? 0;
    $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
    
    if ($user_id) {
        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = ? AND product_name = ?');
        $stmt->execute([$user_id, $product['name']]);
        $cart_item = $stmt->fetch();
        
        if ($cart_item) {
            // Cập nhật số lượng
            $stmt = $pdo->prepare('UPDATE cart SET quantity = quantity + ? WHERE id = ?');
            $stmt->execute([$quantity, $cart_item['id']]);
        } else {
            // Thêm mới vào giỏ hàng
            $stmt = $pdo->prepare('INSERT INTO cart (user_id, product_name, product_image, price, quantity) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$user_id, $product['name'], $product['image'], $product['price'], $quantity]);
        }
        
        header('Location: single.php?id=' . $product_id . '&success=1');
        exit;
    } else {
        header('Location: login.php');
        exit;
    }
}

$stmt = $pdo->query('SELECT DISTINCT category FROM products ORDER BY category');
$navbar_categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
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
<title><?php echo htmlspecialchars($product['name']); ?> - ShopQuanAo</title>
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
.product-detail {
    padding: 30px 0;
}
.product-images {
    position: relative;
    margin-bottom: 30px;
}
.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.thumbnail-images {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}
.thumbnail {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.thumbnail:hover {
    transform: scale(1.05);
}
.product-info {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.product-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
}
.product-category {
    color: #666;
    font-size: 16px;
    margin-bottom: 10px;
}
.product-price {
    font-size: 28px;
    color: #ff6b6b;
    font-weight: 600;
    margin: 20px 0;
}
.product-price .old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 18px;
    margin-right: 10px;
}
.product-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}
.quantity-selector {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.quantity-selector button {
    width: 40px;
    height: 40px;
    border: 1px solid #ddd;
    background: #fff;
    font-size: 18px;
    cursor: pointer;
}
.quantity-selector input {
    width: 60px;
    height: 40px;
    border: 1px solid #ddd;
    text-align: center;
    margin: 0 10px;
}
.add-to-cart {
    background: #ff6b6b;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}
.add-to-cart:hover {
    background: #ff5252;
}
.product-meta {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}
.meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #666;
}
.meta-item i {
    margin-right: 10px;
    color: #ff6b6b;
}
.alert {
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
						<?php if (!empty($_SESSION['user_id']) && !empty($_SESSION['user_name'])): ?>
							<li><a href="#" style="color:#fff; text-decoration:none;">Xin chào, <?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></a></li>
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
								<span>$<?php echo number_format($total_price, 2); ?></span>
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
		<h1>Single</h1>
		<em></em>
		<h2><a href="index.php">Home</a><label>/</label>Single</h2>
	</div>
</div>
<!--content-->
<div class="product-detail">
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                Sản phẩm đã được thêm vào giỏ hàng!
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="product-images">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="main-image">
                    <div class="thumbnail-images">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail 1" class="thumbnail">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail 2" class="thumbnail">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Thumbnail 3" class="thumbnail">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                    <div class="product-price">
                        <span class="old-price"><?php echo number_format($product['price'] * 1.2, 0); ?>đ</span>
                        <?php echo number_format($product['price'], 0); ?>đ
                    </div>
                    <div class="product-description">
                        <?php echo nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả sản phẩm')); ?>
                    </div>
                    <form method="post">
                        <div class="quantity-selector">
                            <button type="button" onclick="decreaseQuantity()">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1">
                            <button type="button" onclick="increaseQuantity()">+</button>
                        </div>
                        <button type="submit" name="add_to_cart" class="add-to-cart">Thêm vào giỏ hàng</button>
                    </form>
                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="glyphicon glyphicon-tag"></i>
                            <span>Mã sản phẩm: <?php echo $product['id']; ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="glyphicon glyphicon-time"></i>
                            <span>Ngày thêm: <?php echo date('d/m/Y', strtotime($product['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script>
function increaseQuantity() {
    var input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    var input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
 
</body>
</html> 