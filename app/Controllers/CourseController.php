<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\CourseSyllabusModel;
use App\Models\CourseBatchModel;

class CourseController extends BaseController
{
    protected $courseModel;
    protected $syllabusModel;
    protected $batchModel;
    protected $data = [];

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->syllabusModel = new CourseSyllabusModel();
        $this->batchModel = new CourseBatchModel();
    }

    // Display all courses (course listing page)
    public function index()
    {
        $this->data['courses'] = $this->courseModel->getAllCourses();
        
        // Calculate discounted prices
        foreach ($this->data['courses'] as &$course) {
            $course['discounted_price'] = $this->courseModel->getDiscountedPrice($course);
        }
        
        return view('courses/index', $this->data);
    }

    // Display course details by slug
    public function detail($slug)
    {
        // Get course by slug
        $course = $this->courseModel->getCourseBySlug($slug);
        
        if (!$course) {
            return redirect()->to('courses')
                ->with('error', 'Course not found');
        }
        
        // Get complete course details
        $this->data['course'] = $this->courseModel->getCourseWithDetails($course['id']);
        
        // Get published syllabus items only
        $this->data['syllabus'] = $this->syllabusModel->getSyllabusByCourseId($course['id'], true);
        
        // Calculate discounted price
        $this->data['discounted_price'] = $this->courseModel->getDiscountedPrice($course);
        
        // Format batch time
        if (!empty($this->data['course']['batch'])) {
            $this->data['batch_time'] = $this->batchModel->formatBatchTime($this->data['course']['batch']);
        }
        
        return view('courses/detail', $this->data);
    }
}