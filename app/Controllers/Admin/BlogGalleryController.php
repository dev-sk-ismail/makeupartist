<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\BlogGalleryModel;

class BlogGalleryController extends BaseController
{
    protected $blogModel;
    protected $blogGalleryModel;
    protected $data = [];

    public function __construct()
    {
        $this->blogModel = new BlogModel();
        $this->blogGalleryModel = new BlogGalleryModel();
    }

    public function index()
    {
        $blogId = $this->request->getGet('blog_id');

        if (!$blogId) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Blog ID is required');
        }

        $blog = $this->blogModel->find($blogId);

        if (!$blog) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Blog not found');
        }

        $this->data['blog'] = $blog;
        $this->data['gallery'] = $this->blogGalleryModel->getGalleryByBlogId($blogId);

        return view('admin/blog_gallery/index', $this->data);
    }

    public function create()
    {
        $blogId = $this->request->getGet('blog_id');

        if (!$blogId) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Blog ID is required');
        }

        $blog = $this->blogModel->find($blogId);

        if (!$blog) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Blog not found');
        }

        $this->data['blog'] = $blog;

        return view('admin/blog_gallery/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $img = $this->request->getFile('img');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = time() . $img->getName();
            $img->move('./uploads/blogs', $newName);
            $this->data['img_path'] = $newName;
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid image');
        }

        // Set is_published to 0 if not provided
        if (!isset($this->data['is_published'])) {
            $this->data['is_published'] = 0;
        }

        // Set default order if not provided
        if (empty($this->data['order'])) {
            $this->data['order'] = 0;
        }

        if (!$this->blogGalleryModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->blogGalleryModel->errors());
        }

        return redirect()->to('admin/blog_gallery?blog_id=' . $this->data['blog_id'])
            ->with('success', 'Image added successfully');
    }

    public function edit($id)
    {
        $this->data['image'] = $this->blogGalleryModel->find($id);

        if (!$this->data['image']) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Image not found');
        }

        $this->data['blog'] = $this->blogModel->find($this->data['image']['blog_id']);

        return view('admin/blog_gallery/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $img = $this->request->getFile('img');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = time() . $img->getName();
            $img->move('./uploads/blogs', $newName);
            $this->data['img_path'] = $newName;

            // Delete old image if exists
            $oldImage = $this->blogGalleryModel->find($id);
            if ($oldImage && !empty($oldImage['img_path'])) {
                $oldImagePath = './uploads/blogs/' . $oldImage['img_path'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Set is_published to 0 if not provided
        if (!isset($this->data['is_published'])) {
            $this->data['is_published'] = 0;
        }

        if (!$this->blogGalleryModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->blogGalleryModel->errors());
        }

        return redirect()->to('admin/blog_gallery?blog_id=' . $this->data['blog_id'])
            ->with('success', 'Image updated successfully');
    }

    public function delete($id)
    {
        $image = $this->blogGalleryModel->find($id);

        if (!$image) {
            return redirect()->to('admin/blogs')
                ->with('error', 'Image not found');
        }

        $blogId = $image['blog_id'];

        // Delete image file
        if (!empty($image['img_path'])) {
            $imagePath = './uploads/blogs/' . $image['img_path'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->blogGalleryModel->delete($id);

        return redirect()->to('admin/blog_gallery?blog_id=' . $blogId)
            ->with('success', 'Image deleted successfully');
    }
}
