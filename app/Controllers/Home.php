<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Controllers\BaseController;
use App\Models\GalleryModel;
use App\Models\ServicesModel;
use App\Models\BlogModel;
use App\Models\BlogGalleryModel;

class Home extends BaseController
{
    protected $galleryModel;
    protected $servicesModel;
    protected $blogModel;
    protected $blogGalleryModel;
    protected $data = [];

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->servicesModel = new ServicesModel();
        $this->blogModel = new BlogModel();
        $this->blogGalleryModel = new BlogGalleryModel();
    }

    public function index(): string
    {
        return view('index', $this->data);
    }

    public function about(): string
    {
        return view('about', $this->data);
    }

    public function gallery(): string
    {
        $this->data['gallery'] = $this->galleryModel->getAllGalleryItems();
        foreach($this->data['gallery'] as &$item) {
            $id = $item['service_id'];
            $item['service'] = $this->servicesModel->getServiceById($id);
        }
        return view('gallery', $this->data);
    }

    public function course(): string
    {
        return view('course', $this->data);
    }

    public function notFound(): string
    {
        return view('404', $this->data);
    }

    public function blogs(): string
    {
        $blogs = $this->blogModel->getPublishedBlogs();
        foreach ($blogs as &$post) {
            $postId = $post['id'];
            $post['gallery'] = $this->blogGalleryModel->getPublishedGalleryByBlogId($postId);
        }
        $this->data['blogs'] = $blogs;
        return view('blogs', $this->data);
    }

    public function blogPost($slug = null)
    {
        $blog = $this->blogModel->getBlogBySlug($slug);
        $this->data['blog'] = count($blog) ? $blog : [];
        $blogId = $this->data['blog']['id'];
        $blogGallery = $this->blogGalleryModel->getPublishedGalleryByBlogId($blogId);
        $this->data['blogGallery'] = count($blogGallery) ? $blogGallery : [];
        return view('blog-post', $this->data);
    }


    public function contact(): string
    {
        return view('contact', $this->data);
    }
}
