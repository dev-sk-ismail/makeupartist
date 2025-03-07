<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseSyllabusModel extends Model
{
    protected $table = 'course_syllabus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_id', 'item', 'description', 'is_published'];

    // Validation rules
    protected $validationRules = [
        'course_id' => 'required|numeric',
        'item' => 'required|min_length[2]|max_length[255]',
        'is_published' => 'permit_empty'
    ];

    // Get syllabus by course ID
    public function getSyllabusByCourseId($courseId, $publishedOnly = false)
    {
        $query = $this->where('course_id', $courseId);
        
        if ($publishedOnly) {
            $query = $query->where('is_published', 1);
        }
        
        return $query->findAll();
    }
}