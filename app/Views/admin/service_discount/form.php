<!-- app/Views/admin/service_discount/form.php -->
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2"><?= esc($title) ?></h1>
                    <a href="<?= site_url('admin/service-discounts') ?>" 
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <form action="<?= isset($discount) ? 
                            site_url('admin/service-discounts/update/' . $discount['id']) : 
                            site_url('admin/service-discounts/create') ?>" 
                              method="post">
                            
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="service_id" class="form-label">Service</label>
                                <select name="service_id" 
                                        id="service_id" 
                                        required
                                        class="form-select">
                                    <option value="">Select Service</option>
                                    <?php foreach ($services as $service): ?>
                                        <?php if ($service['parent_id'] !== null): ?> <!-- Only show subcategories -->
                                            <option value="<?= $service['id'] ?>" 
                                                    <?= isset($discount) && $discount['service_id'] == $service['id'] ? 'selected' : '' ?>>
                                                <?= esc($service['name']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="discount_id" class="form-label">Discount</label>
                                <select name="discount_id" 
                                        id="discount_id" 
                                        required
                                        class="form-select">
                                    <option value="">Select Discount</option>
                                    <?php foreach ($discounts as $disc): ?>
                                        <?php if ($disc['is_active']): ?> <!-- Only show active discounts -->
                                            <option value="<?= $disc['id'] ?>" 
                                                    <?= isset($discount) && $discount['discount_id'] == $disc['id'] ? 'selected' : '' ?>>
                                                <?= esc($disc['name']) ?> 
                                                (<?= $disc['type'] === 'percentage' ? $disc['value'] . '%' : '$' . number_format($disc['value'], 2) ?>)
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="code" class="form-label">Discount Code</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="code" 
                                       name="code" 
                                       value="<?= isset($discount) ? esc($discount['code']) : old('code') ?>" 
                                       required
                                       placeholder="Enter discount code">
                            </div>

                            <div class="mb-3">
                                <label for="effective_from" class="form-label">Effective From</label>
                                <input type="date" 
                                       class="form-control" 
                                       id="effective_from" 
                                       name="effective_from" 
                                       value="<?= isset($discount) ? esc($discount['effective_from']) : old('effective_from') ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="effective_to" class="form-label">Effective To</label>
                                <input type="date" 
                                       class="form-control" 
                                       id="effective_to" 
                                       name="effective_to" 
                                       value="<?= isset($discount) ? esc($discount['effective_to']) : old('effective_to') ?>" >
                                <div class="form-text">Leave empty for no end date</div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i><?= isset($discount) ? 'Update' : 'Create' ?> Discount
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>