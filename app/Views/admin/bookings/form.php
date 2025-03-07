<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($booking) ? 'Edit Booking' : 'New Booking' ?></h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= isset($booking) ? site_url('admin/bookings/update/' . $booking['id']) : site_url('admin/bookings/store') ?>"
                method="POST">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="service_id" class="form-label">Service</label>
                        <select class="form-control" id="service_id" name="service_id" required onchange="loadVariants()">
                            <option value="">Select a Service</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= $service['id'] ?>"
                                    <?= old('service_id', isset($booking) ? $booking['service_id'] : '') == $service['id'] ? 'selected' : '' ?>>
                                    <?= esc($service['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="variant_id" class="form-label">Service Variant</label>
                        <select class="form-control" id="variant_id" name="variant_id" required>
                            <option value="0">Select a Variant</option>
                            <option value="111">Select a Variant</option>
                            <?php foreach ($variants ?? [] as $variant): ?>
                                <option value="<?= $variant['id'] ?>"
                                    <?= old('variant_id', isset($booking) ? $booking['variant_id'] : '') == $variant['id'] ? 'selected' : '' ?>>
                                    <?= esc($variant['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text"
                            class="form-control"
                            id="client_name"
                            name="client_name"
                            value="<?= old('client_name', isset($booking) ? $booking['client_name'] : '') ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="client_phn" class="form-label">Phone Number</label>
                        <input type="text"
                            class="form-control"
                            id="client_phn"
                            name="client_phn"
                            value="<?= old('client_phn', isset($booking) ? $booking['client_phn'] : '') ?>"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="client_email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control"
                            id="client_email"
                            name="client_email"
                            value="<?= old('client_email', isset($booking) ? $booking['client_email'] : '') ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input type="date"
                            class="form-control"
                            id="booking_date"
                            name="booking_date"
                            value="<?= old('booking_date', isset($booking) ? $booking['booking_date'] : date('Y-m-d')) ?>"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="booking_hr" class="form-label">Booking Time</label>
                        <input type="time" class="form-control"
                            id="booking_hr"
                            name="booking_hr"
                            value="<?= old('booking_hr', isset($booking) ? $booking['booking_hr'] : '') ?>"
                            min="09" max="20" step="1800"
                            required
                            onchange="timeChecker()">
                    </div>

                    <?php if (isset($booking)): ?>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option value="unpaid" <?= $booking['payment_status'] == 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                <option value="paid" <?= $booking['payment_status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                                <option value="refunded" <?= $booking['payment_status'] == 'refunded' ? 'selected' : '' ?>>Refunded</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control"
                        id="remarks"
                        name="remarks"
                        rows="3"><?= old('remarks', isset($booking) ? $booking['remarks'] : '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/bookings') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function loadVariants() {
        const serviceId = document.getElementById('service_id').value;
        const variantSelect = document.getElementById('variant_id');

        // Clear existing options
        variantSelect.innerHTML = '<option value="">Select a Variant</option>';

        if (!serviceId) return;

        // Fetch variants via AJAX
        fetch(`<?= site_url('admin/bookings/getVariants') ?>?service_id=${serviceId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (Array.isArray(data)) {
                    console.log(data);
                    data.forEach(variant => {
                        const option = document.createElement('option');
                        option.value = variant.id;
                        option.textContent = `${variant.name} - ₹${variant.payable_amount}`;
                        console.log(option);
                        variantSelect.appendChild(option);
                    });
                } else {
                    console.error('Error: Expected an array but got', data);
                }
            })
            .catch(error => console.error('Error fetching variants:', error));
    }

    // Load variants on page load if service is selected (for edit page)
    document.addEventListener('DOMContentLoaded', function() {
        const serviceId = document.getElementById('service_id').value;
        if (serviceId) {
            // If editing an existing booking, don't reload variants as they're already populated
            <?php if (!isset($booking)): ?>
                loadVariants();
            <?php endif; ?>
        }
    });


    document.querySelector('form').addEventListener('submit', function(event) {
    if (!timeChecker()) {
        event.preventDefault(); // Prevent form submission if validation fails
    }});

    function timeChecker() {
        const timeInput = document.getElementById('booking_hr');
        timeInput? console.log('inpur element exists'):console.log('not found');
        const time = timeInput.value;
        console.log(time);

        if (time < timeInput.min || time > timeInput.max) {
            alert('Please select a time between 09:00 and 20:00.');
            event.preventDefault();
            return false;
        }
    }
</script>
<?= $this->endSection() ?>