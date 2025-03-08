<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'slug', 'title', 'description', 'duration', 
        'fee', 'discount_type', 'discount_value', 'image', 'batch_id'
    ];

    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[255]',
        'title' => 'required|min_length[2]|max_length[255]',
        'duration' => 'required|min_length[2]|max_length[100]',
        'fee' => 'required|numeric',
        'discount_type' => 'permit_empty|in_list[%,fixed]',
        'discount_value' => 'permit_empty|numeric',
        'batch_id' => 'required|numeric',
        'image' => 'permit_empty|max_length[255]',
        'description' => 'permit_empty'
    ];

    // Get all courses with their batch details
    public function getAllCourses()
    {
        return $this->select('courses.*, course_batches.start_time, course_batches.end_time')
            ->join('course_batches', 'courses.batch_id = course_batches.id', 'left')
            ->findAll();
    }

    // Auto-generate slug before insert/update
    protected function beforeInsert(array $data)
    {
        $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (isset($data['data']['name'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }

    // Get Course details by ID
    public function getCourseById($id)
    {
        return $this->find($id);
    }

    // Get Course details by slug
    public function getCourseBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    // Get Course with all related data (syllabus, batch, days)
    public function getCourseWithDetails($id)
    {
        $course = $this->find($id);
        
        if (!$course) {
            return null;
        }

        // Get syllabus
        $syllabusModel = new CourseSyllabusModel();
        $course['syllabus'] = $syllabusModel->where('course_id', $id)->findAll();
        
        // Get batch details
        $batchModel = new CourseBatchModel();
        $course['batch'] = $batchModel->find($course['batch_id']);
        
        // Get days
        $db = \Config\Database::connect();
        $course['days'] = $db->table('course_days')
            ->select('days.day')
            ->join('days', 'course_days.day_id = days.id')
            ->where('course_days.course_id', $id)
            ->where('days.isactive', 1)
            ->get()
            ->getResultArray();
        
        return $course;
    }

    // Calculate discounted price
    public function getDiscountedPrice($course)
    {
        if (empty($course['discount_type']) || empty($course['discount_value'])) {
            return $course['fee'];
        }

        if ($course['discount_type'] == '%') {
            return $course['fee'] - ($course['fee'] * $course['discount_value'] / 100);
        } else { // fixed
            return $course['fee'] - $course['discount_value'];
        }
    }

    function formatDays($daysArray)
    {
        return implode(", ", array_map(fn($d) => substr($d["day"], 0, 3), $daysArray));
    }
}