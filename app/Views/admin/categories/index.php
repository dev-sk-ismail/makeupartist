<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Product Categories</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categories List
            <a href="<?= site_url('admin/categories/create') ?>" class="btn btn-primary btn-sm float-end">Add New Category</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Product Count</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= esc($category['name']) ?></td>
                        <td>
                            <?php 
                            $db = \Config\Database::connect();
                            $productCount = $db->table('products')
                                ->where('category_id', $category['id'])
                                ->countAllResults();
                            echo $productCount;
                            ?>
                        </td>
                        <td><?= date('M d, Y', strtotime($category['created_at'])) ?></td>
                        <td>
                            <a href="<?= site_url('admin/categories/edit/' . $category['id']) ?>" 
                               class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                            <button onclick="deleteCategory(<?= $category['id'] ?>)" 
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
function deleteCategory(id) {
    if (confirm('Are you sure you want to delete this category?')) {
        window.location.href = `<?= site_url('admin/categories/delete/') ?>${id}`;
    }
}
</script>
<?= $this->endSection() ?>