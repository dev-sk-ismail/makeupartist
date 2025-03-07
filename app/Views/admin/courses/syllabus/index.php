<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Course Syllabus: <?= esc($course['name']) ?></h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="mb-3">
        <a href="<?= site_url('admin/courses') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Courses
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list-check me-1"></i>
            Syllabus Items
            <a href="<?= site_url('admin/courses/syllabus/create/' . $course['id']) ?>" class="btn btn-primary btn-sm float-end">
                Add Syllabus Item
            </a>
        </div>
        <div class="card-body">
            <?php if (empty($syllabus)): ?>
                <div class="alert alert-info">No syllabus items added yet.</div>
            <?php else: ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($syllabus as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($item['item']) ?></td>
                                <td><?= esc($item['description']) ?></td>
                                <td>
                                    <span class="badge <?= $item['is_published'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $item['is_published'] ? 'Published' : 'Draft' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/courses/syllabus/edit/' . $item['id']) ?>" 
                                       class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                                    <button onclick="deleteSyllabusItem(<?= $item['id'] ?>)" 
                                            class="btn btn-sm btn-danger" style="padding: 0 8px;">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function deleteSyllabusItem(id) {
        if (confirm('Are you sure you want to delete this syllabus item?')) {
            window.location.href = `<?= site_url('admin/courses/syllabus/delete/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>