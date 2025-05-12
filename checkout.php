<?php
    if (session_status() == PHP_SESSION_NONE) session_start();
    require_once 'cart_total.php';
    require 'db.php';
    $user_id = $_SESSION['user_id'] ?? 0;
    $cart_items = [];
    if ($user_id) {
        $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = ?');
        $stmt->execute([$user_id]);
        $cart_items = $stmt->fetchAll();
    }
    
    // Tính tổng tiền
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
    
    // Xử lý nút Empty Cart (xóa giỏ hàng, không thanh toán)
    if (isset($_POST['empty_cart']) && !empty($_SESSION['user_id'])) {
        $stmt = $pdo->prepare('DELETE FROM cart WHERE user_id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
    
    // Xử lý khi submit form thanh toán
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $card_number = $_POST['card_number'];
        $expiry_date = $_POST['expiry_date'];
        $cvv = $_POST['cvv'];
        
        // Giả lập trạng thái thanh toán (thực tế nên tích hợp cổng thanh toán)
        $payment_status = 'paid';
        
        // Lưu đơn hàng vào database
        if ($payment_status == 'paid') {
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, payment_status, payment_method) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $total_price, $payment_status, 'Credit Card']);
            
            // Chuyển hướng sang trang xác nhận đơn hàng
            header("Location: order_confirmation.php");
            exit;
        } else {
            $error_message = "Thanh toán thất bại. Vui lòng thử lại.";
        }
    }
    ?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Shopin A Ecommerce Category Flat Bootstrap Responsive Website Template |
      Checkout :: w3layouts
    </title>
    <link
      href="css/bootstrap.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta
      name="keywords"
      content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
    />
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!--theme-style-->
    <link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <script src="js/jquery.min.js"></script>
    <!--- start-rate---->
    <script src="js/jstarbox.js"></script>
    <link
      rel="stylesheet"
      href="css/jstarbox.css"
      type="text/css"
      media="screen"
      charset="utf-8"
    />
    <script type="text/javascript">
      jQuery(function () {
        jQuery(".starbox").each(function () {
          var starbox = jQuery(this);
          starbox
            .starbox({
              average: starbox.attr("data-start-value"),
              changeable: starbox.hasClass("unchangeable")
                ? false
                : starbox.hasClass("clickonce")
                ? "once"
                : true,
              ghosting: starbox.hasClass("ghosting"),
              autoUpdateAverage: starbox.hasClass("autoupdate"),
              buttons: starbox.hasClass("smooth")
                ? false
                : starbox.attr("data-button-count") || 5,
              stars: starbox.attr("data-star-count") || 5,
            })
            .bind("starbox-value-changed", function (event, value) {
              if (starbox.hasClass("random")) {
                var val = Math.random();
                starbox.next().text(" " + val);
                return val;
              }
            });
        });
      });
    </script>
    <!---//End-rate---->
  </head>
  <body>
    <!--header-->
    <div class="header">
      <div class="container">
        <div class="head">
          <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="" /></a>
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
                  <li><a href="checkout.php">Checkout</a></li>
              <?php else: ?>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>
                  <li><a href="checkout.php">Checkout</a></li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="col-sm-5 header-social">
            <ul>
              <li>
                <a href="#"><i></i></a>
              </li>
              <li>
                <a href="#"><i class="ic1"></i></a>
              </li>
              <li>
                <a href="#"><i class="ic2"></i></a>
              </li>
              <li>
                <a href="#"><i class="ic3"></i></a>
              </li>
              <li>
                <a href="#"><i class="ic4"></i></a>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="container">
        <div class="head-top">
          <div class="col-sm-8 col-md-offset-2 h_menu4">
            <nav class="navbar nav_bottom" role="navigation">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header nav_2">
                <button
                  type="button"
                  class="navbar-toggle collapsed navbar-toggle1"
                  data-toggle="collapse"
                  data-target="#bs-megadropdown-tabs"
                >
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
                  <li class="dropdown mega-dropdown active">
                    <a
                      class="color1"
                      href="#"
                      class="dropdown-toggle"
                      data-toggle="dropdown"
                      >Women<span class="caret"></span
                    ></a>
                    <div class="dropdown-menu">
                      <div class="menu-top">
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu1</h4>
                            <ul>
                              <li><a href="product.php">Accessories</a></li>
                              <li><a href="product.php">Bags</a></li>
                              <li><a href="product.php">Caps & Hats</a></li>
                              <li>
                                <a href="product.php">Hoodies & Sweatshirts</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu2</h4>
                            <ul>
                              <li>
                                <a href="product.php">Jackets & Coats</a>
                              </li>
                              <li><a href="product.php">Jeans</a></li>
                              <li><a href="product.php">Jewellery</a></li>
                              <li>
                                <a href="product.php">Jumpers & Cardigans</a>
                              </li>
                              <li>
                                <a href="product.php">Leather Jackets</a>
                              </li>
                              <li>
                                <a href="product.php">Long Sleeve T-Shirts</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu3</h4>
                            <ul>
                              <li><a href="product.php">Shirts</a></li>
                              <li>
                                <a href="product.php"
                                  >Shoes, Boots & Trainers</a
                                >
                              </li>
                              <li><a href="product.php">Sunglasses</a></li>
                              <li><a href="product.php">Sweatpants</a></li>
                              <li><a href="product.php">Swimwear</a></li>
                              <li>
                                <a href="product.php">Trousers & Chinos</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu4</h4>
                            <ul>
                              <li><a href="product.php">T-Shirts</a></li>
                              <li>
                                <a href="product.php">Underwear & Socks</a>
                              </li>
                              <li><a href="product.php">Vests</a></li>
                              <li>
                                <a href="product.php">Jackets & Coats</a>
                              </li>
                              <li><a href="product.php">Jeans</a></li>
                              <li><a href="product.php">Jewellery</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1 col5">
                          <img
                            src="images/me.png"
                            class="img-responsive"
                            alt=""
                          />
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </li>
                  <li class="dropdown mega-dropdown active">
                    <a
                      class="color2"
                      href="#"
                      class="dropdown-toggle"
                      data-toggle="dropdown"
                      >Men<span class="caret"></span
                    ></a>
                    <div class="dropdown-menu mega-dropdown-menu">
                      <div class="menu-top">
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu1</h4>
                            <ul>
                              <li><a href="product.php">Accessories</a></li>
                              <li><a href="product.php">Bags</a></li>
                              <li><a href="product.php">Caps & Hats</a></li>
                              <li>
                                <a href="product.php">Hoodies & Sweatshirts</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu2</h4>
                            <ul>
                              <li>
                                <a href="product.php">Jackets & Coats</a>
                              </li>
                              <li><a href="product.php">Jeans</a></li>
                              <li><a href="product.php">Jewellery</a></li>
                              <li>
                                <a href="product.php">Jumpers & Cardigans</a>
                              </li>
                              <li>
                                <a href="product.php">Leather Jackets</a>
                              </li>
                              <li>
                                <a href="product.php">Long Sleeve T-Shirts</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu3</h4>

                            <ul>
                              <li><a href="product.php">Shirts</a></li>
                              <li>
                                <a href="product.php"
                                  >Shoes, Boots & Trainers</a
                                >
                              </li>
                              <li><a href="product.php">Sunglasses</a></li>
                              <li><a href="product.php">Sweatpants</a></li>
                              <li><a href="product.php">Swimwear</a></li>
                              <li>
                                <a href="product.php">Trousers & Chinos</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1">
                          <div class="h_nav">
                            <h4>Submenu4</h4>
                            <ul>
                              <li><a href="product.php">T-Shirts</a></li>
                              <li>
                                <a href="product.php">Underwear & Socks</a>
                              </li>
                              <li><a href="product.php">Vests</a></li>
                              <li>
                                <a href="product.php">Jackets & Coats</a>
                              </li>
                              <li><a href="product.php">Jeans</a></li>
                              <li><a href="product.php">Jewellery</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col1 col5">
                          <img
                            src="images/me1.png"
                            class="img-responsive"
                            alt=""
                          />
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </li>
                  <li><a class="color3" href="product.php">Sale</a></li>
                  <li><a class="color4" href="404.php">About</a></li>
                  <li><a class="color5" href="typo.php">Short Codes</a></li>
                  <li><a class="color6" href="contact.php">Contact</a></li>
                </ul>
              </div>
              <!-- /.navbar-collapse -->
            </nav>
          </div>
          <div class="col-sm-2 search-right">
            <ul class="heart">
              <li>
                <a href="wishlist.php">
                  <span
                    class="glyphicon glyphicon-heart"
                    aria-hidden="true"
                  ></span>
                </a>
              </li>
              <li>
                <a class="play-icon popup-with-zoom-anim" href="#small-dialog"
                  ><i class="glyphicon glyphicon-search"> </i
                ></a>
              </li>
            </ul>
            <div class="cart box_1">
              <a href="checkout.php">
                <h3>
                  <div class="total">
                    <span>$<?php echo number_format($total_price, 2); ?></span>
                  </div>
                  <img src="images/cart.png" alt="" />
                </h3>
              </a>
              <form method="post" style="display:inline;">
                  <button type="submit" name="empty_cart" class="btn btn-link" style="color:#b5b3b3; padding:0; border:none; background:none;" onclick="return confirm('Are you sure you want to empty your cart?');">Empty Cart</button>
              </form>
            </div>
            <div class="clearfix"></div>

            <!----->

            <!---pop-up-box---->
            <link
              href="css/popuo-box.css"
              rel="stylesheet"
              type="text/css"
              media="all"
            />
            <script
              src="js/jquery.magnific-popup.js"
              type="text/javascript"
            ></script>
            <!---//pop-up-box---->
            <div id="small-dialog" class="mfp-hide">
              <div class="search-top">
                <div class="login-search">
                  <input type="submit" value="" />
                  <input
                    type="text"
                    value="Search.."
                    onfocus="this.value = '';"
                    onblur="if (this.value == '') {this.value = 'Search..';}"
                  />
                </div>
                <p>Shopin</p>
              </div>
            </div>
            <script>
              $(document).ready(function () {
                $(".popup-with-zoom-anim").magnificPopup({
                  type: "inline",
                  fixedContentPos: false,
                  fixedBgPos: true,
                  overflowY: "auto",
                  closeBtnInside: true,
                  preloader: false,
                  midClick: true,
                  removalDelay: 300,
                  mainClass: "my-mfp-zoom-in",
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
        <h1>Checkout</h1>
        <em></em>
        <h2><a href="index.php">Home</a><label>/</label>Checkout</h2>
      </div>
    </div>
    <!--login-->
    <script>
      $(document).ready(function (c) {
        $(".close1").on("click", function (c) {
          $(".cart-header").fadeOut("slow", function (c) {
            $(".cart-header").remove();
          });
        });
      });
    </script>
    <script>
      $(document).ready(function (c) {
        $(".close2").on("click", function (c) {
          $(".cart-header1").fadeOut("slow", function (c) {
            $(".cart-header1").remove();
          });
        });
      });
    </script>
    <script>
      $(document).ready(function (c) {
        $(".close3").on("click", function (c) {
          $(".cart-header2").fadeOut("slow", function (c) {
            $(".cart-header2").remove();
          });
        });
      });
    </script>

    <div class="check-out">
      <div class="container">
        <div class="bs-example4" data-example-id="simple-responsive-table">
          <div class="table-responsive">
            <style>
              .checkout-table th, .checkout-table td {
                text-align: center;
                vertical-align: middle;
              }
              .checkout-table th {
                background: #f8f8f8;
                font-size: 1.2em;
                border-bottom: 2px solid #f67777;
              }
              .checkout-table tr {
                border-bottom: 1px solid #eee;
              }
              .checkout-table td {
                background: #fff;
                color: #222;
                font-size: 1.05em;
                padding: 18px 10px;
              }
              .checkout-table .product-name {
                font-weight: bold;
                color: #f67777;
                font-size: 1.1em;
                text-align: left;
              }
              .checkout-table img {
                border-radius: 8px;
                box-shadow: 0 2px 8px #eee;
                margin-right: 12px;
              }
              .checkout-table tfoot td {
                font-weight: bold;
                font-size: 1.15em;
                background: #f9f9f9;
                color: #f67777;
                border-top: 2px solid #f67777;
              }
            </style>
            <table class="table-heading simpleCart_shelfItem checkout-table">
              <tr>
                <th class="table-grid">Item</th>
                <th>Prices</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
              <?php if (empty($cart_items)): ?>
                <tr><td colspan="4">Giỏ hàng trống.</td></tr>
              <?php else: ?>
                <?php foreach ($cart_items as $item): ?>
                  <tr>
                    <td class="ring-in product-name">
                      <img src="<?php echo htmlspecialchars($item['product_image']); ?>" class="img-responsive" alt="" style="max-width:60px;display:inline-block;vertical-align:middle;">
                      <span style="vertical-align:middle;"> <?php echo htmlspecialchars($item['product_name']); ?> </span>
                    </td>
                    <td>$<?php echo number_format($item['price'],2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'],2); ?></td>
                  </tr>
                <?php endforeach; ?>
                <tfoot>
                  <tr>
                    <td colspan="3" style="text-align:right;">Tổng cộng:</td>
                    <td>$<?php echo number_format($total_price,2); ?></td>
                  </tr>
                </tfoot>
              <?php endif; ?>
            </table>
          </div>
        </div>
        <!-- FORM THANH TOÁN -->
        <div class="payment-form" style="margin-top:30px;">
          <h3>Thông tin thanh toán</h3>
          <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>
          <form action="checkout.php" method="POST">
              <div class="form-group">
                  <label for="card_number">Số thẻ</label>
                  <input type="text" id="card_number" name="card_number" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="expiry_date">Ngày hết hạn</label>
                  <input type="text" id="expiry_date" name="expiry_date" class="form-control" required placeholder="MM/YY">
              </div>
              <div class="form-group">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" name="cvv" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="total_price">Tổng cộng</label>
                  <input type="text" id="total_price" name="total_price" class="form-control" value="<?php echo number_format($total_price, 2); ?>" readonly>
              </div>
              <button type="submit" class="btn btn-primary">Thanh toán</button>
          </form>
        </div>
        <div class="produced">
          <a href="single.php" class="hvr-skew-backward">Produced To Buy</a>
        </div>
      </div>
    </div>

    <!--//login-->
    <!--brand-->
    <div class="container">
      <div class="brand">
        <div class="col-md-3 brand-grid">
          <img src="images/ic.png" class="img-responsive" alt="" />
        </div>
        <div class="col-md-3 brand-grid">
          <img src="images/ic1.png" class="img-responsive" alt="" />
        </div>
        <div class="col-md-3 brand-grid">
          <img src="images/ic2.png" class="img-responsive" alt="" />
        </div>
        <div class="col-md-3 brand-grid">
          <img src="images/ic3.png" class="img-responsive" alt="" />
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
            <a href="index.php"><img src="images/log.png" alt="" /></a>
            <p>
              Suspendisse sed accumsan risus. Curabitur rhoncus, elit vel
              tincidunt elementum, nunc urna tristique nisi, in interdum libero
              magna tristique ante. adipiscing varius. Vestibulum dolor lorem.
            </p>
          </div>

          <div class="col-md-3 footer-middle-in">
            <h6>Information</h6>
            <ul class="in">
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
              <input
                type="text"
                value="Enter your E-mail"
                onfocus="this.value='';"
                onblur="if (this.value == '') {this.value ='Enter your E-mail';}"
              />
              <input type="submit" value="Subscribe" />
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <ul class="footer-bottom-top">
            <li>
              <a href="#"
                ><img src="images/f1.png" class="img-responsive" alt=""
              /></a>
            </li>
            <li>
              <a href="#"
                ><img src="images/f2.png" class="img-responsive" alt=""
              /></a>
            </li>
            <li>
              <a href="#"
                ><img src="images/f3.png" class="img-responsive" alt=""
              /></a>
            </li>
          </ul>
          <p class="footer-class">
            &copy; 2016 Shopin. All Rights Reserved | Design by
            <a href="http://w3layouts.com/" target="_blank">W3layouts</a>
          </p>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!--//footer-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="js/simpleCart.min.js"></script>
    <!-- slide -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html> 