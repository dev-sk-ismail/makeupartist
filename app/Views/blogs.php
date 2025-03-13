<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<!-- Blog -->
<section class="blog section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12">
                <h6>Recent Articles</h6>
                <h1 class="wow" data-splitting>Latest News</h1>
            </div>
        </div>
        <!-- blog content -->


        <div class="content">
            <div class="row gx-5">
                <?php foreach ($blogs as $blog) { ?>

                    <div class="col-md-6">
                        <div class="item">
                            <div class="img">
                                <a href="<?= base_url('/blog/') . $blog['slug'] ?>"> <img src="<?= base_url('/') ?>uploads/blogs/<?= $blog['image'] ?>" class="rounded-1" alt=""> </a>
                                <div class="date">
                                    <a href="<?= base_url('/blog/') . $blog['slug'] ?>"> <span>Apr</span> <i>14</i> </a>
                                </div>
                            </div>
                            <div class="wrap">
                                <h4><a href="<?= base_url('/blog/') . $blog['slug'] ?>"><?= $blog['title'] ?></a></h4>
                                <p class="item-txt"><?= excerpt($blog['description'], 400); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- pagination -->
                <div class="col-md-12 d-flex justify-content-center">
                    <?php if (isset($pager)): ?>
                        <div class="pagination pagination-wrap mb-30 mt-30">
                            <?= $pager->links('blogs', 'custom_pagination') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Display pagination links -->

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
                        <div class="btn-link"> <a href="mailto:<?= esc($settings['contact_email']); ?>"><?= esc($settings['contact_email']); ?></a> <span class="btn-block animation-bounce"></span> </div>
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