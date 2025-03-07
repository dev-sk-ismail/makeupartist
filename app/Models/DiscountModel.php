<?php

namespace App\Models;

use app\Models\BaseModel;

class DiscountModel extends BaseModel
{
    protected $table = 'discounts';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name',
        'type',
        'value',
        'is_active'
    ];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'type' => 'required|in_list[percentage,fixed]',  // Assuming discount can be percentage or fixed amount
        'value' => 'required|numeric|greater_than[0]',
        'is_active' => 'required|in_list[0,1]'
    ];

    // Get only active discounts
    public function getActiveDiscounts()
    {
        return $this->where('is_active', 1)
                    ->findAll();
    }

    // Format discount for display
    public function formatDiscount($discount)
    {
        if ($discount['type'] === 'percentage') {
            return $discount['value'] . '%';
        }
        return number_format($discount['value'], 2);  // For fixed amount
    }
}