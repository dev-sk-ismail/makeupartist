<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'title', 'slug', 'description', 'image', 'status', 'published_date', 'author', 'updated_by'];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'title' => 'required|min_length[2]|max_length[255]',
        'description' => 'permit_empty',
        'image' => 'permit_empty|max_length[255]',
        'status' => 'required|in_list[draft,published,archived]',
        'author' => 'required|min_length[2]|max_length[255]'
    ];
 
    // Get all blogs with additional info
    public function getAllBlogs()
    {
        return $this->findAll();
    }

    // Get published blogs
    public function getPublishedBlogs()
    {
        return $this->where('status', 'published')
            ->where('published_date <=', date('Y-m-d H:i:s'))
            ->orderBy('published_date', 'desc')
            ->findAll();
    }

    // Auto-generate slug before insert/update
    protected function beforeInsert(array $data)
    {
        $data['data']['slug'] = url_title($data['data']['title'], '-', true);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['updated_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (isset($data['data']['title'])) {
            $data['data']['slug'] = url_title($data['data']['title'], '-', true);
        }

        $data['data']['updated_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    // Get blog by ID
    public function getBlogById($id)
    {
        return $this->find($id);
    }

    // Get blog by slug
    public function getBlogBySlug($slug)
    {
        return $this->where('slug', $slug)
            ->first();
    }
}
