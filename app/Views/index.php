<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Homepage Default -->
<section class="home-default">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <div class="view-on-mobile">
                        <h6><?=!empty($title)?$title:''?></h6>
                        <h1>Bobbi Noda</h1>
                    </div>
                    <div class="transform-banner position-relative"> <img class="img home-default-img home-default-img-left wow imago" src="images/slider.jpg" alt=""> </div>
                    <div class="home-default-cont home-default-cont-right">
                        <div class="home-default-cont-absolute home-default-cont-absolute-right">
                            <div class="not-view-on-mobile">
                                <h6 class="wow" data-splitting>Makeup Artist</h6>
                                <h1 class="wow" data-splitting>Bobbi Noda</h1>
                            </div>
                            <div class="home-default-cont-text">
                                <p class="wow" data-splitting>Hello, I’am Bobbi Noda! I love people love to fell beautiful, which is the reason I’ve spent last 12 years engulfed in doing Make up.</p>
                            </div>
                            <div class="btn-wrap text-center">
                                <div class="btn-link"> <a href="services.html">Our Services</a> <span class="btn-block animation-bounce"></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- divider line -->
<div class="line-vr-section"></div>
<!-- Services -->
<section class="services section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Services That I Provide</h6>
                <h1 class="wow" data-splitting>Our Services</h1>
            </div>
        </div>
    </div>
    <div class="full-width">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/1.jpg" class="img-fluid rounded-1"> </div>
                            <div class="text">
                                <a href="services-single.html">
                                    <h4>Hair Makeup</h4>
                                    <p>Discover</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/2.jpg" class="img-fluid rounded-1"> </div>
                            <div class="text">
                                <a href="services-single.html">
                                    <h4>Eye Makeup</h4>
                                    <p>Discover</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/3.jpg" class="img-fluid rounded-1"> </div>
                            <div class="text">
                                <a href="services-single.html">
                                    <h4>Wedding Makeup</h4>
                                    <p>Discover</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/4.jpg" class="img-fluid rounded-1"> </div>
                            <div class="text">
                                <a href="services-single.html">
                                    <h4>Effect Makeup</h4>
                                    <p>Discover</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/5.jpg" class="img-fluid rounded-1"> </div>
                            <div class="text">
                                <a href="services-single.html">
                                    <h4>Face Makeup</h4>
                                    <p>Discover</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/services/6.jpg" class="img-fluid rounded-1"> </div>
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
    </div>
</section>
<!-- divider line -->

<div class="line-vr-section"></div>
        
<!-- About --> 
<section class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h6 class="wow" data-splitting>Makeup Artist</h6>
                <h1 class="wow" data-splitting>Bobbi Noda</h1>
                <p class="wow fadeInUp" data-wow-delay=".2s">Nulla posuere tortoran nisan sempere scelerisque etiam ornare iros metusan the ravidane sodales vesaire. Integer ac molestie nisi orci varius natoque penatis magnis the duru parturient montes, nascetur ridiculus mus.</p>
                <p class="wow fadeInUp" data-wow-delay=".3s">Phasellus et lacus suscipit congue nisl the volutpat magna done miss the rana risus tincidunt convallis velit orci congue tortor eu dignissim ipsum suam non odio esuntion miss the imperdiet metus ornare.</p>
                <!-- list -->
                <ul class="list-unstyled list mt-30 mb-30 wow fadeInUp" data-wow-delay=".4s">
                    <li>
                        <div class="list-icon"> <i class="fa-regular fa-check"></i> </div>
                        <div class="list-text">
                            <p>Face Makeup</p>
                        </div>
                    </li>
                    <li>
                        <div class="list-icon"> <i class="fa-regular fa-check"></i> </div>
                        <div class="list-text">
                            <p>Wedding Makeup</p>
                        </div>
                    </li>
                    <li>
                        <div class="list-icon"> <i class="fa-regular fa-check"></i> </div>
                        <div class="list-text">
                            <p>Eyebrow Makeup</p>
                        </div>
                    </li>
                </ul>
                <div class="clients mb-30 wow fadeInUp" data-wow-delay=".5s">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme">
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/1.png" alt=""></a>
                                </div>
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/2.png" alt=""></a>
                                </div>
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/3.png" alt=""></a>
                                </div>
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/4.png" alt=""></a>
                                </div>
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/5.png" alt=""></a>
                                </div>
                                <div class="clients-logo">
                                    <a href="#0"><img src="images/clients/6.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1 wow fadeInUp" data-wow-delay=".6s">
                <div class="profile-img">
                    <div class="img"> <img src="images/about.jpg" alt=""> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- divider line -->
<div class="line-vr-section"></div>
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
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="img"><img src="images/team/01.jpg" alt=""></div>
                        <div class="con">
                            <h5 class="mb-0"><a href="team-single.html">Jessica Brown<br><span>Pro Hair & Makeup Artist</span></a></h5>
                            <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="img"> <img src="images/team/02.jpg" alt="" class="w-100"> </div>
                        <div class="con">
                            <h5 class="mb-0"><a href="team-single.html">Emma Smith<br><span>Senior Pro Hairstylist</span></a></h5>
                            <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="img"> <img src="images/team/03.jpg" alt="" class="w-100"> </div>
                        <div class="con">
                            <h5 class="mb-0"><a href="team-single.html">Daniel Martin<br><span>Senior Makeup Artist</span></a></h5>
                            <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="img"><img src="images/team/04.jpg" alt=""></div>
                        <div class="con">
                            <h5 class="mb-0"><a href="team-single.html">Jessica Brown<br><span>Pro Hair & Makeup Artist</span></a></h5>
                            <div class="arrow"> <a href="team-single.html"><i class="fa-light fa-arrow-up-right"></i></a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- divider line -->
<div class="line-vr-section"></div>
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
                <div class="item">
                    <h6 class="type">General</h6>
                    <div class="content d-flex align-items-center">
                        <div class="mr-40">
                            <h2>$120</h2>
                        </div>
                        <div class="feat">
                            <ul class="rest">
                                <li><i class="fa-regular fa-check"></i> <span>Eye and Eyelash Makeup</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Hair Makeup</span>
                                <li><i class="fa-regular fa-check"></i> <span>Children Face Makeup</span>
                                <li><i class="fa-regular fa-check"></i> <span>Effect Makeup</span></li>
                                <li><i class="fa-regular fa-check"></i> <span>Face Makeup</span></li>
                            </ul>
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
<!-- divider line -->
<div class="line-vr-section"></div>
<!-- Blog Home -->
<section class="blog-home section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Makeup Trends</h6>
                <h1 class="wow" data-splitting>Read Blog</h1>
            </div>
        </div>
    </div>
    <div class="full-width">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/blog/1.jpg" class="img-fluid rounded-1"> </div>
                            <div class="title">
                                <a href="post.html">
                                    <h6>Bridal</h6>
                                    <h4>Wedding Hairstyle Tips</h4> <i class="icon fa-light fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/blog/2.jpg" class="img-fluid rounded-1"> </div>
                            <div class="title">
                                <a href="post.html">
                                    <h6>Hair Makeup</h6>
                                    <h4>Hair Care & Styling Tips</h4> <i class="icon fa-light fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/blog/3.jpg" class="img-fluid rounded-1"> </div>
                            <div class="title">
                                <a href="post.html">
                                    <h6>Makeup</h6>
                                    <h4>Birthday Party Ideas</h4> <i class="icon fa-light fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/blog/4.jpg" class="img-fluid rounded-1"> </div>
                            <div class="title">
                                <a href="post.html">
                                    <h6>Face Makeup</h6>
                                    <h4>Tips for Face Makeup</h4> <i class="icon fa-light fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="wrap">
                            <div class="img"> <img src="images/blog/5.jpg" class="img-fluid rounded-1"> </div>
                            <div class="title">
                                <a href="post.html">
                                    <h6>Makeup</h6>
                                    <h4>Make Up Techniques</h4> <i class="icon fa-light fa-arrow-up-right"></i>
                                </a>
                            </div>
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
                        <div class="btn-link"> <a href="#">makeupartisthena@gmail.com</a> <span class="btn-block animation-bounce"></span> </div>
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

<!-- Footer -->
