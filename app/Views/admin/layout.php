<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Panel | Makeup Artist Hena </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('/') ?>images/mah_logo.png" rel="icon">
    <link href="<?= base_url('/admin/') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('/admin/') ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('/admin/') ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdtimepicker/mdtimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>





    <!-- Template Main CSS File -->
    <link href="<?= base_url('/admin/') ?>assets/css/style.css?v0.0" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard" class="logo d-flex align-items-center">
                <img src="<?= base_url('/') ?>images/mah_logo.png" alt="">
                <span class="d-none d-lg-block">Hena</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="">
                <input type="text" name="query" placeholder="Search" disabled title="Enter search keyword">
                <button type="button" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="<?= base_url(); ?>" aria-label="View Frontend" target="_blank">
                        <i class="bi bi-eye"></i>
                    </a><!-- End Preview Icon -->
                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number"><?= $unreadCount ?></span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have <?= $unreadCount ?> new messages
                            <a href="<?= base_url('/admin/') ?>messages"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <?php foreach ($unreadMessages as $message) { ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="message-item">
                                <a href="<?= site_url('admin/messages/view/' . $message['id']) ?>">
                                    <img src="<?= base_url('/admin/') ?>assets/img/profile-img.jpg" alt="" class="rounded-circle">
                                    <div>
                                        <h4><?= ucwords($message['name']) ?></h4>
                                        <p><?= excerpt($message['msg'], 70); ?></p>
                                        <p><?= $message['created_at'] ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php }; ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="<?= base_url('/admin/') ?>messages">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('/admin/') ?>assets/img/admin.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= ucwords(strtolower(session('fullname'))); ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= ucwords(strtolower(session('fullname'))); ?></h6>
                            <span><?= session('role'); ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center btn disabled" href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center btn disabled" href="#">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header>

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?= $segment2 == 'dashboard' ? 'active' : '' ?> " href="<?= base_url('/admin/') ?>dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link <?= $segment2 == 'settings' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>settings">
                    <i class="bi bi-grid"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $segment2 == 'gallery' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>gallery">
                    <i class="bi bi-grid"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $segment2 == 'bookings' || $segment2 == 'services' || $segment2 == 'variants' ? 'active' : 'collapsed' ?>"
                    data-bs-target="#services-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Services & Bookings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="services-nav" class="nav-content collapse <?= $segment2 == 'bookings' || $segment2 == 'services' || $segment2 == 'variants' ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'services' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>services">
                            <i class="bi bi-grid"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'variants' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>variants">
                            <i class="bi bi-grid"></i>
                            <span>Variants</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'bookings' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>bookings">
                            <i class="bi bi-grid"></i>
                            <span>bookings</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $segment2 == 'blogs' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>blogs">
                    <i class="bi bi-grid"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $segment2 == 'courses' ? 'active' : 'collapsed' ?>"
                    data-bs-target="#courses-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Courses and Resources</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="courses-nav" class="nav-content collapse <?= $segment2 == 'courses' ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'courses' && !$segment3 ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>courses">
                            <i class="bi bi-grid"></i>
                            <span>Courses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment3 == 'batches' ? 'active' : '' ?>" href="<?= base_url('/admin/courses/') ?>batches">
                            <i class="bi bi-grid"></i>
                            <span>Batches</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $segment2 == 'categories' || $segment2 == 'products' ? 'active' : 'collapsed' ?>"
                    data-bs-target="#shop-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Shop</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="shop-nav" class="nav-content collapse <?= $segment2 == 'categories' || $segment2 == 'products' ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'categories' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>categories">
                            <i class="bi bi-grid"></i>
                            <span>Product Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'products' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>products">
                            <i class="bi bi-grid"></i>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $segment2 == 'messages' ? 'active' : '' ?>" href="<?= base_url('/admin/') ?>messages">
                    <i class="bi bi-grid"></i>
                    <span>Conact Messages</span>
                </a>
            </li>


        </ul>

    </aside>
    <main class="main">
        <?php echo $this->renderSection('content'); ?>
    </main>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Tech Team</span></strong>. All Rights Reserved
            </div>
            <div class="credits">

                Designed by <a href="https://techt-e-a-m.com/">Tech Team</a>
            </div>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('/admin/') ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/quill/quill.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('/admin/') ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('/admin/') ?>assets/js/main.js"></script>

    <!-- Page Specific Scripts -->
    <?= $this->renderSection('scripts') ?: '' ?>

</body>

</html>