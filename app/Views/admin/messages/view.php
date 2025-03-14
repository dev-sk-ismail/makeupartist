<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">View Message</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-envelope me-1"></i>
                Message Details
            </div>
            <div>
                <a href="<?= site_url('admin/messages') ?>" class="btn btn-sm btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>From</h5>
                    <p class="mb-1"><strong>Name:</strong> <?= esc($message['name']) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= esc($message['email']) ?></p>
                    <?php if (!empty($message['phone'])): ?>
                        <p class="mb-1"><strong>Phone:</strong> <?= esc($message['phone']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h5>Status</h5>
                    <p class="mb-1">
                        <strong>Read Status:</strong> 
                        <a href="<?= site_url('admin/messages/toggle-read/' . $message['id']) ?>" 
                           class="badge <?= $message['is_read'] ? 'bg-primary' : 'bg-secondary' ?>">
                            <?= $message['is_read'] ? 'Read' : 'Unread' ?>
                        </a>
                    </p>
                    <p class="mb-1">
                        <strong>Response Status:</strong> 
                        <a href="<?= site_url('admin/messages/toggle-responded/' . $message['id']) ?>" 
                           class="badge <?= $message['is_responded'] ? 'bg-success' : 'bg-warning' ?>">
                            <?= $message['is_responded'] ? 'Responded' : 'Not Responded' ?>
                        </a>
                    </p>
                    <p class="mb-1"><strong>Date Received:</strong> <?= date('F d, Y H:i:s', strtotime($message['created_at'])) ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><?= esc($message['sub'] ?? 'No Subject') ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="message-content">
                                <?= nl2br(esc($message['msg'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($message['updated_at'] !== $message['created_at']): ?>
                <div class="mt-3 text-muted">
                    <small>
                        Last updated: <?= date('F d, Y H:i:s', strtotime($message['updated_at'])) ?>
                        <?php if (!empty($message['updated_by'])): ?>
                            by Admin ID: <?= $message['updated_by'] ?>
                        <?php endif; ?>
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>