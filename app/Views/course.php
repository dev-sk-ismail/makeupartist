<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<!-- Course Page -->
<section class="course section-padding">
    <div class="container">
        <div class="row">
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
                        Our Beautician Course is designed to provide you with comprehensive training in beauty and skincare.
                        Learn the latest techniques in makeup, facials, hair styling, and more. Whether you're a beginner
                        or looking to enhance your skills, this course will help you achieve your goals.
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
                        <li>Introduction to Beauty and Skincare</li>
                        <li>Makeup Techniques (Day, Evening, Bridal)</li>
                        <li>Facials and Skin Treatments</li>
                        <li>Hair Styling and Cutting</li>
                        <li>Manicure and Pedicure</li>
                        <li>Waxing and Threading</li>
                        <li>Professional Ethics and Client Management</li>
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

                    <p>3 Months (12 Weeks)</p>
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
                        <li><strong>Days:</strong> Mon, Wed, Fri</li>
                        <li><strong>Timing:</strong> 10:00 AM - 12:00 PM</li>
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

                    <p><strong>Total Fee:</strong> $500.00</p>
                    <p><strong>Discount:</strong> 10% (Final Fee: $450.00)</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding" data-overlay-dark="4" data-background="images/slider/1.jpg">
        <div class="container">
            <div class="row">
                <!-- Need Help -->
                <div class="col-md-6 mb-30 mt-60">
                    <h6>Need Help?</h6>
                    <h5 class="wow" data-splitting>Do you need help with the Beautician Course?</h5>
                    <div class="btn-wrap text-left wow fadeInUp" data-wow-delay=".6s">
                        <div class="btn-link">
                            <a href="#">hi@beauticiancourse.com</a>
                            <span class="btn-block animation-bounce"></span>
                        </div>
                    </div>
                </div>
                <!-- Testimonials -->
                <div class="col-md-5 offset-md-1">
                    <div class="wrap">
                        <h6>Testimonials</h6>
                        <h5>What Students Say</h5>
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <p>"This course changed my life! I now run my own beauty salon."</p>
                                <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img">
                                        <img src="<?= base_url('/') ?>images/team/02.jpg" alt="">
                                    </div>
                                    <div class="cont">
                                        <h6>Jane Doe</h6>
                                        <span>Student</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <p>"The instructors are amazing, and the syllabus is very comprehensive."</p>
                                <span class="quote"><i class="fa-sharp fa-solid fa-quote-right"></i></span>
                                <div class="info">
                                    <div class="author-img">
                                        <img src="<?= base_url('/') ?>images/team/03.jpg" alt="">
                                    </div>
                                    <div class="cont">
                                        <h6>John Smith</h6>
                                        <span>Student</span>
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