<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Services</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Services List
            <a href="<?= site_url('admin/services/create') ?>" class="btn btn-primary btn-sm float-end">Add New Service</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> Sl No. </th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Parent Service</th>
                        <th>Image</th>
                        <th>Variants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $index => $service): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($service['name']) ?></td>
                            <td><?= esc($service['title']) ?></td>
                            <td><?= $service['parent_name'] ?? '<em>None</em>' ?></td>
                            <td>
                                <?php if ($service['img']): ?>
                                    <img src="<?= base_url(' uploads/services/' . $service['img']) ?>"
                                        height="50"
                                        alt="<?= esc($service['name']) ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?= site_url('admin/variants') ?>" method="get" class="mb-4">
                                    <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                    <button type="submit" class="btn btn-primary" style="padding: 0 8px;">
                                        <i class="bi bi-link-45deg"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/services/edit/' . $service['id']) ?>"
                                    class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                                <button onclick="deleteService(<?= $service['id'] ?>)"
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
    function deleteService(id) {
        if (confirm('Are you sure you want to delete this service?')) {
            window.location.href = `<?= site_url('admin/services/delete/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>
