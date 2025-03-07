<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Gallery</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-image me-1"></i>
            Gallery Items
            <a href="<?= site_url('admin/gallery/create') ?>" class="btn btn-primary btn-sm float-end">Add New Item</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Service</th>
                        <th>Type</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gallery as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc($item['service_name']) ?></td>
                        <td><?= ucfirst(esc($item['type'])) ?></td>
                        <td>
                            <?php if ($item['type'] == 'image'): ?>
                                <img src="<?= base_url('uploads/gallery/' . $item['file_path']) ?>" 
                                     height="50" alt="<?= esc($item['name']) ?>">
                            <?php else: ?>
                                <i class="fas fa-video"></i> Video
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                                <?= $item['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                            <span class="badge bg-<?= $item['is_published'] ? 'info' : 'secondary' ?>">
                                <?= $item['is_published'] ? 'Published' : 'Draft' ?>
                            </span>
                            <?php if ($item['is_featured']): ?>
                            <span class="badge bg-warning">Featured</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $item['display_order'] ?? 'Not set' ?></td>
                        <td>
                            <a href="<?= site_url('admin/gallery/edit/' . $item['id']) ?>" 
                               class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                            <button onclick="deleteGalleryItem(<?= $item['id'] ?>)" 
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
function deleteGalleryItem(id) {
    if (confirm('Are you sure you want to delete this gallery item? This will also delete the associated file.')) {
        window.location.href = `<?= site_url('admin/gallery/delete/') ?>${id}`;
    }
}
</script>
<?= $this->endSection() ?>