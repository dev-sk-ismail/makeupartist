<?php

namespace App\Models;

class ServicesModel extends BaseModel
{
    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'parent_id',
        'slug',
        'name',
        'title',
        'img',
        'description'
    ];

    public function fetchValidationRules($id = null)
    {
        $validationRules = [
            'name' => 'required|min_length[2]|max_length[255]',
            'title' => 'required|min_length[2]|max_length[255]',
            'parent_id' => 'permit_empty|numeric|is_not_unique[services.id]',
            'img' => 'permit_empty|max_length[255]',
            'description' => 'permit_empty'
        ];

        // Add slug validation based on whether it's an update or new record
        if ($id) {
            $validationRules['slug'] = "required|alpha_dash|min_length[2]|max_length[255]|is_unique[services.slug,id,$id]";
        } else {
            $validationRules['slug'] = 'required|alpha_dash|min_length[2]|max_length[255]|is_unique[services.slug]';
        }

        return $validationRules;
    }

    protected $validationMessages = [
        'name' => [
            'required' => 'The Name field is required.',
            'min_length' => 'The Name field must be at least 2 characters long.',
            'max_length' => 'The Name field cannot exceed 255 characters.',
        ],
        'title' => [
            'required' => 'The Title field is required.',
            'min_length' => 'The Title field must be at least 2 characters long.',
            'max_length' => 'The Title field cannot exceed 255 characters.',
        ],
        'parent_id' => [
            'permit_empty' => 'The Parent ID field can be empty.',
            'numeric' => 'The Parent ID field must be a number.',
            'is_not_unique' => 'The Parent ID must exist in the Services table.',
        ],
        'img' => [
            'permit_empty' => 'The Image field can be empty.',
            'max_length' => 'The Image field cannot exceed 255 characters.',
        ],
        'description' => [
            'permit_empty' => 'The Description field can be empty.',
        ],
        'slug' => [
            'required' => 'The Slug field is required.',
            'alpha_dash' => 'The Slug field may only contain alpha-numeric characters, underscores, and dashes.',
            'min_length' => 'The Slug field must be at least 2 characters long.',
            'max_length' => 'The Slug field cannot exceed 255 characters.',
            'is_unique' => 'The Slug must be unique. This Slug already exists.',
        ],
    ];


    //Get all services for table
    public function getAllServices()
    {
        return $this->findAll();
    }

    //Get a service by id
    public function getServiceById($id)
    {
        if ($id) {
            return $this->where('id', $id);
        }
    }

    // Get main categories (services without parent_id)
    public function getMainCategories()
    {
        return $this->where('parent_id IS NULL')
            ->findAll();
    }

    // Get subcategories of a specific service
    public function getSubcategories($parentId)
    {
        return $this->where('parent_id', $parentId)
            ->findAll();
    }

    // Get service with its parent details
    public function getWithParent($id)
    {
        return $this->select('services.*, parent.name as parent_name')
            ->join('services as parent', 'services.parent_id = parent.id', 'left')
            ->find($id);
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

    // Before inserting/updating, generate slug if not provided
    protected function beforeInsert(array $data): array
    {
        $data = $this->generateSlug($data);
        return $data;
    }

    protected function beforeUpdate(array $data): array
    {
        $data = $this->generateSlug($data);
        return $data;
    }

    // Helper method to generate slug
    protected function generateSlug(array $data): array
    {
        // Only generate slug if name is provided and slug isn't
        if (isset($data['data']['name']) && !isset($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }

        return $data;
    }
}
