<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantsModel extends Model
{
    protected $table = 'variants';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'service_id',
        'name',
        'description',
        'price',
        'discount_type',
        'discount_value',
        'prioriy',
        'is_active',
        'is_published',
        'published_at',
        'created_by',
        'updated_by'
    ];

    // Validation rules
    protected $validationRules = [
        'service_id' => 'required|numeric',
        'name' => 'required|min_length[2]|max_length[255]',
        'description' => 'permit_empty',
        'price' => 'required|numeric',
        'discount_type' => 'required|in_list[flat,%]',
        'discount_value' => 'required|numeric',
        'is_active' => 'permit_empty|in_list[0,1]',
        'is_published' => 'permit_empty|in_list[0,1]',
        'published_at' => 'permit_empty|valid_date',
        'created_by' => 'permit_empty|numeric',
        'updated_by' => 'permit_empty|numeric'
    ];

    // Auto-populate created_at and updated_at timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Auto-generate published_at before insert/update if is_published is true
    protected function beforeInsert(array $data)
    {
        if (isset($data['data']['is_published']) && $data['data']['is_published'] == 1) {
            $data['data']['published_at'] = date('Y-m-d H:i:s');
        }
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (isset($data['data']['is_published']) && $data['data']['is_published'] == 1) {
            $data['data']['published_at'] = date('Y-m-d H:i:s');
        }
        return $data;
    }

    // Get all variants with their service names
    public function getAllVariants()
    {
        return $this->select('variants.*, services.name as service_name')
            ->join('services', 'variants.service_id = services.id', 'left')
            ->findAll();
    }

    // Get active variants
    public function getActiveVariants()
    {
        return $this->where('is_active', 1)->findAll();
    }

    // Get published variants
    public function getPublishedVariants()
    {
        return $this->where('is_published', 1)->findAll();
    }

    // Get variants by service ID
    public function getVariantsByService($serviceId)
    {
        return $this->select("id, name, description, discount_type, discount_value, price, 
                             ROUND(IF(discount_type='%', price - (price * discount_value / 100), price - discount_value)) AS payable_amount")
            ->where('service_id', $serviceId)
            ->where('is_published', 1)
            ->orderBy('priority')
            ->findAll();
    }


    // Get variant details by ID
    public function getVariantById($id)
    {
        return $this->find($id);
    }

    // Calculate payable amount for a variant
    public function calculatePayableAmount($variantId)
    {
        $variant = $this->find($variantId);
        if (!$variant) {
            return null;
        }

        $price = $variant['price'];
        $discountType = $variant['discount_type'];
        $discountValue = $variant['discount_value'];

        if ($discountType === 'flat') {
            return $price - $discountValue;
        } elseif ($discountType === 'percent') {
            return $price - ($price * ($discountValue / 100));
        }

        return $price;
    }


    public function getFilteredVariants($search = null, $serviceId = null, $perPage = 10, $page = 1)
    {
        $builder = $this->select('variants.*, services.name as service_name')
            ->join('services', 'variants.service_id = services.id', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('variants.name', $search)
                ->orLike('variants.description', $search)
                ->orLike('services.name', $search)
                ->groupEnd();
        }

        if ($serviceId) {
            $builder->where('variants.service_id', $serviceId);
        }

        return $builder->paginate($perPage, 'variants');
    }
}
