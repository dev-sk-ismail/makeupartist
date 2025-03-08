<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\CourseBatchModel;
use App\Models\CourseDayModel;
use App\Models\DayModel;

helper('text');

class CourseController extends BaseController
{
    protected $courseModel;
    protected $batchModel;
    protected $dayModel;
    protected $courseDayModel;
    protected $data = [];

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->batchModel = new CourseBatchModel();
        $this->dayModel = new DayModel();
        $this->courseDayModel = new CourseDayModel();
    }

    public function index()
    {
        $this->data['courses'] = $this->courseModel->getAllCourses();
        // Calculate discounted prices
        foreach ($this->data['courses'] as &$course) {
            $course['discounted_price'] = $this->courseModel->getDiscountedPrice($course);
        }
        return view('admin/courses/index', $this->data);
    }

    public function create()
    {
        $this->data['batches'] = $this->batchModel->getAllBatches();
        $this->data['days'] = $this->dayModel->getActiveDays();
        return view('admin/courses/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/courses', $newName);
            $this->data['image'] = $newName;
        }

        // Generate slug from title
        if (!empty($this->data['name'])) {
            $this->data['slug'] = slugify($this->data['name']);
        }

        // Insert course
        $courseId = $this->courseModel->insert($this->data);

        if (!$courseId) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->courseModel->errors());
        }

        // Handle course days
        $this->saveDays($courseId, $this->request->getPost('days'));

        return redirect()->to('admin/courses')
            ->with('success', 'Course created successfully');
    }

    public function edit($id)
    {
        $this->data['course'] = $this->courseModel->find($id);

        if (!$this->data['course']) {
            return redirect()->to('admin/courses')
                ->with('error', 'Course not found');
        }

        $this->data['batches'] = $this->batchModel->getAllBatches();
        $this->data['days'] = $this->dayModel->getActiveDays();
        $this->data['selectedDays'] = $this->courseDayModel->where('course_id', $id)
            ->findAll();

        // Convert to simpler array of day_ids
        $selectedDayIds = [];
        foreach ($this->data['selectedDays'] as $day) {
            $selectedDayIds[] = $day['day_id'];
        }
        $this->data['selectedDayIds'] = $selectedDayIds;

        return view('admin/courses/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = time() . $image->getName();
            $image->move('./uploads/courses', $newName);
            $this->data['image'] = $newName;
        }

        // Generate slug from title
        if (!empty($this->data['name'])) {
            $this->data['slug'] = slugify($this->data['name']);
        }

        // Update course
        if (!$this->courseModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->courseModel->errors());
        }

        // Update course days
        $this->courseDayModel->deleteCourseDays($id);
        $this->saveDays($id, $this->request->getPost('days'));

        return redirect()->to('admin/courses')
            ->with('success', 'Course updated successfully');
    }

    public function delete($id)
    {
        // Delete course days first
        $this->courseDayModel->deleteCourseDays($id);

        // Delete course
        $this->courseModel->delete($id);

        return redirect()->to('admin/courses')
            ->with('success', 'Course deleted successfully');
    }

    // Helper method to save course days
    private function saveDays($courseId, $dayIds)
    {
        if (!empty($dayIds)) {
            foreach ($dayIds as $dayId) {
                $this->courseDayModel->insert([
                    'course_id' => $courseId,
                    'day_id' => $dayId
                ]);
            }
        }
    }
}
