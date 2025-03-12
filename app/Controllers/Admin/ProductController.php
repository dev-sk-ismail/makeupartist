<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class ProductController extends BaseController
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
        $this->data['products'] = $this->productModel->getAllProducts();
        return view('admin/products/index', $this->data);
    }

    public function create()
    {
        $this->data['categories'] = $this->categoryModel->getAllCategories();
        return view('admin/products/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/products', $newName);
            $this->data['image'] = $newName;
        }

        // Set default values for checkboxes if not provided
        $this->data['is_active'] = $this->request->getPost('is_active') ? 1 : 0;
        $this->data['is_published'] = $this->request->getPost('is_published') ? 1 : 0;
        $this->data['is_featured'] = $this->request->getPost('is_featured') ? 1 : 0;

        // Set published_at date if published
        if ($this->data['is_published']) {
            $this->data['published_at'] = date('Y-m-d H:i:s');
        }

        if (!$this->productModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->productModel->errors());
        }

        return redirect()->to('admin/products')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $this->data['product'] = $this->productModel->find($id);

        if (!$this->data['product']) {
            return redirect()->to('admin/products')
                ->with('error', 'Product not found');
        }

        $this->data['categories'] = $this->categoryModel->getAllCategories();
        return view('admin/products/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/products', $newName);
            $this->data['image'] = $newName;
        }

        // Set default values for checkboxes if not provided
        $this->data['is_active'] = $this->request->getPost('is_active') ? 1 : 0;
        $this->data['is_published'] = $this->request->getPost('is_published') ? 1 : 0;
        $this->data['is_featured'] = $this->request->getPost('is_featured') ? 1 : 0;

        // Set published_at date if published and not previously published
        $product = $this->productModel->find($id);
        if ($this->data['is_published'] && (!$product['is_published'] || !$product['published_at'])) {
            $this->data['published_at'] = date('Y-m-d H:i:s');
        }

        if (!$this->productModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->productModel->errors());
        }

        return redirect()->to('admin/products')
            ->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('admin/products')
            ->with('success', 'Product deleted successfully');
    }

    public function toggleActive($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('admin/products')->with('error', 'Product not found');
        }

        $newStatus = $product['is_active'] == 1 ? 0 : 1;
        $this->productModel->setActiveStatus($id, $newStatus);

        return redirect()->to('admin/products')
            ->with('success', 'Product status updated successfully');
    }

    public function togglePublished($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('admin/products')->with('error', 'Product not found');
        }

        $newStatus = $product['is_published'] == 1 ? 0 : 1;
        $this->productModel->setPublishedStatus($id, $newStatus);

        return redirect()->to('admin/products')
            ->with('success', 'Product publication status updated successfully');
    }

    public function toggleFeatured($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('admin/products')->with('error', 'Product not found');
        }

        $newStatus = $product['is_featured'] == 1 ? 0 : 1;
        $this->productModel->setFeaturedStatus($id, $newStatus);

        return redirect()->to('admin/products')
            ->with('success', 'Product featured status updated successfully');
    }
}
