<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($gallery_item) ? 'Edit Gallery Item' : 'New Gallery Item' ?></h1>
    
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
            <form action="<?= isset($gallery_item) ? 
                           site_url('admin/gallery/update/' . $gallery_item['id']) : 
                           site_url('admin/gallery/store') ?>"
                  method="POST"
                  enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" 
                           class="form-control" 
                           id="name" 
                           name="name" 
                           value="<?= old('name', isset($gallery_item) ? $gallery_item['name'] : '') ?>" 
                           required>
                </div>
                
                <div class="mb-3">
                    <label for="service_id" class="form-label">Service</label>
                    <select class="form-control" id="service_id" name="service_id" required>
                        <option value="">Select a Service</option>
                        <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>"
                                <?= old('service_id', isset($gallery_item) ? $gallery_item['service_id'] : '') == $service['id'] ? 'selected' : '' ?>>
                            <?= esc($service['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="image" <?= old('type', isset($gallery_item) ? $gallery_item['type'] : '') == 'image' ? 'selected' : '' ?>>
                            Image
                        </option>
                        <option value="video" <?= old('type', isset($gallery_item) ? $gallery_item['type'] : '') == 'video' ? 'selected' : '' ?>>
                            Video
                        </option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control"
                              id="description"
                              name="description"
                              rows="3"><?= old('description', isset($gallery_item) ? $gallery_item['description'] : '') ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <?php if (isset($gallery_item) && $gallery_item['file_path']): ?>
                    <div class="mb-2">
                        <?php if ($gallery_item['type'] == 'image'): ?>
                        <img src="<?= base_url('uploads/gallery/' . $gallery_item['file_path']) ?>"
                             height="100"
                             alt="Current image">
                        <?php else: ?>
                        <div>Current video: <?= esc($gallery_item['file_path']) ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="file" name="file" <?= isset($gallery_item) ? '' : 'required' ?>>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="display_order" class="form-label">Display Order</label>
                        <input type="number"
                               class="form-control"
                               id="display_order"
                               name="display_order"
                               value="<?= old('display_order', isset($gallery_item) ? $gallery_item['display_order'] : '0') ?>">
                    </div>
                    
                    <div class="col-md-8 mb-3">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   <?= old('is_active', isset($gallery_item) ? $gallery_item['is_active'] : '1') == '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                        
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_published" 
                                   name="is_published" 
                                   value="1"
                                   <?= old('is_published', isset($gallery_item) ? $gallery_item['is_published'] : '1') == '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_published">Published</label>
                        </div>
                        
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1"
                                   <?= old('is_featured', isset($gallery_item) ? $gallery_item['is_featured'] : '0') == '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_featured">Featured</label>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/gallery') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>