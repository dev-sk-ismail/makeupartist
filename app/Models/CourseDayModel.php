<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseDayModel extends Model
{
    protected $table = 'course_days';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_id', 'day_id'];

    // Validation rules
    protected $validationRules = [
        'course_id' => 'required|numeric',
        'day_id' => 'required|numeric'
    ];

    // Get days by course ID
    public function getDaysByCourseId($courseId)
    {
        return $this->where('course_id', $courseId)->findAll();
    }
    
    // Delete all days for a course
    public function deleteCourseDays($courseId)
    {
        return $this->where('course_id', $courseId)->delete();
    }
}