<?php

namespace App\Models;

use app\Models\BaseModel;

class ServicePriceModel extends BaseModel
{
    protected $table = 'service_price';
    protected $primaryKey = 'id';

    protected $allowedFields = ['service_id', 'amount', 'effective_from', 'effective_to', 'is_active', 'is_published'];
    protected $useTimestamps = true;

    public function getAllServicePrices()
    {
        return $this->findAll();
    }

    public function getActiveServicePrices()
    {
        return $this->where('is_active', true)->findAll();
    }

    public function getPublishedServicePrices()
    {
        return $this->where('is_published', true)->findAll();
    }

    public function getServicePrice($id)
    {
        return $this->find($id);
    }
}
