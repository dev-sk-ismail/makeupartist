<?= $this->extend('layout') ?>

<?= $this->section('content') ?>



<!-- Contact Box -->
<div class="contact-box section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>Get in touch</h6>
                <h1 class="wow" data-splitting>Contact Us</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                <div class="item">
                    <span class="icon fa-light fa-envelope"></span>
                    <h5>Email us</h5>
                    <p><?= isset($settings) ? $settings['contact_email'] : 'hello@makeupartisthena.com'  ?></p>
                    <span class="numb fa-light fa-envelope"></span>
                </div> 
            </div> 
            <div class="col-md-4 wow fadeInUp" data-wow-delay=".4s">
                <div class="item"> <span class="icon fa-light fa-location-dot"></span>
                    <h5>Our address</h5>
                    <p><?= isset($settings) ? $settings['bsns_adress'] : 'AU-206,AUTUMN,SIDDHA TOWN,BERABERI,RAJARHAT,KOLKATA-700136'  ?></p>
                    <span class="numb fa-light fa-location-dot"></span>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay=".6s">
                <div class="item active"> <span class="icon fa-light fa-phone"></span> 
                    <h5>Call us</h5>
                    <p><?= isset($settings) ? $settings['bsns_phone'] : '7478987797'  ?></p>
                    <span class="numb fa-light fa-phone"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- divider line -->
<div class="line-vr-section"></div>
<!-- Contact  -->
<section class="contact section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h5>Get in touch!</h5>
                <form method="post" class="contact__form" action="mail.php">
                    <!-- Form message -->
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                        </div>
                    </div>
                    <!-- Form elements -->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input name="name" type="text" placeholder="Name *" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="email" type="email" placeholder="Email Address *" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="phone" type="text" placeholder="Phone *" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input name="subject" type="text" placeholder="Subject *" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="message" id="message" cols="30" rows="4" placeholder="How can we help you? Feel free to get in touch! *" required></textarea>
                        </div>
                        <div class="col-md-12 mt-15">
                            <div class="btn-wrap">
                                <div class="btn-link">
                                    <input type="submit" value="Get in touch"> <span class="btn-block animation-bounce"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Maps -->
<section id="map">
    <div class="full-width">
        <div class="google-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1573147.7480448114!2d-74.84628175962355!3d41.04009641088412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25856139b3d33%3A0xb2739f33610a08ee!2s1616%20Broadway%2C%20New%20York%2C%20NY%2010019%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1646760525018!5m2!1str!2str" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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