<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Bookings</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-calendar me-1"></i>
            Bookings List
            <a href="<?= site_url('admin/bookings/create') ?>" class="btn btn-primary btn-sm float-end">Add New Booking</a>
        </div>
        <div class="card-body">
            <table id="bookingsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Variant</th>
                        <th>Client Name</th>
                        <th>Contact</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= esc($booking['id']) ?></td>
                            <td><?= esc($booking['service_name']) ?></td>
                            <td><?= esc($booking['variant_name']) ?></td>
                            <td><?= esc($booking['client_name']) ?></td>
                            <td>
                                <?= esc($booking['client_phn']) ?><br>
                                <?= esc($booking['client_email']) ?>
                            </td>
                            <td>
                                <?= date('d M Y', strtotime($booking['booking_date'])) ?><br>
                                <?= $booking['booking_hr'] ?>
                            </td>
                            <td>
                                <span class="badge bg-<?= getStatusColor($booking['status']) ?>">
                                    <?= ucfirst($booking['status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?= getPaymentStatusColor($booking['payment_status']) ?>">
                                    <?= ucfirst($booking['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= site_url('admin/bookings/edit/' . $booking['id']) ?>">Edit</a></li>
                                        <li><button class="dropdown-item" onclick="deleteBooking(<?= $booking['id'] ?>)">Delete</button></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><button class="dropdown-item" onclick="updateStatus(<?= $booking['id'] ?>, 'confirmed')">Mark Confirmed</button></li>
                                        <li><button class="dropdown-item" onclick="updateStatus(<?= $booking['id'] ?>, 'completed')">Mark Completed</button></li>
                                        <li><button class="dropdown-item" onclick="updateStatus(<?= $booking['id'] ?>, 'cancelled')">Mark Cancelled</button></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><button class="dropdown-item" onclick="updatePaymentStatus(<?= $booking['id'] ?>, 'paid')">Mark Paid</button></li>
                                        <li><button class="dropdown-item" onclick="updatePaymentStatus(<?= $booking['id'] ?>, 'refunded')">Mark Refunded</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="statusForm" action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Update Booking Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="status" id="statusInput">
                    <input type="hidden" name="payment_status" id="paymentStatusInput">
                    <p id="statusConfirmMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#bookingsTable').DataTable({
            order: [[5, 'desc']], // Sort by date column
        });
    });
    
    function deleteBooking(id) {
        if (confirm('Are you sure you want to delete this booking?')) {
            window.location.href = `<?= site_url('admin/bookings/delete/') ?>${id}`;
        }
    }
    
    function updateStatus(id, status) {
        const statusForm = document.getElementById('statusForm');
        const statusInput = document.getElementById('statusInput');
        const statusConfirmMessage = document.getElementById('statusConfirmMessage');
        
        statusForm.action = `<?= site_url('admin/bookings/updateStatus/') ?>${id}`;
        statusInput.value = status;
        statusConfirmMessage.textContent = `Are you sure you want to mark this booking as ${status}?`;
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('statusModal'));
        modal.show();
    }
    
    function updatePaymentStatus(id, paymentStatus) {
        const statusForm = document.getElementById('statusForm');
        const paymentStatusInput = document.getElementById('paymentStatusInput');
        const statusConfirmMessage = document.getElementById('statusConfirmMessage');
        
        statusForm.action = `<?= site_url('admin/bookings/updateStatus/') ?>${id}`;
        paymentStatusInput.value = paymentStatus;
        statusConfirmMessage.textContent = `Are you sure you want to mark this booking's payment as ${paymentStatus}?`;
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('statusModal'));
        modal.show();
    }
</script>
<?= $this->endSection() ?>

<?php
// Helper functions
function getStatusColor($status) {
    switch ($status) {
        case 'pending':
            return 'warning';
        case 'confirmed':
            return 'primary';
        case 'completed':
            return 'success';
        case 'cancelled':
            return 'danger';
        default:
            return 'secondary';
    }
}

function getPaymentStatusColor($status) {
    switch ($status) {
        case 'unpaid':
            return 'warning';
        case 'paid':
            return 'success';
        case 'refunded':
            return 'info';
        default:
            return 'secondary';
    }
}
?>