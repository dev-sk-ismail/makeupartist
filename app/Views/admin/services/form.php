<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($service) ? 'Edit Service' : 'New Service' ?></h1>

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
            <form action="<?= isset($service) ? site_url('admin/services/update/' . $service['id']) : site_url('admin/services/store') ?>"
                  method="POST"
                  enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" 
                           class="form-control" 
                           id="name" 
                           name="name" 
                           value="<?= old('name', isset($service) ? $service['name'] : '') ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" 
                           class="form-control" 
                           id="title" 
                           name="title" 
                           value="<?= old('title', isset($service) ? $service['title'] : '') ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Service</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">None (Main Service)</option>
                        <?php foreach ($mainServices as $main): ?>
                            <?php if (!isset($service) || $main['id'] != $service['id']): ?>
                                <option value="<?= $main['id'] ?>" 
                                        <?= old('parent_id', isset($service) ? $service['parent_id'] : '') == $main['id'] ? 'selected' : '' ?>>
                                    <?= esc($main['name']) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" 
                              id="description" 
                              name="description" 
                              rows="4"><?= old('description', isset($service) ? $service['description'] : '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <?php if (isset($service) && $service['img']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/services/' . $service['img']) ?>" 
                                 height="100" 
                                 alt="Current image">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="img" name="img">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/services') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
