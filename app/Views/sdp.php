<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<?php
//echo '<pre>'; print_r($variants); 

$image = isset($service['img']) ? $service['img'] : '1.jpg';
?>
<style type="text/css">
    .service-name {
        font-size: 35px;
    }
</style>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" onclick="this.style.display='none'"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<!-- Services Page  -->
<section class="services-page">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h1 class="wow service-name" data-splitting><?= htmlspecialchars(isset($service['name']) ? $service['name'] : 'MAKEUP') ?></h1>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-7 mb-60">
                <img src="<?= base_url('uploads/services/' . $image) ?>" class="img-fluid sdp-img" alt="">
            </div>
            <div class="col-md-5 mb-60">
                <div class="row price">
                    <?php foreach ($variants as $row) { ?>
                        <div class="col-md-12 mb-30 wow fadeInUp" data-wow-delay=".2s">
                            <div class="item card">
                                <h5 class="card-title text-center"><?= htmlspecialchars(isset($row['name']) ? $row['name'] : '') ?></h5>
                                <div class="content d-flex align-items-center">
                                    <div class="feat">
                                        <div><?= isset($row['description']) ? ucfirst(htmlspecialchars($row['description'])) : '' ?></div>
                                    </div>
                                </div>
                                <div class="pricing d-flex justify-content-between g-5 align-items-center">


                                    <div class="discount">
                                        <h4 class="text-danger discount-value">
                                            <?= $row['discount_type'] === 'flat' ?
                                                'FLAT ₹' . number_format($row['discount_value'], 0) :
                                                number_format($row['discount_value'], 0) . '%' ?> Off
                                        </h4>
                                        <small class="text-muted">M.R.P. <span class="strike-through">₹<?= htmlspecialchars(isset($row['price']) ? $row['price'] : '') ?></span> </small>
                                    </div>
                                    <div class="final-price">
                                        <h3>₹<?= htmlspecialchars(isset($row['payable_amount']) ? $row['payable_amount'] : '') ?></h3>
                                    </div>
                                    <!-- Add Book This Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal" data-variant-id="<?= $row['id'] ?>">
                                        Book This
                                    </button>
                                </div>
                            </div>

                        </div>
                    <?php } ?>


                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-60"><?= htmlspecialchars(isset($service['description']) ? $service['description'] : '') ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Modal -->
<div class="modal fade right" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" action="<?= base_url('services/apiBooking') ?>" method="POST">
                    <input type="hidden" name="variant_id" id="variant_id">
                    <input type="hidden" name="service_id" id="service_id" value="<?= $service['id'] ?>">
                    <input type="hidden" name="src_url" id="src_url" value="<?= current_url() ?>">
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_phn" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="client_phn" name="client_phn" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="client_email" name="client_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_hr" class="form-label">Booking Time</label>
                        <select class="form-control" id="booking_hr" name="booking_hr" required>
                            <option value="">Select a Time Slot</option>
                            <?php
                            $times = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
                            foreach ($times as $time) :
                            ?>
                                <option value="<?= $time ?>"><?= date('h:i A', strtotime($time)) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Before After -->
<section class="section-padding">
    <div class="container">
        <div class="row mb-45">
            <div class="col-md-12 text-center">
                <h6 class="wow" data-splitting>What We Do</h6>
                <h1 class="wow" data-splitting>Before After</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-30">
                <div class="juxtapose"> <img src="<?= base_url('/') ?>images/beforeafter/b1.jpg" class="img-fluid" data-label="Before" alt="Before Gallery"> <img src="<?= base_url('/') ?>images/beforeafter/a1.jpg" class="img-fluid" data-label="After" alt="After Gallery"> </div>
            </div>
            <div class="col-md-6">
                <div class="juxtapose"> <img src="<?= base_url('/') ?>images/beforeafter/b2.jpg" class="img-fluid" data-label="Before" alt="Before Gallery"> <img src="<?= base_url('/') ?>images/beforeafter/a2.jpg" class="img-fluid" data-label="After" alt="After Gallery"> </div>
            </div>
        </div>
    </div>
</section>
<!-- Next & Prev -->
<section class="nex-prv">
    <div class="container">
        <div class="row">
            <div class="col-md-5 rest">
                <div class="prv">
                    <div class="img bg-img" data-background="images/services/1.jpg">
                        <div class="text-start ontop">
                            <h5><a href="services-single.html">Hair Makeup</a></h5>
                            <h6>Prev</h6>
                        </div>
                        <div class="overly"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center rest">
                <a href="services.html" class="all-works align-items-center"> <i class="icon fa-solid fa-grid"></i> </a>
            </div>
            <div class="col-md-5 rest">
                <div class="nxt">
                    <div class="img bg-img" data-background="images/services/3.jpg">
                        <div class="text-end ontop">
                            <h5><a href="services-single.html">Wedding Makeup</a></h5>
                            <h6>Next</h6>
                        </div>
                        <div class="overly"></div>
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

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingModal = document.getElementById('bookingModal');
        bookingModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const variantId = button.getAttribute('data-variant-id');
            const modalInput = bookingModal.querySelector('#variant_id');
            modalInput.value = variantId;
        });
    });
</script>
<?= $this->endSection() ?>