<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogGalleryModel extends Model
{
    protected $table = 'blog_gallery';
    protected $primaryKey = 'id';
    protected $allowedFields = ['blog_id', 'img_path', 'alt_text', 'is_published', 'order'];
    
    // Validation rules
    protected $validationRules = [
        'blog_id' => 'required|numeric|is_not_unique[blogs.id]',
        'img_path' => 'required|max_length[255]',
        'alt_text' => 'permit_empty|max_length[255]',
        'is_published' => 'permit_empty|in_list[0,1]',
        'order' => 'permit_empty|numeric'
    ];
    
    // Get images for a specific blog
    public function getGalleryByBlogId($blogId)
    {
        return $this->where('blog_id', $blogId)
                    ->orderBy('order', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }
    
    // Get published images for a specific blog
    public function getPublishedGalleryByBlogId($blogId)
    {
        return $this->where([
                'blog_id' => $blogId,
                'is_published' => 1
            ])
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
    
    // Set created_at timestamp on insert
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        
        return $data;
    }
}