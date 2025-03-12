<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($category) ? 'Edit Category' : 'Create New Category' ?></h1>
    
    <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Category Form
        </div>
        <div class="card-body">
            <form action="<?= isset($category) ? site_url('admin/categories/update/' . $category['id']) : site_url('admin/categories/store') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?= isset($category) ? esc($category['name']) : old('name') ?>" required>
                </div>
                
                <div class="mb-3">
                    <a href="<?= site_url('admin/categories') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>