<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Gallery Image -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-25">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Our Portfolio</h6>
                <h1 class="wow" data-splitting>Image Gallery</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="gallery-filter">
                    <li class="active" data-filter="*">All</li>
                    <?php foreach ($services as $service): ?>
                        <li data-filter=".<?= $service['name'] ?>"><?= $service['name'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="row gallery-items">
            <?php foreach ($gallery as $item): ?>
                <div class="col-md-4 gallery-masonry-wrapper single-item <?= $item['service']['name']; ?> mb-30">
                    <a href="images/gallery/1.jpg" title="" class="gallery-masonry-item-img-link img-zoom">
                        <div class="gallery-box">
                            <div class="gallery-img img-grayscale"> <img src="<?= base_url('/uploads/gallery/') . $item['file_path']; ?>" class="img-fluid mx-auto d-block" alt=""> </div>
                            <div class="gallery-masonry-item-img"></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
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