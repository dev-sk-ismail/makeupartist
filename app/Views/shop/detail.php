<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('products') ?>">Products</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('products?category_id=' . $product['category_id']) ?>"><?= esc($product['category_name']) ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($product['name']) ?></li>
        </ol>
    </nav>
    
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="bg-light text-center p-5 rounded">
                        <i class="fas fa-box fa-8x text-secondary"></i>
                        <!-- If you add product images later, replace this with an image tag -->
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="col-md-7">
                    <h1 class="mb-2"><?= esc($product['name']) ?></h1>
                    
                    <div class="mb-3">
                        <span class="badge bg-secondary"><?= esc($product['category_name']) ?></span>
                        <?php if ($product['is_featured']): ?>
                        <span class="badge bg-primary">Featured</span>
                        <?php endif; ?>
                        <?php if (!empty($product['tag'])): ?>
                        <span class="badge bg-info"><?= esc($product['tag']) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <?php if (!empty($product['discount_value'])): ?>
                            <div class="d-flex align-items-center">
                                <h4 class="text-decoration-line-through text-muted me-2">$<?= number_format($product['price'], 2) ?></h4>
                                <h2 class="text-danger fw-bold">$<?= number_format($final_price, 2) ?></h2>
                                <span class="ms-2 badge bg-danger">
                                    <?= $product['discount_type'] == '%' ? $product['discount_value'] . '% OFF' : '$' . $product['discount_value'] . ' OFF' ?>
                                </span>
                            </div>
                        <?php else: ?>
                            <h2 class="fw-bold">$<?= number_format($product['price'], 2) ?></h2>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Description</h5>
                        <div class="border-top pt-3">
                            <?php if (!empty($product['description'])): ?>
                                <p><?= nl2br(esc($product['description'])) ?></p>
                            <?php else: ?>
                                <p class="text-muted">No description available for this product.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-lg btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                        <button class="btn btn-lg btn-outline-secondary">
                            <i class="fas fa-heart me-2"></i> Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    <?php if (!empty($related_products)): ?>
    <div class="mt-5">
        <h3 class="mb-4">Related Products</h3>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php foreach ($related_products as $related): ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-img-top bg-light text-center py-4">
                        <i class="fas fa-box fa-4x text-secondary"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($related['name']) ?></h5>
                        
                        <?php 
                        // Calculate final price
                        $relatedFinalPrice = $related['price'];
                        if (!empty($related['discount_value'])) {
                            if ($related['discount_type'] == '%') {
                                $relatedFinalPrice = $relatedFinalPrice - ($relatedFinalPrice * ($related['discount_value'] / 100));
                            } else if ($related['discount_type'] == 'fixed') {
                                $relatedFinalPrice = $relatedFinalPrice - $related['discount_value'];
                            }
                            $relatedFinalPrice = max(0, $relatedFinalPrice);
                        }
                        ?>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if (!empty($related['discount_value'])): ?>
                                <div>
                                    <span class="text-decoration-line-through text-muted">$<?= number_format($related['price'], 2) ?></span>
                                    <span class="fs-5 text-danger fw-bold">$<?= number_format($relatedFinalPrice, 2) ?></span>
                                </div>
                            <?php else: ?>
                                <span class="fs-5 fw-bold">$<?= number_format($related['price'], 2) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="<?= site_url('products/detail/' . $related['id']) ?>" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>