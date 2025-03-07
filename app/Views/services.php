<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Services -->
<section class="services section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Services That I Provide</h6>
                <h1 class="wow" data-splitting>Our Services</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-15 wow fadeInUp" data-wow-delay=".1s">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/1.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Hair Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-15 wow fadeInUp" data-wow-delay=".2s">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/2.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Eye Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-15 wow fadeInUp" data-wow-delay=".3s">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/3.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Wedding Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-15">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/4.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Effect Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-15">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/5.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Face Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-15">
                <div class="item">
                    <div class="wrap">
                        <div class="img"> <img src="<?= base_url('/') ?>images/services/6.jpg" class="img-fluid rounded-1"> </div>
                        <div class="text">
                            <a href="services-single.html">
                                <h4>Fashion Makeup</h4>
                                <p>Discover</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testiominals -->
<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding" data-overlay-dark="4" data-background="images/slider/1.jpg">
        <div class="container">
            <div class="row">
                <!-- need helps -->
                <div class="col-md-6 mb-30 mt-60">
                    <h6>Need Help?</h6>
                    <h5 class="wow" data-splitting>Do you need help with creative make-up?</h5>
                    <div class="btn-wrap text-left wow fadeInUp" data-wow-delay=".6s">
                        <div class="btn-link"> <a href="#">hi@makeup.com</a> <span class="btn-block animation-bounce"></span> </div>
                    </div>
                </div>
                <!-- testiominals -->
                <div class="col-md-5 offset-md-1">
                    <div class="wrap">
                        <h6>Testiominals</h6>
                        <h5>What Clients Say</h5>
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <p>Dan entesque magna magna semper daibus elisan the aliuen risus morbi tristique senectus et netus malesuan fames ac urpis miss muris in the sero dictum aselusion lacus suscipit congue the volutpat.</p> <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img"> <img src="<?= base_url('/') ?>images/team/02.jpg" alt=""> </div>
                                    <div class="cont">
                                        <h6>Emily Brown</h6> <span>Customer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <p>Dan entesque magna magna semper daibus elisan the aliuen risus morbi tristique senectus et netus malesuan fames ac urpis miss muris in the sero dictum aselusion lacus suscipit congue the volutpat.</p> <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img"> <img src="<?= base_url('/') ?>images/team/03.jpg" alt=""> </div>
                                    <div class="cont">
                                        <h6>Jason White</h6> <span>Customer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

