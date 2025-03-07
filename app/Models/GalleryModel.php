<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'description', 
        'file_path', 
        'service_id', 
        'type', 
        'is_active', 
        'is_published', 
        'is_featured', 
        'display_order'
    ];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'service_id' => 'required|numeric',
        'type' => 'required|in_list[image,video]',
        'file_path' => 'required|max_length[255]',
        'display_order' => 'permit_empty|numeric',
        'is_active' => 'permit_empty',
        'is_published' => 'permit_empty',
        'is_featured' => 'permit_empty'
    ];

    // Get all gallery items with their service names
    public function getAllGalleryItems()
    {
        return $this->select('gallery.*, services.name as service_name')
            ->join('services', 'gallery.service_id = services.id', 'left')
            ->findAll();
    }

    // Get gallery items by service ID
    public function getGalleryByServiceId($serviceId)
    {
        return $this->where('service_id', $serviceId)
            ->findAll();
    }

    // Get featured gallery items
    public function getFeaturedItems()
    {
        return $this->where('is_featured', 1)
            ->where('is_active', 1)
            ->where('is_published', 1)
            ->orderBy('display_order', 'ASC')
            ->findAll();
    }

    // Get gallery items by type (image or video)
    public function getItemsByType($type)
    {
        return $this->where('type', $type)
            ->where('is_active', 1)
            ->where('is_published', 1)
            ->orderBy('display_order', 'ASC')
            ->findAll();
    }

    // Get gallery item details by ID
    public function getGalleryItemById($id)
    {
        return $this->find($id);
    }
}