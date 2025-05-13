<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require 'db.php';
require_once 'cart_total.php';

if (isset($_POST['empty_cart']) && !empty($_SESSION['user_id'])) {
    $stmt = $pdo->prepare('DELETE FROM cart WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
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
    <title>
      Shopin A Ecommerce Category Flat Bootstrap Responsive Website Template |
      Home :: w3layouts
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
                    <span>
                        $<?php echo number_format($total_price, 2); ?>
                    </span>
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
    <div class="banner">
      <div class="container">
        <section class="rw-wrapper">
          <h1 class="rw-sentence">
            <span>Fashion &amp; Beauty</span>
            <div class="rw-words rw-words-1">
              <span>Beautiful Designs</span>
              <span>Sed ut perspiciatis</span>
              <span> Totam rem aperiam</span>
              <span>Nemo enim ipsam</span>
              <span>Temporibus autem</span>
              <span>intelligent systems</span>
            </div>
            <div class="rw-words rw-words-2">
              <span>We denounce with right</span>
              <span>But in certain circum</span>
              <span>Sed ut perspiciatis unde</span>
              <span>There are many variation</span>
              <span>The generated Lorem Ipsum</span>
              <span>Excepteur sint occaecat</span>
            </div>
          </h1>
        </section>
      </div>
    </div>
    <!--content-->
    <div class="content">
      <div class="container">
        <div class="content-top">
          <div class="col-md-6 col-md">
            <div class="col-1">
              <a href="single.php" class="b-link-stroke b-animate-go thickbox">
                <img src="images/pi.jpg" class="img-responsive" alt="" />
                <div class="b-wrapper1 long-img">
                  <p class="b-animate b-from-right b-delay03">Lorem ipsum</p>
                  <label class="b-animate b-from-right b-delay03"></label>
                  <h3 class="b-animate b-from-left b-delay03">Trendy</h3>
                </div></a
              >

              <!---<a href="single.php"><img src="images/pi.jpg" class="img-responsive" alt=""></a>-->
            </div>
            <div class="col-2">
              <span>Hot Deal</span>
              <h2><a href="single.php">Luxurious &amp; Trendy</a></h2>
              <p>
                Contrary to popular belief, Lorem Ipsum is not simply random
                text. It has roots in a piece of classical Latin literature from
                45 BC, making it over 2000 years
              </p>
              <a href="single.php.php" class="buy-now">Buy Now</a>
            </div>
          </div>
          <div class="col-md-6 col-md1">
            <div class="col-3">
              <a href="single.php"
                ><img src="images/pi1.jpg" class="img-responsive" alt="" />
                <div class="col-pic">
                  <p>Lorem Ipsum</p>
                  <label></label>
                  <h5>For Men</h5>
                </div></a
              >
            </div>
            <div class="col-3">
              <a href="single.php"
                ><img src="images/pi2.jpg" class="img-responsive" alt="" />
                <div class="col-pic">
                  <p>Lorem Ipsum</p>
                  <label></label>
                  <h5>For Kids</h5>
                </div></a
              >
            </div>
            <div class="col-3">
              <a href="single.php"
                ><img src="images/pi3.jpg" class="img-responsive" alt="" />
                <div class="col-pic">
                  <p>Lorem Ipsum</p>
                  <label></label>
                  <h5>For Women</h5>
                </div></a
              >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <!--products-->
        <div class="content-mid">
          <h3>Trending Items</h3>
          <label class="line"></label>
          <div class="mid-popular">
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Women</span>
                      <h6><a href="single.php">Sed ut perspiciati</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'Sed ut perspiciati'); ?>">
                          <input type="hidden" name="product_image" value="images/pc.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc1.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc1.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Women</span>
                      <h6><a href="single.php">At vero eos</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'At vero eos'); ?>">
                          <input type="hidden" name="product_image" value="images/pc1.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc2.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc2.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Men</span>
                      <h6><a href="single.php">Sed ut perspiciati</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'Sed ut perspiciati'); ?>">
                          <input type="hidden" name="product_image" value="images/pc2.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc3.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc3.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Women</span>
                      <h6><a href="single.php">On the other</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'On the other'); ?>">
                          <input type="hidden" name="product_image" value="images/pc3.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="mid-popular">
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc4.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc4.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Men</span>
                      <h6><a href="single.php">On the other</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'On the other'); ?>">
                          <input type="hidden" name="product_image" value="images/pc4.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc5.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc5.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Men</span>
                      <h6><a href="single.php">Sed ut perspiciati</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'Sed ut perspiciati'); ?>">
                          <input type="hidden" name="product_image" value="images/pc5.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc6.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc6.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Women</span>
                      <h6><a href="single.php">At vero eos</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'At vero eos'); ?>">
                          <input type="hidden" name="product_image" value="images/pc6.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 item-grid simpleCart_shelfItem">
              <div class="mid-pop">
                <div class="pro-img">
                  <img src="images/pc7.jpg" class="img-responsive" alt="" />
                  <div class="zoom-icon">
                    <a
                      class="picture"
                      href="images/pc7.jpg"
                      rel="title"
                      class="b-link-stripe b-animate-go thickbox"
                      ><i class="glyphicon glyphicon-search icon"></i
                    ></a>
                    <a href="single.php"
                      ><i class="glyphicon glyphicon-menu-right icon"></i
                    ></a>
                  </div>
                </div>
                <div class="mid-1">
                  <div class="women">
                    <div class="women-top">
                      <span>Men</span>
                      <h6><a href="single.php">Sed ut perspiciati</a></h6>
                    </div>
                    <div class="img item_add">
                      <?php if (!empty($_SESSION['user_id'])): ?>
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                          <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name'] ?? 'Sed ut perspiciati'); ?>">
                          <input type="hidden" name="product_image" value="images/pc7.jpg">
                          <input type="hidden" name="price" value="70.00">
                          <button type="submit" style="background:none;border:none;padding:0;">
                            <img src="images/ca.png" alt="">
                          </button>
                        </form>
                      <?php else: ?>
                        <a href="login.php"><img src="images/ca.png" alt=""></a>
                      <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="mid-2">
                    <p>
                      <label>$100.00</label><em class="item_price">$70.00</em>
                    </p>
                    <div class="block">
                      <div class="starbox small ghosting"></div>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <!--//products-->
        <!--brand-->
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
        <!--//brand-->
      </div>
    </div>
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
            <form action="register.php" method="post">
              <div class="login-mail">
                <input
                  type="text"
                  name="name"
                  placeholder="Name"
                  required
                  value="<?php echo htmlspecialchars($name ?? ''); ?>"
                />
                <i class="glyphicon glyphicon-user"></i>
              </div>
              <div class="login-mail">
                <input
                  type="text"
                  name="phone"
                  placeholder="Phone Number"
                  required
                  value="<?php echo htmlspecialchars($phone ?? ''); ?>"
                />
                <i class="glyphicon glyphicon-phone"></i>
              </div>
              <div class="login-mail">
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  required
                  value="<?php echo htmlspecialchars($email ?? ''); ?>"
                />
                <i class="glyphicon glyphicon-envelope"></i>
              </div>
              <div class="login-mail">
                <input
                  type="password"
                  name="password"
                  placeholder="Password"
                  required
                />
                <i class="glyphicon glyphicon-lock"></i>
              </div>
              <label class="hvr-skew-backward">
                <input type="submit" value="Submit" />
              </label>
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
    <!--light-box-files -->
    <script src="js/jquery.chocolat.js"></script>
    <link
      rel="stylesheet"
      href="css/chocolat.css"
      type="text/css"
      media="screen"
      charset="utf-8"
    />
    <!--light-box-files -->
    <script type="text/javascript" charset="utf-8">
      $(function () {
        $("a.picture").Chocolat();
      });
    </script>
    <style>
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
  </body>
</html>
