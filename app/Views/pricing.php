<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Price -->
<section class="price section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Our Pricing</h6>
                <h1 class="wow" data-splitting>Pricing Plan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-30 wow fadeInUp" data-wow-delay=".2s">
                <div class="item card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Product: MAC Cosmetics</h5>
                        <div class="content d-flex align-items-center">
                            <div class="feat">
                                <ul class="rest">
                                    <li><i class="fa-regular fa-check"></i> <span>Eye and Eyelash Makeup</span></li>
                                    <li><i class="fa-regular fa-check"></i> <span>Hair Makeup</span></li>
                                    <li><i class="fa-regular fa-check"></i> <span>Children Face Makeup</span></li>
                                    <li><i class="fa-regular fa-check"></i> <span>Effect Makeup</span></li>
                                    <li><i class="fa-regular fa-check"></i> <span>Face Makeup</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pricing d-flex justify-content-between align-items-center">
                            <div class="discount">
                                <h4 class="text-danger">20% Off</h4>
                                <small class="text-muted">M.R.P. $1000</small>
                            </div>
                            <div class="final-price">
                                <h3>$800</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 mb-30 wow fadeInUp" data-wow-delay=".4s">
                <div class="item">
                    <h6 class="type">Wedding</h6>
                    <div class="content d-flex align-items-center">
                        <div class="mr-40">
                            <h2>$170</h2>
                        </div>
                        <div class="feat">
                            <ul class="rest">
                                <li><i class="fa-regular fa-check"></i> <span>Curly Haircute & Colors</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Color corrections</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Hair Wash</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Blow Dry Hair</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Foilyage</span></li>
                            </ul>
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
                                    <div class="author-img"> <img src="images/team/02.jpg" alt=""> </div>
                                    <div class="cont">
                                        <h6>Emily Brown</h6> <span>Customer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <p>Dan entesque magna magna semper daibus elisan the aliuen risus morbi tristique senectus et netus malesuan fames ac urpis miss muris in the sero dictum aselusion lacus suscipit congue the volutpat.</p> <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img"> <img src="images/team/03.jpg" alt=""> </div>
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