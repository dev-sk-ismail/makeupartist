<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Post Page  -->
<section class="blog section-padding post-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-45">
                <div class="category"><a href="blog.html">
                        <div>Blog</div>
                    </a>
                    <div class="divider"></div><span><?= $blog['published_date'] ? date('d M Y', strtotime($blog['published_date'])) : '-' ?></span>
                </div>
                <h2 class="wow" data-splitting><?= $blog['title'] ?></h2>
                <p class="mt-15"><?= $blog['description']?></p>
            </div>
        </div>
        <div class="row mb-45">
            <?php foreach($blogGallery as $item) { ?>
            <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                <img src="<?= base_url('/') ?>uploads/blogs/<?= $item['img_path'] ?>" class="mb-30 img-fluid" alt="">
            </div>
            <?php } ?>
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