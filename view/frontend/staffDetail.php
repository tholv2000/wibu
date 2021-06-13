<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tho Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../Assets/Frontend/images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="../../Assets/Frontend/css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/bootstrap.min.css">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../../Assets/Frontend/css/responsive.css">
    <!-- Modernizr js -->
    <script src="../../Assets/Frontend/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-3 col-md-4">
                        <div class="header-top-left">
                            <ul class="phone-wrap">
                                <li><span>Số điện thoại: 0222333333</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="#">
                                <img src="../../Assets/Frontend/images/menu/logo/1.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form action="#" class="hm-searchbox">
                            <input type="text" placeholder="Nhập thứ bạn cần tìm kiếm ...">
                            <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu">
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span class="item-text">0đ
                                                    <span class="cart-item-count">0</span>
                                                </span>
                                    </div>
                                    <span></span>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu">
                            <nav>
                                <ul>
                                    <li><a href="#">Trang chủ</a></li>
                                    <li><a href="#">Cửa hàng</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                    <li><a href="#">Giới thiệu</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
    </header>
    <!-- Header Area End Here -->
    <?php
        include "../../dao/dbConnect.php";
        $id = $_GET['id'];
        $query = "select * from tbl_staff where id ='$id'";
        $result = $GLOBALS['conn'] -> query($query);
        $row = $result -> fetch_assoc();
    ?>
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="../../Assets/Backend/images/<?php echo $row['img'];?>" data-gall="myGallery">
                                    <img src="../../Assets/Backend/images/<?php echo $row['img'];?>" alt="product image">
                                </a>
                            </div>

                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2><?php echo $row['name']; ?></h2>
                            <div class="product-desc">
                                <ul>
                                    <li>Năm sinh: <?php echo $row['dob']; ?></li>
                                    <li>Trình độ: <?php echo $row['level']; ?></li>
                                    <li>Chức vụ: <?php echo $row['position'] ?></li>
                                </ul>
                            </div>
                            <div class="rating-box pt-20" style="background: black">
                                <ul class="rating rating-with-review-item">
                                    <li><i class="fa fa-star fa-2x" data-index="0"></i></li>
                                    <li><i class="fa fa-star fa-2x" data-index="1"></i></li>
                                    <li><i class="fa fa-star fa-2x" data-index="2"></i></li>
                                    <li><i class="fa fa-star fa-2x" data-index="3"></i></li>
                                    <li><i class="fa fa-star fa-2x" data-index="4"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="footer">
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-50 pb-35">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-5 col-md-6">
                            <div class="footer-logo">
                                <img src="../../Assets/Frontend/images/menu/logo/1.jpg" alt="Footer Logo">
                                <p class="info">
                                    Đến với cửa hàng của chúng tôi bạn sẽ có được những sản phẩm tuyệt vời.
                                </p>
                            </div>
                            <ul class="des">
                                <li>
                                    <span>Địa chỉ: </span>
                                    số x,ngõ y,đường z,phố k,quận m,thành phố l
                                </li>
                                <li>
                                    <span>Điện thoại liên hệ: </span>
                                    091234567
                                </li>
                                <li>
                                    <span>Email: </span>
                                    abc@gmail.com</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Cửa hàng Limupa</h3>
                                <ul>
                                    <li><a href="#">Trang chủ</a></li>
                                    <li><a href="#">Sản phẩm</a></li>
                                    <li><a href="#">Tin tức</a></li>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-4">
                            <div class="footer-block">
                                <h3 class="footer-block-title">Theo dõi chúng tôi</h3>
                                <ul class="social-link">
                                    <li class="twitter">
                                        <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="rss">
                                        <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                            <i class="fa fa-rss"></i>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google +">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End Here -->
</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src="../../Assets/Frontend/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper js -->
<script src="../../Assets/Frontend/js/vendor/popper.min.js"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="../../Assets/Frontend/js/bootstrap.min.js"></script>
<!-- Ajax Mail js -->
<script src="../../Assets/Frontend/js/ajax-mail.js"></script>
<!-- Meanmenu js -->
<script src="../../Assets/Frontend/js/jquery.meanmenu.min.js"></script>
<!-- Wow.min js -->
<script src="../../Assets/Frontend/js/wow.min.js"></script>
<!-- Slick Carousel js -->
<script src="../../Assets/Frontend/js/slick.min.js"></script>
<!-- Owl Carousel-2 js -->
<script src="../../Assets/Frontend/js/owl.carousel.min.js"></script>
<!-- Magnific popup js -->
<script src="../../Assets/Frontend/js/jquery.magnific-popup.min.js"></script>
<!-- Isotope js -->
<script src="../../Assets/Frontend/js/isotope.pkgd.min.js"></script>
<!-- Imagesloaded js -->
<script src="../../Assets/Frontend/js/imagesloaded.pkgd.min.js"></script>
<!-- Mixitup js -->
<script src="../../Assets/Frontend/js/jquery.mixitup.min.js"></script>
<!-- Countdown -->
<script src="../../Assets/Frontend/js/jquery.countdown.min.js"></script>
<!-- Counterup -->
<script src="../../Assets/Frontend/js/jquery.counterup.min.js"></script>
<!-- Waypoints -->
<script src="../../Assets/Frontend/js/waypoints.min.js"></script>
<!-- Barrating -->
<script src="../../Assets/Frontend/js/jquery.barrating.min.js"></script>
<!-- Jquery-ui -->
<script src="../../Assets/Frontend/js/jquery-ui.min.js"></script>
<!-- Venobox -->
<script src="../../Assets/Frontend/js/venobox.min.js"></script>
<!-- Nice Select js -->
<script src="../../Assets/Frontend/js/jquery.nice-select.min.js"></script>
<!-- ScrollUp js -->
<script src="../../Assets/Frontend/js/scrollUp.min.js"></script>
<!-- Main/Activator js -->
<script src="../../Assets/Frontend/js/main.js"></script>
</body>
<script>
    $(document).ready(function (){
        let id = parseInt(<?php echo $row['id']?>);
        console.log(id);
        let rateIndex = -1;
        restartColor();
        $(".fa-star").click(function () {
           rateIndex = parseInt($(this).data('index')) + 1;
           console.log(rateIndex);
            $.ajax({
                url: "http://localhost/staffmanagement/util/ratingUtil.php",
                method: "POST",
                data: {id:id,star:rateIndex},

                success: function (data) {
                    console.log(data);
                },
                error: function (request, error) {

                    console.log(" Can't do because: " + error);
                },
            });
        });
        $(".fa-star").mouseover(function () {
           restartColor();
           let currentIndex = parseInt($(this).data('index'));
           for (let i = 0; i <= currentIndex; i++) {
               $('.fa-star:eq('+i+')').css('color','yellow');
           }
        });
        $(".fa-star").mouseleave(function () {
           restartColor();
           if (rateIndex != -1) {
               for (let i = 0; i <= rateIndex; i++) {
                   $('.fa-star:eq('+i+')').css('color','yellow');
               }
               rateIndex = -1;
           }
        });

    });
    function restartColor() {
        $(".fa-star").css('color','white');
    }
</script>
<!-- index30:23-->
</html>