<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($product) ? 'Edit Product' : 'Create New Product' ?></h1>

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
            Product Form
        </div>
        <div class="card-body">
            <form action="<?= isset($product) ? site_url('admin/products/update/' . $product['id']) : site_url('admin/products/store') ?>" method="post"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= isset($product) ? esc($product['name']) : old('name') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($product) && $product['category_id'] == $category['id']) ? 'selected' : (old('category_id') == $category['id'] ? 'selected' : '') ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="quill-editor-default"></div>
                    <input type="hidden" class="form-control quill-hidden-input" name="description" id="description" value="<?= old('description', isset($product) ? $product['description'] : '') ?>">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" min="0"
                            value="<?= isset($product) ? $product['price'] : old('price') ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="discount_type" class="form-label">Discount Type</label>
                        <select class="form-select" id="discount_type" name="discount_type">
                            <option value="">No Discount</option>
                            <option value="%" <?= (isset($product) && $product['discount_type'] == '%') ? 'selected' : (old('discount_type') == '%' ? 'selected' : '') ?>>Percentage (%)</option>
                            <option value="fixed" <?= (isset($product) && $product['discount_type'] == 'fixed') ? 'selected' : (old('discount_type') == 'fixed' ? 'selected' : '') ?>>Fixed Amount</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="discount_value" class="form-label">Discount Value</label>
                        <input type="number" class="form-control" id="discount_value" name="discount_value" min="0"
                            value="<?= isset($product) ? $product['discount_value'] : old('discount_value') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag"
                            value="<?= isset($product) ? esc($product['tag']) : old('tag') ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" id="priority" name="priority"
                            value="<?= isset($product) ? $product['priority'] : old('priority', 0) ?>">
                        <small class="text-muted">Higher number means higher priority</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                <?= (isset($product) && $product['is_active']) ? 'checked' : (old('is_active') ? 'checked' : '') ?>>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                                <?= (isset($product) && $product['is_published']) ? 'checked' : (old('is_published') ? 'checked' : '') ?>>
                            <label class="form-check-label" for="is_published">
                                Published
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                <?= (isset($product) && $product['is_featured']) ? 'checked' : (old('is_featured') ? 'checked' : '') ?>>
                            <label class="form-check-label" for="is_featured">
                                Featured
                            </label>
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <?php if (isset($product) && $product['image']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                height="100"
                                alt="Current image">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="mb-3">
                    <a href="<?= site_url('admin/products') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Optional: Add client-side discount field validation
    document.getElementById('discount_type').addEventListener('change', function() {
        const discountValueField = document.getElementById('discount_value');
        if (this.value === '') {
            discountValueField.value = '';
            discountValueField.disabled = true;
        } else {
            discountValueField.disabled = false;
        }
    });

    // Initialize the state on page load
    window.addEventListener('DOMContentLoaded', function() {
        const discountType = document.getElementById('discount_type');
        const discountValueField = document.getElementById('discount_value');
        if (discountType.value === '') {
            discountValueField.disabled = true;
        }
    });
</script>
<?= $this->endSection() ?>