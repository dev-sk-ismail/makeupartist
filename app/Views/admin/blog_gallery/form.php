<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($image) ? 'Edit Image' : 'Add New Image' ?></h1>
    <h5 class="text-muted">For Blog: <?= esc($blog['title']) ?></h5>
    
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= isset($image) ? site_url('admin/blog_gallery/update/' . $image['id']) : site_url('admin/blog_gallery/store') ?>" 
                  method="POST"
                  enctype="multipart/form-data">
                
                <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                
                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <?php if (isset($image) && $image['img_path']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/blogs/' . $image['img_path']) ?>" 
                                 height="150" 
                                 alt="Current image">
                            <p class="text-muted">Current image. Upload a new one to replace it.</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" 
                           class="form-control" 
                           id="img" 
                           name="img"
                           accept="image/*"
                           <?= isset($image) ? '' : 'required' ?>>
                </div>
                
                <div class="mb-3">
                    <label for="alt_text" class="form-label">Alt Text</label>
                    <input type="text" 
                           class="form-control" 
                           id="alt_text" 
                           name="alt_text" 
                           value="<?= old('alt_text', isset($image) ? $image['alt_text'] : '') ?>">
                    <small class="text-muted">Description of the image for accessibility and SEO</small>
                </div>
                
                <div class="mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" 
                           class="form-control" 
                           id="order" 
                           name="order" 
                           value="<?= old('order', isset($image) ? $image['order'] : '0') ?>">
                    <small class="text-muted">Lower numbers appear first</small>
                </div>
                
                <div class="form-check mb-3">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_published" 
                           name="is_published" 
                           value="1"
                           <?= old('is_published', isset($image) && $image['is_published'] ? 'checked' : '') ?>>
                    <label class="form-check-label" for="is_published">Published</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/blog_gallery?blog_id=' . $blog['id']) ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>