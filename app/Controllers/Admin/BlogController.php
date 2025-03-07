<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;

helper('text');

class BlogController extends BaseController
{
    protected $blogModel;
    protected $data = [];

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    public function index()
    {

        $this->data['blogs'] = $this->blogModel->getAllBlogs();
        return view('admin/blogs/index', $this->data);
    }

    public function create()
    {
        return view('admin/blogs/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/blogs', $newName);
            $this->data['image'] = $newName;
        }

        // Generate slug from title
        if (!empty($this->data['title'])) {
            $this->data['slug'] = slugify($this->data['title']);
        }
        // Handle published date if status is published
        if ($this->data['status'] == 'published' && empty($this->data['published_date'])) {
            $this->data['published_date'] = date('Y-m-d H:i:s');
        }

        if (!$this->blogModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->blogModel->errors());
        }

        return redirect()->to('admin/blogs')
            ->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $this->data['blog'] = $this->blogModel->find($id);

        if (!$this->data['blog']) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Blog not found');
        }

        return view('admin/blogs/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/blogs', $newName);
            $this->data['image'] = $newName;
        }

        $session = \Config\Services::session();
        // Set updated_by for existing blogs
        $this->data['updated_by'] = $session->get('username'); // Assuming you have user authentication implemented

        // Handle published date if status changed to published
        if ($this->data['status'] == 'published' && empty($this->data['published_date'])) {
            $this->data['published_date'] = date('Y-m-d H:i:s');
        }

        if (!$this->blogModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->blogModel->errors());
        }

        return redirect()->to('admin/blogs')
            ->with('success', 'Blog updated successfully');
    }

    public function delete($id)
    {
        $this->blogModel->delete($id);

        return redirect()->to('admin/blogs')
            ->with('success', 'Blog deleted successfully');
    }
}
