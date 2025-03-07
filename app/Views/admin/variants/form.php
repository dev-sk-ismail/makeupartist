<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($variant) ? 'Edit' : 'Create' ?> Variant</h1>
    
    <?php if(session()->has('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach(session('errors') as $error): ?>
                <div><?= $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= site_url('admin/variants/' . (isset($variant) ? 'update/'.$variant['id'] : 'store')) ?>" 
                  method="post">
                
                <!-- Service Selection -->
                <div class="mb-3">
                    <label for="service_id" class="form-label required">Service</label>
                    <select name="service_id" id="service_id" class="form-control" required>
                        <option value="">Select Service</option>
                        <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>" 
                            <?= isset($variant) && $variant['service_id'] == $service['id'] ? 'selected' : '' ?>>
                            <?= esc($service['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Variant Name -->
                <div class="mb-3">
                    <label for="name" class="form-label required">Variant Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?= isset($variant) ? esc($variant['name']) : old('name') ?>" 
                           required minlength="2" maxlength="255">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= isset($variant) ? esc($variant['description']) : old('description') ?></textarea>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label required">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" 
                           value="<?= isset($variant) ? $variant['price'] : old('price') ?>" required>
                </div>

                <!-- Discount -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount_type" class="form-label required">Discount Type</label>
                            <select name="discount_type" id="discount_type" class="form-control" required>
                                <option value="flat" <?= (isset($variant) && $variant['discount_type'] == 'flat') || old('discount_type') == 'flat' ? 'selected' : '' ?>>
                                    Flat Amount
                                </option>
                                <option value="%" <?= (isset($variant) && $variant['discount_type'] == '%') || old('discount_type') == '%' ? 'selected' : '' ?>>
                                    Percentage
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount_value" class="form-label required">Discount Value</label>
                            <input type="number" step="0.01" class="form-control" id="discount_value" 
                                   name="discount_value" 
                                   value="<?= isset($variant) ? $variant['discount_value'] : old('discount_value') ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <input type="number" class="form-control" id="priority" name="priority" 
                           value="<?= isset($variant) ? $variant['priority'] : old('priority', 0) ?>">
                </div>

                <!-- Status Toggles -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                <?= (isset($variant) && $variant['is_active']) || old('is_active') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
                                <?= (isset($variant) && $variant['is_published']) || old('is_published') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_published">Published</label>
                        </div>
                    </div>
                </div>

                <!-- Published At Date -->
                <?php if(isset($variant) && $variant['published_at']): ?>
                <div class="mb-3">
                    <label class="form-label">Published Date</label>
                    <p class="form-control-static">
                        <?= date('Y-m-d H:i:s', strtotime($variant['published_at'])) ?>
                    </p>
                </div>
                <?php endif; ?>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Variant</button>
                    <a href="<?= site_url('admin/variants') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add some custom styles -->
<style>
.required:after {
    content: " *";
    color: red;
}
</style>

<!-- Add validation script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show dynamic payable amount calculation
    const priceInput = document.getElementById('price');
    const discountTypeSelect = document.getElementById('discount_type');
    const discountValueInput = document.getElementById('discount_value');
    
    function calculatePayableAmount() {
        const price = parseFloat(priceInput.value) || 0;
        const discountValue = parseFloat(discountValueInput.value) || 0;
        const discountType = discountTypeSelect.value;
        
        let payableAmount = price;
        if (discountType === 'flat') {
            payableAmount = price - discountValue;
        } else if (discountType === 'percent') {
            payableAmount = price - (price * discountValue / 100);
        }
        
        // You could display this somewhere on the form if desired
        console.log('Payable Amount:', payableAmount.toFixed(2));
    }
    
    priceInput.addEventListener('input', calculatePayableAmount);
    discountTypeSelect.addEventListener('change', calculatePayableAmount);
    discountValueInput.addEventListener('input', calculatePayableAmount);
});
</script>
<?= $this->endSection() ?>