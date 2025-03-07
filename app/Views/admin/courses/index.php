<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Courses</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Courses List
            <a href="<?= site_url('admin/courses/create') ?>" class="btn btn-primary btn-sm float-end">Add New Course</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Fee</th>
                        <th>Batch</th>
                        <th>Image</th>
                        <th>Syllabus</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $index => $course): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($course['name']) ?></td>
                            <td><?= esc($course['title']) ?></td>
                            <td><?= esc($course['duration']) ?> days</td>
                            <td>
                                <?php if (!empty($course['discount_value'])): ?>
                                    <span class="text-decoration-line-through"><?= number_format($course['fee'], 0) ?></span>
                                    <span class="text-success fw-bold"><?= $course['discounted_price'] ?></span>
                                <?php else: ?>
                                    <?= number_format($course['fee'], 2) ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($course['start_time']) && isset($course['end_time'])): ?>
                                    <?= date('g:i A', strtotime($course['start_time'])) ?> -
                                    <?= date('g:i A', strtotime($course['end_time'])) ?>
                                <?php else: ?>
                                    <em>Not set</em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($course['image']): ?>
                                    <img src="<?= base_url('uploads/courses/' . $course['image']) ?>"
                                        height="50"
                                        alt="<?= esc($course['name']) ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/courses/syllabus/' . $course['id']) ?>"
                                    class="btn btn-info btn-sm" style="padding: 0 8px;">
                                    <i class="bi bi-list-check"></i> Syllabus
                                </a>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/courses/edit/' . $course['id']) ?>"
                                    class="btn btn-sm btn-primary" style="padding: 0 8px;">Edit</a>
                                <button onclick="deleteCourse(<?= $course['id'] ?>)"
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
    function deleteCourse(id) {
        if (confirm('Are you sure you want to delete this course?')) {
            window.location.href = `<?= site_url('admin/courses/delete/') ?>${id}`;
        }
    }
</script>
<?= $this->endSection() ?>