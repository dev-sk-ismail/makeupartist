<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">
        <?= isset($syllabusItem) ? 'Edit Syllabus Item' : 'Add Syllabus Item' ?>
        for <?= esc($course['name']) ?>
    </h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= site_url('admin/courses/syllabus/' . $course['id']) ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Syllabus
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= isset($syllabusItem) ?
                                site_url('admin/courses/syllabus/update/' . $syllabusItem['id']) :
                                site_url('admin/courses/syllabus/store') ?>"
                method="POST">

                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

                <div class="mb-3">
                    <label for="item" class="form-label">Item</label>
                    <input type="text"
                        class="form-control"
                        id="item"
                        name="item"
                        value="<?= old('item', isset($syllabusItem) ? $syllabusItem['item'] : '') ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control"
                        id="description"
                        name="description"
                        rows="4"><?= old('description', isset($syllabusItem) ? $syllabusItem['description'] : '') ?></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox"
                        class="form-check-input"
                        id="is_published"
                        name="is_published"
                        value="1"
                        <?= old('is_published', isset($syllabusItem) && !$syllabusItem['is_published'] ? '' : 'checked') ?>>
                    <label class="form-check-label" for="is_published">Published</label>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/courses/syllabus/' . $course['id']) ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>