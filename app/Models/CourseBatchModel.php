<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseBatchModel extends Model
{
    protected $table = 'course_batches';
    protected $primaryKey = 'id';
    protected $allowedFields = ['start_time', 'end_time'];

    // Validation rules
    protected $validationRules = [
        'start_time' => 'required',
        'end_time' => 'required'
    ];

    // Get all batches
    public function getAllBatches()
    {
        return $this->findAll();
    }

    // Format batch time for display (e.g., "9:00 AM - 11:00 AM")
    public function formatBatchTime($batch)
    {
        if (!$batch) {
            return '';
        }
        
        $startTime = date('g:i A', strtotime($batch['start_time']));
        $endTime = date('g:i A', strtotime($batch['end_time']));
        
        return $startTime . ' - ' . $endTime;
    }
}