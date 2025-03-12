<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Products</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Products List
            <a href="<?= site_url('admin/products/create') ?>" class="btn btn-primary btn-sm float-end">Add New Product</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= esc($product['name']) ?></td>
                            <td>
                                <?php if ($product['image']): ?>
                                    <img src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                        height="50"
                                        alt="<?= esc($product['name']) ?>">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($product['category_name']) ?></td>
                            <td><?= number_format($product['price'], 2) ?></td>
                            <td>
                                <?php if ($product['discount_value']): ?>
                                    <?= $product['discount_value'] ?><?= $product['discount_type'] == '%' ? '%' : ' fixed' ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/products/toggle-active/' . $product['id']) ?>" 
                                   class="badge <?= $product['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $product['is_active'] ? 'Active' : 'Inactive' ?>
                                </a>
                                <a href="<?= site_url('admin/products/toggle-published/' . $product['id']) ?>" 
                                   class="badge <?= $product['is_published'] ? 'bg-success' : 'bg-warning' ?>">
                                    <?= $product['is_published'] ? 'Published' : 'Draft' ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/products/toggle-featured/' . $product['id']) ?>" 
                                   class="badge <?= $product['is_featured'] ? 'bg-primary' : 'bg-secondary' ?>">
                                    <?= $product['is_featured'] ? 'Featured' : 'Regular' ?>
                                </a>
                            </td>
                            <td><?= $product['priority'] ?></td>
                            <td>
                                <a href="<?= site_url('admin/products/edit/' . $product['id']) ?>" 
                                   class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                                <button onclick="deleteProduct(<?= $product['id'] ?>)" 
                                        class="btn btn-sm btn-danger" style="padding: 0 8px;">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = `<?= site_url('admin/products/delete/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>