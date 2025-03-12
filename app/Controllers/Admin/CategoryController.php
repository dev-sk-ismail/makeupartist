<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $data = [];
    
    public function __construct()
    {
        $this->categoryModel = new ProductCategoryModel();
    }
    
    public function index()
    {
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        return view('admin/categories/index', $this->data);
    }
    
    public function create()
    {
        return view('admin/categories/form', $this->data);
    }
    
    public function store()
    {
        $this->data = $this->request->getPost();
        
        if (!$this->categoryModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->categoryModel->errors());
        }
        
        return redirect()->to('admin/categories')
            ->with('success', 'Category created successfully');
    }
    
    public function edit($id)
    {
        $this->data['category'] = $this->categoryModel->find($id);
        
        if (!$this->data['category']) {
            return redirect()->to('admin/categories')
                ->with('error', 'Category not found');
        }
        
        return view('admin/categories/form', $this->data);
    }
    
    public function update($id)
    {
        $this->data = $this->request->getPost();
        
        if (!$this->categoryModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->categoryModel->errors());
        }
        
        return redirect()->to('admin/categories')
            ->with('success', 'Category updated successfully');
    }
    
    public function delete($id)
    {
        // Check if category is being used by any product
        $db = \Config\Database::connect();
        $productCount = $db->table('products')
            ->where('category_id', $id)
            ->countAllResults();
            
        if ($productCount > 0) {
            return redirect()->to('admin/categories')
                ->with('error', 'Cannot delete category. It is being used by ' . $productCount . ' product(s).');
        }
        
        $this->categoryModel->delete($id);
        return redirect()->to('admin/categories')
            ->with('success', 'Category deleted successfully');
    }
}