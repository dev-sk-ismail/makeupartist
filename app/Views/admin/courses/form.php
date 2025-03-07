<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($course) ? 'Edit Course' : 'New Course' ?></h1>

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
            <form action="<?= isset($course) ? site_url('admin/courses/update/' . $course['id']) : site_url('admin/courses/store') ?>"
                method="POST"
                enctype="multipart/form-data">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="<?= old('name', isset($course) ? $course['name'] : '') ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="<?= old('title', isset($course) ? $course['title'] : '') ?>"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="quill-editor-default"></div>
                    <input type="hidden" class="form-control quill-hidden-input" name="description" id="description" value="<?= old('description', isset($course) ? $course['description'] : '') ?>">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration (days)</label>
                        <input type="text"
                            class="form-control"
                            id="duration"
                            name="duration"
                            value="<?= old('duration', isset($course) ? $course['duration'] : '') ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="fee" class="form-label">Fee</label>
                        <input type="number"
                            class="form-control"
                            id="fee"
                            name="fee"
                            step="0.01"
                            value="<?= old('fee', isset($course) ? $course['fee'] : '') ?>"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="discount_type" class="form-label">Discount Type</label>
                        <select class="form-control" id="discount_type" name="discount_type">
                            <option value="">No Discount</option>
                            <option value="%" <?= old('discount_type', isset($course) ? $course['discount_type'] : '') == '%' ? 'selected' : '' ?>>
                                Percentage
                            </option>
                            <option value="fixed" <?= old('discount_type', isset($course) ? $course['discount_type'] : '') == 'fixed' ? 'selected' : '' ?>>
                                Fixed Amount
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="discount_value" class="form-label">Discount Value</label>
                        <input type="number"
                            class="form-control"
                            id="discount_value"
                            name="discount_value"
                            step="0.01"
                            value="<?= old('discount_value', isset($course) ? $course['discount_value'] : '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="batch_id" class="form-label">Batch Time</label>
                    <select class="form-control" id="batch_id" name="batch_id" required>
                        <option value="">Select Batch Time</option>
                        <?php foreach ($batches as $batch): ?>
                            <option value="<?= $batch['id'] ?>"
                                <?= old('batch_id', isset($course) ? $course['batch_id'] : '') == $batch['id'] ? 'selected' : '' ?>>
                                <?= date('g:i A', strtotime($batch['start_time'])) ?> -
                                <?= date('g:i A', strtotime($batch['end_time'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course Days</label>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($days as $day): ?>
                            <div class="form-check me-3 mb-2">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="days[]"
                                    value="<?= $day['id'] ?>"
                                    id="day<?= $day['id'] ?>"
                                    <?= (isset($selectedDayIds) && in_array($day['id'], $selectedDayIds)) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="day<?= $day['id'] ?>">
                                    <?= esc($day['day']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Course Image</label>
                    <?php if (isset($course) && $course['image']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/courses/' . $course['image']) ?>"
                                height="100"
                                alt="Current image">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/courses') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Toggle visibility of discount value field based on discount type
    document.getElementById('discount_type').addEventListener('change', function() {
        const discountValueField = document.getElementById('discount_value');
        if (this.value === '') {
            discountValueField.disabled = true;
            discountValueField.value = '';
        } else {
            discountValueField.disabled = false;
        }
    });

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', function() {
        const discountType = document.getElementById('discount_type');
        const discountValue = document.getElementById('discount_value');

        if (discountType.value === '') {
            discountValue.disabled = true;
        }
    });
</script>
<?= $this->endSection() ?>