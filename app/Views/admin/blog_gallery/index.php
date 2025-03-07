<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Blog Gallery: <?= esc($blog['title']) ?></h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-images me-1"></i>
            Gallery Images
            <div class="float-end">
                <a href="<?= site_url('admin/blog_gallery/create?blog_id=' . $blog['id']) ?>" class="btn btn-primary btn-sm">Add New Image</a>
                <a href="<?= site_url('admin/blogs') ?>" class="btn btn-secondary btn-sm">Back to Blogs</a>
            </div>
        </div>
        <div class="card-body">
            <?php if (empty($gallery)): ?>
                <div class="alert alert-info">No images found for this blog. Add your first image using the "Add New Image" button.</div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($gallery as $image): ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                <img src="<?= base_url('uploads/blogs/' . $image['img_path']) ?>" 
                                     class="card-img-top" 
                                     alt="<?= esc($image['alt_text'] ?: 'Blog image') ?>"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">Order: <?= $image['order'] ?></h5>
                                    <p class="card-text"><?= esc($image['alt_text'] ?: 'No alt text') ?></p>
                                    <span class="badge <?= $image['is_published'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $image['is_published'] ? 'Published' : 'Not Published' ?>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="<?= site_url('admin/blog_gallery/edit/' . $image['id']) ?>" 
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <button onclick="deleteImage(<?= $image['id'] ?>)" 
                                            class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function deleteImage(id) {
    if (confirm('Are you sure you want to delete this image?')) {
        window.location.href = `<?= site_url('admin/blog_gallery/delete/') ?>${id}`;
    }
}
</script>
<?= $this->endSection() ?>