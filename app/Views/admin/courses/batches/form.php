<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><?= isset($batch) ? 'Edit Batch' : 'New Batch' ?></h1>
    
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
        <a href="<?= site_url('admin/courses/batches') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Batches
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= isset($batch) ? 
                          site_url('admin/courses/batches/update/' . $batch['id']) : 
                          site_url('admin/courses/batches/store') ?>" 
                  method="POST">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" 
                               class="form-control" 
                               id="start_time" 
                               name="start_time" 
                               value="<?= old('start_time', isset($batch) ? $batch['start_time'] : '') ?>" 
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" 
                               class="form-control" 
                               id="end_time" 
                               name="end_time" 
                               value="<?= old('end_time', isset($batch) ? $batch['end_time'] : '') ?>" 
                               required>
                    </div>
                </div>
                
                <div id="timeError" class="alert alert-danger d-none">
                    End time must be after start time.
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?= site_url('admin/courses/batches') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');
        const timeError = document.getElementById('timeError');
        
        form.addEventListener('submit', function(e) {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            
            if (startTime && endTime && startTime >= endTime) {
                e.preventDefault();
                timeError.classList.remove('d-none');
            } else {
                timeError.classList.add('d-none');
            }
        });
        
        // Hide error when inputs change
        [startTimeInput, endTimeInput].forEach(input => {
            input.addEventListener('input', function() {
                timeError.classList.add('d-none');
            });
        });
    });
</script>
<?= $this->endSection() ?>