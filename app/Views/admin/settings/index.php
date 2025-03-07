<!-- app/Views/admin/settings/index.php -->
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2"><?= esc($title) ?></h1>
        <a href="<?= site_url('admin/settings/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Add New Setting
        </a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($settingsList as $setting): ?>
                            <tr>
                                <td><?= esc($setting['key']) ?></td>
                                <td><?= esc($setting['val']) ?></td>
                                <td><?= $setting['updated_at'] ?></td>
                                <td>
                                    <a href="<?= site_url('admin/settings/edit/' . $setting['id']) ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>