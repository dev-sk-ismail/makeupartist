<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<!-- Course Page -->
<section class="course-sect section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center mb-30 flex-column">
                <h2 class="title" data-splitting><?= ucwords('become a ' . $course['name']); ?></h2>
                <div class="img-div">
                    <img src="<?= base_url('uploads/courses/' . $course['image']) ?>" alt="">
                </div>
                <p class="mt-15"><?= $course['title']; ?></p>
            </div>
            <!-- Description -->
            <div class="col-md-6 mb-30">
                <div class="course-card">
                    <div class="card-heading ">
                        <div class="icon">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h3>Course Description</h3>
                    </div>

                    <p>
                        <?= $course['description'] ?>
                    </p>
                </div>
            </div>
            <!-- Syllabus -->
            <div class="col-md-6 mb-30">
                <div class="course-card">
                    <div class="card-heading ">
                        <div class="icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <h3>Syllabus</h3>
                    </div>

                    <ul>
                        <?php foreach ($syllabus as $item) { ?>

                            <li><strong><?= $item['item'] ?>: </strong> <?= $item['description'] ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- Duration -->
            <div class="col-md-4 mb-30">
                <div class="course-card">
                    <div class="card-heading ">
                        <div class="icon">
                            <i class="fa-solid fa-calendar-alt"></i>
                        </div>
                        <h3>Duration</h3>
                    </div>

                    <p><?= $course['duration'] ?></p>
                </div>
            </div>
            <!-- Schedule -->
            <div class="col-md-4 mb-30">
                <div class="course-card">
                    <div class="card-heading ">
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h3>Schedule</h3>
                    </div>

                    <ul>
                        <li><strong>Days:</strong> <?= $days; ?></li>
                        <li><strong>Timing:</strong> <?= $batch_time; ?></li>
                    </ul>
                </div>
            </div>
            <!-- Fee -->
            <div class="col-md-4 mb-30">
                <div class="course-card">
                    <div class="card-heading ">
                        <div class="icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <h3>Fee</h3>
                    </div>
                    <div class="pricing d-flex justify-content-between g-5 align-items-center">
                        <div class="discount">
                            <h4 class="discount-value">
                                <?= $course['discount_type'] === 'fixed' ?
                                    'FLAT ₹' . number_format($course['discount_value'], 0) :
                                    number_format($course['discount_value'], 0) . '%' ?> Off
                            </h4>
                            <small class="text-muted d-flex">M.R.P. <span class="strike-through"> ₹<?= htmlspecialchars(isset($course['fee']) ? $course['fee'] : '') ?></span> </small>
                        </div>
                        <div class="final-price">
                            <h4>₹<?= htmlspecialchars(isset($discounted_price) ? $discounted_price : '') ?></h4>
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
                        <div class="btn-link"> <a href="mailto:<?= esc($settings['contact_email']); ?>"><?= esc($settings['contact_email']); ?></a> <span class="btn-block animation-bounce"></span> </div>
                    </div>
                </div>
                <!-- testiominals -->
                <div class="col-md-5 offset-md-1">
                    <div class="wrap">
                        <h6>Testiominals</h6>
                        <h5>What Students Say</h5>
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <p>This course changed my life! I now run my own beauty salon.</p> <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img"> <img src="images/team/02.jpg" alt=""> </div>
                                    <div class="cont">
                                        <h6>Emily Brown</h6> <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <p>The instructors are amazing, and the syllabus is very comprehensive.</p> <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img"> <img src="images/team/03.jpg" alt=""> </div>
                                    <div class="cont">
                                        <h6>Jason White</h6> <span>Student</span>
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