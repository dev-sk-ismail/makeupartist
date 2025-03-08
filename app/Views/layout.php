<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Makeup Artist Hena</title>
    <link rel="icon" type="image/png" href="<?= base_url('/') ?>images/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Syne:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="<?= base_url('/') ?>css/plugins.css" />
    <link rel="stylesheet" href="<?= base_url('/') ?>css/style.css?v=0.27">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div class="preloader">
        <div class="item">
            <div class="wrap">
                <div class="circle"></div>
                <div class="line-mask">
                    <div class="line"></div>
                </div> <img src="<?= base_url('/') ?>images/mah_logo.png" alt="">
            </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Cursor -->
    <div class="cursor js-cursor"></div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="<?= base_url('/') ?>"><img src="<?= base_url('/') ?>images/mah_logo.png" class="logo-img" alt=""></a>
                <!-- <a class="logo" href="index"> <h2>NODA</h2> </a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="fa-regular fa-bars"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>about">About</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Services <i class="fa-light fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($services as $service): ?>
                                <li class="dropdown-submenu dropdown">
                                    <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true" href="services"><span><?= htmlspecialchars($service['name']); ?><i class="fa-light fa-angle-right"></i></span></a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($service['subcategories'] as $subService): ?>
                                            <li><a href="<?= base_url('/services/' . esc($subService['slug'])) ?>" class="dropdown-item"><span><?= htmlspecialchars($subService['name']); ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>blogs">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>contact">Contact</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Cources <i class="fa-light fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($courses as $course) { ?>
                                <li><a href="<?= base_url('/courses/' . esc($course['slug'])) ?>" class="dropdown-item"><span><?= ucwords(htmlspecialchars($course['name'])); ?></span></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>shop">Shop</a></li>
                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="fa-light fa-phone"></i> </div>
                        <div class="text">
                            <p>Need Makeup?</p>
                            <h5><a href="tel:<?= isset($settings) ? $settings['bsns_phone'] : '8373872023'  ?>"><?= isset($settings) ? $settings['bsns_phone'] : '8373872023'  ?></a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <main class="main">
        <?php echo $this->renderSection('content'); ?>
    </main>






    <footer class="footer">
        <!-- top -->
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-45">
                        <h5>About Us</h5>
                        <p>Makeup amacus suscipit oremen miss the volutpat magnaz donec miss the drana risus convais nisan.</p>
                        <div class="social">
                            <a href="<?= isset($settings) ? $settings['insta_url'] : '#'  ?>"><i class="fa-brands fa-instagram"></i></a>
                            <a href="<?= isset($settings) ? $settings['fb_url'] : '#'  ?>"><i class="fa-brands fa-facebook"></i></a>
                            <a href="<?= isset($settings) ? $settings['printerest_url'] : '#'  ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-1 mb-45">
                        <div class="worktime">
                            <h5>Work Time</h5>
                            <ul>
                                <li>
                                    <div class="tit">Monday - Friday</div>
                                    <div class="dots"></div> <span>8:00 AM - 7:00 PM</span>
                                </li>
                                <li>
                                    <div class="tit">Saturday</div>
                                    <div class="dots"></div> <span>9:00 AM - 6:00 PM</span>
                                </li>
                                <li>
                                    <div class="tit">Sunday</div>
                                    <div class="dots"></div> <span>Closed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1 mb-45">
                        <h5>Contact</h5>
                        <p><?= isset($settings) ? $settings['bsns_adress'] : 'Tech Team HQ, Dhankal Bazar'  ?></p>
                        <div class="phone"><?= isset($settings) ? $settings['bsns_phone'] : '7478987797'  ?></div>
                        <div class="mail"><?= isset($settings) ? $settings['contact_email'] : 'dev.sk.ismail@gmail.com'  ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bottom -->
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>2025 © All rights reserved. Designed by <a href="https://techteam.com" target="_blank">Tech Team</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="<?= base_url('/') ?>js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('/') ?>js/jquery-migrate-3.4.1.min.js"></script>
    <script src="<?= base_url('/') ?>js/modernizr-2.6.2.min.js"></script>
    <script src="<?= base_url('/') ?>js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('/') ?>js/jquery.isotope.v3.0.2.js"></script>
    <script src="<?= base_url('/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('/') ?>js/scrollIt.min.js"></script>
    <script src="<?= base_url('/') ?>js/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('/') ?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('/') ?>js/jquery.stellar.min.js"></script>
    <script src="<?= base_url('/') ?>js/jquery.magnific-popup.js"></script>
    <script src="<?= base_url('/') ?>js/YouTubePopUp.js"></script>
    <script src="<?= base_url('/') ?>js/before-after.js"></script>
    <script src="<?= base_url('/') ?>js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('/') ?>js/smooth-scroll.min.js"></script>
    <script src="<?= base_url('/') ?>js/wow.js"></script>
    <script src="<?= base_url('/') ?>js/custom.js?v=0.1"></script>
</body>
<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }, {
        'ap': 'cpsh-oh'
    }, {
        'server': 'p3plzcpnl508938'
    }, {
        'dcenter': 'p3'
    }, {
        'cp_id': '10224162'
    }, {
        'cp_cl': '8'
    }) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script src='https://img1.wsimg.com/traffic-assets/<?= base_url('/') ?>js/tccl.min.js'></script>
<!-- Page Specific Scripts -->
<?= $this->renderSection('scripts') ?: '' ?>

</html>