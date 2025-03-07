<!-- app/Views/admin/service_discount/index.php -->
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2"><?= esc($title) ?></h1>
            <a href="<?= site_url('admin/service-discounts/new') ?>" 
               class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Discount
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Discount</th>
                                <th>Code</th>
                                <th>Effective Period</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($discounts as $discount): ?>
                                <tr>
                                    <td><?= esc($discount['service_name']) ?></td>
                                    <td><?= esc($discount['discount_name']) ?></td>
                                    <td>
                                        <span class="badge bg-secondary"><?= esc($discount['code']) ?></span>
                                    </td>
                                    <td>
                                        <?= date('M d, Y', strtotime($discount['effective_from'])) ?> - 
                                        <?= $discount['effective_to'] ? date('M d, Y', strtotime($discount['effective_to'])) : 'No End Date' ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= site_url('admin/service-discounts/edit/' . $discount['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>