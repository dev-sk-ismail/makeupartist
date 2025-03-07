<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;
use App\Models\ServicesModel;

class GalleryController extends BaseController
{
    protected $galleryModel;
    protected $servicesModel;
    protected $data = [];

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->servicesModel = new ServicesModel();
    }

    public function index()
    {
        $this->data['gallery'] = $this->galleryModel->getAllGalleryItems();
        return view('admin/gallery/index', $this->data);
    }

    public function create()
    {
        $this->data['services'] = $this->servicesModel->getMainCategories();
        return view('admin/gallery/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();
        
        // Set default values for checkboxes if not provided
        $this->data['is_active'] = $this->request->getPost('is_active') ? '1' : '0';
        $this->data['is_published'] = $this->request->getPost('is_published') ? '1' : '0';
        $this->data['is_featured'] = $this->request->getPost('is_featured') ? '1' : '0';
        
        // Handle file upload
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = time() . $file->getName();
            $file->move('./uploads/gallery', $newName);
            $this->data['file_path'] = $newName;
        }

        if (!$this->galleryModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->galleryModel->errors());
        }

        return redirect()->to('admin/gallery')
            ->with('success', 'Gallery item created successfully');
    }

    public function edit($id)
    {
        $this->data['gallery_item'] = $this->galleryModel->find($id);
        
        if (!$this->data['gallery_item']) {
            return redirect()->to('admin/gallery')
                ->with('error', 'Gallery item not found');
        }
        
        $this->data['services'] = $this->servicesModel->getMainCategories(); 
        return view('admin/gallery/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();
        
        // Set default values for checkboxes if not provided
        $this->data['is_active'] = $this->request->getPost('is_active') ? '1' : '0';
        $this->data['is_published'] = $this->request->getPost('is_published') ? '1' : '0';
        $this->data['is_featured'] = $this->request->getPost('is_featured') ? '1' : '0';
        
        // Handle file upload
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = time() . $file->getName();
            $file->move('./uploads/gallery', $newName);
            $this->data['file_path'] = $newName;
        }

        if (!$this->galleryModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->galleryModel->errors());
        }

        return redirect()->to('admin/gallery')
            ->with('success', 'Gallery item updated successfully');
    }

    public function delete($id)
    {
        $galleryItem = $this->galleryModel->find($id);
        
        if ($galleryItem) {
            // Delete the file if it exists
            $filePath = './uploads/gallery/' . $galleryItem['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $this->galleryModel->delete($id);
        }
        
        return redirect()->to('admin/gallery')
            ->with('success', 'Gallery item deleted successfully');
    }
}