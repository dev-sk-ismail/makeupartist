<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Variants</h1>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Variants List
            </div>
            <a href="<?= site_url('admin/variants/create') ?>" class="btn btn-primary btn-sm">Add New Variant</a>
        </div>

        <div class="card-body">
            <!-- Search and Filter Form -->
            <form action="<?= site_url('admin/variants') ?>" method="get" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search variants..." value="<?= $search ?? '' ?>">
                    </div>
                    <div class="col-md-4">
                        <select name="service_id" class="form-control">
                            <option value="">All Services</option>
                            <?php foreach ($services as $service): ?>
                            <option value="<?= $service['id'] ?>" 
                                <?= ($serviceId == $service['id']) ? 'selected' : '' ?>>
                                <?= esc($service['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= site_url('admin/variants') ?>" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Variant Name</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Payable Amount</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($variants as $variant): ?>
                    <tr>
                        <td><?= esc($variant['name']) ?></td>
                        <td><?= esc($variant['service_name']) ?></td>
                        <td><?= number_format($variant['price'], 2) ?></td>
                        <td>
                            <?= $variant['discount_type'] === 'flat' ? 
                                '₹'.number_format($variant['discount_value'], 2) : 
                                number_format($variant['discount_value'], 0) . '%' ?>
                        </td>
                        <td>
                            <?php
                            $payableAmount = $variant['discount_type'] === 'flat' 
                                ? $variant['price'] - $variant['discount_value']
                                : $variant['price'] - ($variant['price'] * $variant['discount_value'] / 100);
                            echo number_format($payableAmount, 2);
                            ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $variant['is_active'] ? 'success' : 'danger' ?>">
                                <?= $variant['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?= $variant['is_published'] ? 'success' : 'warning' ?>">
                                <?= $variant['is_published'] ? 'Published' : 'Draft' ?>
                            </span>
                            <?php if ($variant['published_at']): ?>
                            <br>
                            <small><?= date('d M Y', strtotime($variant['published_at'])) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= site_url('admin/variants/edit/' . $variant['id']) ?>" 
                               class="btn btn-sm btn-primary">Edit</a>
                            <a href="<?= site_url('admin/variants/delete/' . $variant['id']) ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                <?= $pager->links('variants', 'bootstrap_pagination') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>