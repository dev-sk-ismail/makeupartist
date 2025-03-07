<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Course Batches</h1>
    
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
            <i class="fas fa-clock me-1"></i>
            Batch Timings
            <a href="<?= site_url('admin/courses/batches/create') ?>" class="btn btn-primary btn-sm float-end">
                Add New Batch
            </a>
        </div>
        <div class="card-body">
            <?php if (empty($batches)): ?>
                <div class="alert alert-info">No batches added yet.</div>
            <?php else: ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($batches as $index => $batch): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= date('g:i A', strtotime($batch['start_time'])) ?></td>
                                <td><?= date('g:i A', strtotime($batch['end_time'])) ?></td>
                                <td>
                                    <?php 
                                        $start = new DateTime($batch['start_time']);
                                        $end = new DateTime($batch['end_time']);
                                        $diff = $start->diff($end);
                                        echo $diff->format('%h hours %i minutes');
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/courses/batches/edit/' . $batch['id']) ?>" 
                                       class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                                    <button onclick="deleteBatch(<?= $batch['id'] ?>)" 
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
    function deleteBatch(id) {
        if (confirm('Are you sure you want to delete this batch? This may affect courses using this batch time.')) {
            window.location.href = `<?= site_url('admin/courses/batches/delete/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>