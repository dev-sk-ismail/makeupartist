<?php

namespace App\Models;

use CodeIgniter\Model;

class DayModel extends Model
{
    protected $table = 'days';
    protected $primaryKey = 'id';
    protected $allowedFields = ['day', 'isactive'];

    // Get all active days
    public function getActiveDays()
    {
        return $this->where('isactive', 1)->findAll();
    }
}