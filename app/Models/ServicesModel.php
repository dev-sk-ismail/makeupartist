<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['parent_id', 'name', 'title', 'img', 'description', 'slug'];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'title' => 'required|min_length[2]|max_length[255]',
        'parent_id' => 'permit_empty|numeric',
        'img' => 'permit_empty|max_length[255]',
        'description' => 'permit_empty'
    ];

    // Get all services with their parent names
    public function getAllServices()
    {
        return $this->select('services.*, parent.name as parent_name')
            ->join('services as parent', 'services.parent_id = parent.id', 'left')
            ->findAll();
    }

    // Get main services (no parent)
    public function getMainServices()
    {
        return $this->where('parent_id', 0)->findAll();
    }

    // Auto-generate slug before insert/update
    protected function beforeInsert(array $data)
    {
        $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (isset($data['data']['name'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }

    // Get main categories (services without parent_id)
    public function getMainCategories()
    {
        return $this->where('parent_id',0)
            ->findAll();
    }

    // Get subcategories of a specific service
    public function getSubcategories($parentId)
    {
        return $this->where('parent_id', $parentId)
            ->findAll();
    }


    // Get complete service hierarchy ..
    public function getServiceHierarchy()
    {
        $mainCategories = $this->getMainCategories();

        foreach ($mainCategories as &$category) {
            $category['subcategories'] = $this->getSubcategories($category['id']);
        }

        return $mainCategories;
    }

        // Get Service details by ID
        public function getServiceById($id)
        {
            return $this->find($id);
        }

    public function getServiceBySlug ($slug) {
        return $this->where('slug', $slug)
            ->findAll();
    }


        // Get main categories (services with a parent_id)
        public function getSubServices()
        {
            return $this->whereNotIn('parent_id',[0])
                ->findAll();
        }
}
