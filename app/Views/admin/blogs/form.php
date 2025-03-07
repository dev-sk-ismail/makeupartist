<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($blog) ? 'Edit Blog' : 'New Blog' ?></h1>

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
            <form action="<?= isset($blog) ? site_url('admin/blogs/update/' . $blog['id']) : site_url('admin/blogs/store') ?>"
                method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">Name (Internal Reference)</label>
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="<?= old('name', isset($blog) ? $blog['name'] : '') ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                        class="form-control"
                        id="title"
                        name="title"
                        value="<?= old('title', isset($blog) ? $blog['title'] : '') ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text"
                        class="form-control"
                        id="author"
                        name="author"
                        value="<?= old('author', isset($blog) ? $blog['author'] : '') ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <?php if (isset($blog) && $blog['image']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/blogs/' . $blog['image']) ?>"
                                height="100"
                                alt="Current image">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="draft" <?= old('status', isset($blog) ? $blog['status'] : '') == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= old('status', isset($blog) ? $blog['status'] : '') == 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="archived" <?= old('status', isset($blog) ? $blog['status'] : '') == 'archived' ? 'selected' : '' ?>>Archived</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="published_date" class="form-label">Published Date</label>
                    <input type="datetime-local"
                        class="form-control"
                        id="published_date"
                        name="published_date"
                        value="<?= old('published_date', isset($blog) && $blog['published_date'] ? date('Y-m-d\TH:i', strtotime($blog['published_date'])) : '') ?>">
                    <small class="text-muted">Leave empty to use current date if status is published</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="quill-editor-default"></div>
                    <input type="hidden" class="form-control quill-hidden-input" name="description" id="description" value="<?= old('description', isset($blog) ? $blog['description'] : '') ?>">
                </div>


                <?php if (isset($blog)): ?>
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" class="form-control" value="<?= esc($blog['author']) ?>" readonly>
                        <input type="hidden" name="author" value="<?= esc($blog['author']) ?>">
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/blogs') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Add any JavaScript for rich text editor initialization here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Initialize a rich text editor for the description field
        // You might want to add a WYSIWYG editor like CKEditor or TinyMCE
    });
</script>
<?= $this->endSection() ?>