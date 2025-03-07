<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\CourseSyllabusModel;

class CourseSyllabusController extends BaseController
{
    protected $courseModel;
    protected $syllabusModel;
    protected $data = [];

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->syllabusModel = new CourseSyllabusModel();
    }

    public function index($courseId = null)
    {
        $course = $this->courseModel->find($courseId);
        
        if (!$course) {
            return redirect()->to('admin/courses')
                ->with('error', 'Course not found');
        }
        
        $this->data['course'] = $course;
        $this->data['syllabus'] = $this->syllabusModel->getSyllabusByCourseId($courseId);
        
        return view('admin/courses/syllabus/index', $this->data);
    }

    public function create($courseId)
    {
        $course = $this->courseModel->find($courseId);
        
        if (!$course) {
            return redirect()->to('admin/courses')
                ->with('error', 'Course not found');
        }
        
        $this->data['course'] = $course;
        
        return view('admin/courses/syllabus/form', $this->data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        
        // Set default for is_published if not provided
        if (!isset($data['is_published'])) {
            $data['is_published'] = 0;
        }
        
        if (!$this->syllabusModel->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->syllabusModel->errors());
        }
        
        return redirect()->to('admin/courses/syllabus/' . $data['course_id'])
            ->with('success', 'Syllabus item added successfully');
    }

    public function edit($id)
    {
        $syllabusItem = $this->syllabusModel->find($id);
        
        if (!$syllabusItem) {
            return redirect()->to('admin/courses')
                ->with('error', 'Syllabus item not found');
        }
        
        $this->data['syllabusItem'] = $syllabusItem;
        $this->data['course'] = $this->courseModel->find($syllabusItem['course_id']);
        
        return view('admin/courses/syllabus/form', $this->data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        
        // Set default for is_published if not provided
        if (!isset($data['is_published'])) {
            $data['is_published'] = 0;
        }
        
        $syllabusItem = $this->syllabusModel->find($id);
        
        if (!$syllabusItem) {
            return redirect()->to('admin/courses')
                ->with('error', 'Syllabus item not found');
        }
        
        if (!$this->syllabusModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->syllabusModel->errors());
        }
        
        return redirect()->to('admin/courses/syllabus/' . $data['course_id'])
            ->with('success', 'Syllabus item updated successfully');
    }

    public function delete($id)
    {
        $syllabusItem = $this->syllabusModel->find($id);
        
        if (!$syllabusItem) {
            return redirect()->to('admin/courses')
                ->with('error', 'Syllabus item not found');
        }
        
        $courseId = $syllabusItem['course_id'];
        $this->syllabusModel->delete($id);
        
        return redirect()->to('admin/courses/syllabus/' . $courseId)
            ->with('success', 'Syllabus item deleted successfully');
    }
}