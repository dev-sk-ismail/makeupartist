<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    
    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]'
    ];
    
    // Get all categories
    public function getAllCategories()
    {
        return $this->findAll();
    }
    
    // Get category by ID
    public function getCategoryById($id)
    {
        return $this->find($id);
    }
    
    // Get categories with product counts
    public function getCategoriesWithCounts()
    {
        $db = \Config\Database::connect();
        
        return $db->table($this->table)
            ->select('product_categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = product_categories.id', 'left')
            ->groupBy('product_categories.id')
            ->get()
            ->getResultArray();
    }
}