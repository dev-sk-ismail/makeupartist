<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CourseBatchModel;

class CourseBatchController extends BaseController
{
    protected $batchModel;
    protected $data = [];

    public function __construct()
    {
        $this->batchModel = new CourseBatchModel();
    }

    public function index()
    {
        $this->data['batches'] = $this->batchModel->getAllBatches();
        return view('admin/courses/batches/index', $this->data);
    }

    public function create()
    {
        return view('admin/courses/batches/form', $this->data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        
        if (!$this->batchModel->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->batchModel->errors());
        }
        
        return redirect()->to('admin/courses/batches')
            ->with('success', 'Batch created successfully');
    }

    public function edit($id)
    {
        $this->data['batch'] = $this->batchModel->find($id);
        
        if (!$this->data['batch']) {
            return redirect()->to('admin/courses/batches')
                ->with('error', 'Batch not found');
        }
        
        return view('admin/courses/batches/form', $this->data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        
        if (!$this->batchModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->batchModel->errors());
        }
        
        return redirect()->to('admin/courses/batches')
            ->with('success', 'Batch updated successfully');
    }

    public function delete($id)
    {
        $this->batchModel->delete($id);
        
        return redirect()->to('admin/courses/batches')
            ->with('success', 'Batch deleted successfully');
    }
}