<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Contact Messages</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-envelope me-1"></i>
            Messages List
            <div class="float-end">
                <form action="<?= site_url('admin/messages') ?>" method="get" class="d-inline-flex">
                    <div class="input-group input-group-sm me-2">
                        <label class="input-group-text" for="read-filter">Read</label>
                        <select class="form-select" id="read-filter" name="read" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="1" <?= $readFilter === '1' ? 'selected' : '' ?>>Read</option>
                            <option value="0" <?= $readFilter === '0' ? 'selected' : '' ?>>Unread</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm me-2">
                        <label class="input-group-text" for="responded-filter">Responded</label>
                        <select class="form-select" id="responded-filter" name="responded" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="1" <?= $respondedFilter === '1' ? 'selected' : '' ?>>Responded</option>
                            <option value="0" <?= $respondedFilter === '0' ? 'selected' : '' ?>>Not Responded</option>
                        </select>
                    </div>
                    <?php if ($readFilter !== null || $respondedFilter !== null): ?>
                        <a href="<?= site_url('admin/messages/clear-filters') ?>" class="btn btn-sm btn-outline-secondary">Clear Filters</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="8" class="text-center">No messages found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <tr class="<?= !$message['is_read'] ? 'table-active' : '' ?>">
                                    <td><?= $message['id'] ?></td>
                                    <td><?= esc($message['name']) ?> </td>
                                    <td><?= esc($message['email']) ?></td>
                                    <td><?= esc($message['sub'] ?? 'No Subject') ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($message['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/messages/toggle-read/' . $message['id']) ?>" 
                                           class="badge <?= $message['is_read'] ? 'bg-primary' : 'bg-secondary' ?>">
                                            <?= $message['is_read'] ? 'Read' : 'Unread' ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('admin/messages/toggle-responded/' . $message['id']) ?>" 
                                           class="badge <?= $message['is_responded'] ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $message['is_responded'] ? 'Responded' : 'Not Responded' ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('admin/messages/view/' . $message['id']) ?>"
                                           class="btn btn-sm btn-info" style="padding: 0 8px;">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Total: <?= $total ?> messages
                    </div>
                    <div>
                        <?= $pager ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>