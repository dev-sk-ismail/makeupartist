<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class ShopController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $data = [];
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new ProductCategoryModel();
    }
    
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12;
        
        // Get filter parameters
        $filters = [
            'category_id' => $this->request->getGet('category_id'),
            'search' => $this->request->getGet('search'),
        ];
        
        // Get sort parameters
        $sort = $this->request->getGet('sort') ?? 'priority';
        $order = $this->request->getGet('order') ?? 'DESC';
        
        // Only show active and published products on frontend
        $filters['is_active'] = 1;
        $filters['is_published'] = 1;
        
        // Get products with filter and pagination
        $result = $this->productModel->getFilteredProducts($page, $perPage, $filters, $sort, $order);
        
        $this->data['products'] = $result['products'];
        $this->data['pager'] = $result['pager'];
        
        // Get categories for filter
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        
        // Pass filter and sort parameters to view for maintaining state
        $this->data['filters'] = $filters;
        $this->data['sort'] = $sort;
        $this->data['order'] = $order;
        $this->data['perPage'] = $perPage;
        
        return view('shop/index', $this->data);
    }
    
    public function detail($id)
    {
        $this->data['product'] = $this->productModel->getProductById($id);
        
        if (!$this->data['product'] || !$this->data['product']['is_active'] || !$this->data['product']['is_published']) {
            return redirect()->to('shop')
                ->with('error', 'Product not found or unavailable');
        }
        
        // Calculate final price after discount
        $this->data['final_price'] = $this->productModel->calculateFinalPrice($this->data['product']);
        
        // Get related products from same category
        $this->data['related_products'] = $this->productModel->select('products.*, product_categories.name as category_name')
            ->join('product_categories', 'products.category_id = product_categories.id', 'left')
            ->where('products.category_id', $this->data['product']['category_id'])
            ->where('products.id !=', $id)
            ->where('products.is_active', 1)
            ->where('products.is_published', 1)
            ->orderBy('products.priority', 'DESC')
            ->limit(4)
            ->find();
            
        return view('shop/detail', $this->data);
    }
    
    public function category($id)
    {
        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            return redirect()->to('shop')
                ->with('error', 'Category not found');
        }
        
        // Redirect to index with category filter
        return redirect()->to('shop?category_id=' . $id);
    }
}