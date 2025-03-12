<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="shop">
    <div class="container py-4">
        <h1 class="mb-4">Products</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Filter and Search Form -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-filter me-1"></i> Filter Products
            </div>
            <div class="card-body">
                <form action="<?= site_url('shop') ?>" method="get" id="filter-form">
                    <div class="row justify-content-center align-items-end text-center">
                        <div class="col-md-3 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= ($filters['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                        <?= esc($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="sort" class="form-label">Sort By</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="priority" <?= ($sort == 'priority') ? 'selected' : '' ?>>Priority</option>
                                <option value="price" <?= ($sort == 'price') ? 'selected' : '' ?>>Price</option>
                                <option value="name" <?= ($sort == 'name') ? 'selected' : '' ?>>Name</option>
                                <option value="created_at" <?= ($sort == 'created_at') ? 'selected' : '' ?>>Newest</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="order" class="form-label">Order</label>
                            <select class="form-select" id="order" name="order">
                                <option value="DESC" <?= ($order == 'DESC') ? 'selected' : '' ?>>Descending</option>
                                <option value="ASC" <?= ($order == 'ASC') ? 'selected' : '' ?>>Ascending</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="d-flex justify-content-around">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <button type="button" class="btn btn-secondary" id="reset-filters">Reset</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search products..."
                            value="<?= $filters['search'] ?? '' ?>">
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
            <?php foreach ($products as $product) {
                $url = "https://wa.me/91" . $settings['bsns_phone'] . "?text=Hello.%20I%20would%20like%20to%20order%20the%20following%20item-%0A%0AProduct%20Name:%20" . esc($product['name']) . ",%0AProduct%20ID:%20PDT240" . $product['id'] . "53,%0A%0APlease%20Confirm%20my%20order%20soon%20in%20this%20number";
            ?>
                <div class="col">
                    <div class="card">
                        <!-- If you have product images, add them here -->
                        <div class="card-img-top text-center py-4">
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                class="img-fluid" alt="<?= esc($product['name']) ?>">
                        </div>
                        <div class="card-body">
                            <strong class="card-title"><?= esc($product['name']) ?></strong>
                            <p class="card-description"><?= esc($product['description']) ?></p>
                            <?php
                            // Calculate final price
                            $finalPrice = $product['price'];
                            if (!empty($product['discount_value'])) {
                                if ($product['discount_type'] == '%') {
                                    $finalPrice = $finalPrice - ($finalPrice * ($product['discount_value'] / 100));
                                } else if ($product['discount_type'] == 'fixed') {
                                    $finalPrice = $finalPrice - $product['discount_value'];
                                }
                                $finalPrice = max(0, $finalPrice);
                            }
                            ?>

                            <div class="d-flex justify-content-between align-items-center">
                                <?php if (!empty($product['discount_value'])): ?>
                                    <div>
                                        <span class="text-decoration-line-through px-1 text-muted">₹<?= number_format($product['price'], 0) ?></span>
                                        <span class="badge">
                                            <?= $product['discount_type'] == '%' ? number_format($product['discount_value'], 0) . '% OFF' : '$' . $product['discount_value'] . ' OFF' ?>
                                        </span>
                                    </div>
                                    <span class="fs-5 fw-bold">₹<?= number_format($finalPrice, 0) ?></span>

                                <?php else: ?>
                                    <span class="fs-5 fw-bold">$<?= number_format($product['price'], 0) ?></span>
                                    <span></span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($product['tag'])): ?>
                                <div class="mt-2">
                                    <span class="badge"><?= esc($product['tag']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer border-top-0">
                            <a href="<?= $url ?>" class="btn btn-primary w-100" target="_blank">PLACE ORDER</a>
                        </div>
                    </div>
                </div>
            <?php }; ?>
        </div>

        <!-- Empty State -->
        <?php if (empty($products)): ?>
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h4>No products found</h4>
                <p>Try adjusting your filters or search criteria.</p>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?= $pager->links() ?>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Reset filters button
    document.getElementById('reset-filters').addEventListener('click', function() {
        window.location.href = '<?= site_url('products') ?>';
    });

    // Auto-submit form when changing sort, order, or per_page
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });

    document.getElementById('order').addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });

    document.getElementById('per_page').addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });
</script>
<?= $this->endSection() ?>