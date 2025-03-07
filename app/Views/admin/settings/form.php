<!-- app/Views/admin/settings/form.php -->
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2"><?= esc($title) ?></h1>
                    <a href="<?= site_url('admin/settings') ?>" 
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-body">
                        <form action="<?= site_url('admin/settings/' . (isset($setting) ? 'update/'.$setting['id'] : 'store')) ?>" 
                              method="post">
                            
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="key" class="form-label">Settings Key</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="key" 
                                       name="key" 
                                       value="<?= isset($setting) ? esc($setting['key']) : old('key') ?>" 
                                       required
                                       <?= isset($setting) ? 'readonly' : '' ?>
                                       placeholder="Enter settings key">
                            </div>
                            
                            <div class="mb-3">
                                <label for="val" class="form-label">Value</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="val" 
                                       name="val" 
                                       value="<?= isset($setting) ? esc($setting['val']) : old('val') ?>" 
                                       required
                                       placeholder="Enter value for the Key">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i><?= isset($setting) ? 'Update' : 'Create' ?> Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>