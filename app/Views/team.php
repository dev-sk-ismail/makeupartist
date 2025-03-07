<?= $this->extend('layout') ?>

<?= $this->section('content') ?>



<!-- Team -->
<section class="team section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Makeup Artist</h6>
                <h1 class="wow" data-splitting>Our Team</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="item">
                    <div class="img"> <img src="images/team/01.jpg" alt="" class="w-100"> </div>
                    <div class="con">
                        <h5 class="mb-0"><a href="team-single.html">Enrico Smith<br><span>Makeup Artist</span></a></h5>
                        <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item">
                    <div class="img"> <img src="images/team/02.jpg" alt="" class="w-100"> </div>
                    <div class="con">
                        <h5 class="mb-0"><a href="team-single.html">Jesica Martin<br><span>Makeup Artist</span></a></h5>
                        <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item">
                    <div class="img"><img src="images/team/03.jpg" alt=""></div>
                    <div class="con">
                        <h5 class="mb-0"><a href="team-single.html">Olivia Brown<br><span>Makeup Artist</span></a></h5>
                        <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
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