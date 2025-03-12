<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category_id', 'name', 'image', 'description', 'tag', 'price', 
        'discount_type', 'discount_value', 'priority', 'is_active', 
        'is_published', 'published_at', 'is_featured', 'created_by', 'updated_by'
    ];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'image' => 'permit_empty|max_length[255]',
        'category_id' => 'required|numeric',
        'price' => 'required|numeric',
        'discount_type' => 'permit_empty|in_list[%,fixed]',
        'discount_value' => 'permit_empty|numeric',
        'priority' => 'permit_empty|numeric',
        'description' => 'permit_empty'
    ];

    // Get all products with their category names
    public function getAllProducts()
    {
        return $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'products.category_id = product_categories.id', 'left')
            ->findAll();
    }

    // Get products with pagination, filtering, and sorting
    public function getFilteredProducts($page = 1, $perPage = 10, $filters = [], $sort = 'priority', $order = 'DESC')
    {
        $builder = $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'products.category_id = product_categories.id', 'left');
        
        // Apply filters
        if (!empty($filters)) {
            if (isset($filters['category_id']) && !empty($filters['category_id'])) {
                $builder->where('products.category_id', $filters['category_id']);
            }
            
            if (isset($filters['is_featured']) && $filters['is_featured'] !== '') {
                $builder->where('products.is_featured', $filters['is_featured']);
            }
            
            if (isset($filters['is_active']) && $filters['is_active'] !== '') {
                $builder->where('products.is_active', $filters['is_active']);
            }
            
            if (isset($filters['is_published']) && $filters['is_published'] !== '') {
                $builder->where('products.is_published', $filters['is_published']);
            }
            
            if (isset($filters['search']) && !empty($filters['search'])) {
                $builder->groupStart()
                    ->like('products.name', $filters['search'])
                    ->orLike('products.tag', $filters['search'])
                    ->orLike('products.description', $filters['search'])
                    ->groupEnd();
            }
            
            if (isset($filters['price_min']) && is_numeric($filters['price_min'])) {
                $builder->where('products.price >=', $filters['price_min']);
            }
            
            if (isset($filters['price_max']) && is_numeric($filters['price_max'])) {
                $builder->where('products.price <=', $filters['price_max']);
            }
        }
        
        // Apply sorting
        $builder->orderBy($sort, $order);
        
        return [
            'products' => $builder->paginate($perPage, 'default', $page),
            'pager' => $this->pager
        ];
    }

    // Get product by ID with category info
    public function getProductById($id)
    {
        return $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'products.category_id = product_categories.id', 'left')
            ->where('products.id', $id)
            ->first();
    }

    // Set is_active status
    public function setActiveStatus($id, $status)
    {
        return $this->update($id, ['is_active' => $status]);
    }

    // Set is_published status
    public function setPublishedStatus($id, $status)
    {
        $data = ['is_published' => $status];
        if ($status == 1) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }
        return $this->update($id, $data);
    }

    // Set is_featured status
    public function setFeaturedStatus($id, $status)
    {
        return $this->update($id, ['is_featured' => $status]);
    }

    // Get featured products
    public function getFeaturedProducts($limit = 4)
    {
        return $this->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'products.category_id = product_categories.id', 'left')
            ->where('products.is_featured', 1)
            ->where('products.is_active', 1)
            ->where('products.is_published', 1)
            ->orderBy('products.priority', 'DESC')
            ->limit($limit)
            ->find();
    }

    // Calculate final price after discount
    public function calculateFinalPrice($product)
    {
        $price = $product['price'];
        if (!empty($product['discount_value'])) {
            if ($product['discount_type'] == '%') {
                $price = $price - ($price * ($product['discount_value'] / 100));
            } else if ($product['discount_type'] == 'fixed') {
                $price = $price - $product['discount_value'];
            }
        }
        return max(0, $price);
    }

    // Override insert method to add created_by and created_at
    public function insert($data = null, bool $returnID = true)
    {
        // Add created_by if not set
        if (!isset($data['created_by']) && session()->has('user_id')) {
            $data['created_by'] = session()->get('user_id');
        }
        
        return parent::insert($data, $returnID);
    }

    // Override update method to add updated_by
    public function update($id = null, $data = null): bool
    {
        // Add updated_by if not set
        if (!isset($data['updated_by']) && session()->has('user_id')) {
            $data['updated_by'] = session()->get('user_id');
        }
        
        return parent::update($id, $data);
    }
}