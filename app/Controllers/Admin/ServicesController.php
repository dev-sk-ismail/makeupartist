<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServicesModel;

class ServicesController extends BaseController
{
    protected $servicesModel;
    protected $data = [];

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }

    public function index()
    {
        $this->data['services'] = $this->servicesModel->getAllServices();
        return view('admin/services/index', $this->data);
    }

    public function create()
    {
        $this->data['mainServices'] = $this->servicesModel->getMainServices();
        return view('admin/services/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $img = $this->request->getFile('img');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = time() . $img->getName();
            $img->move('./uploads/services', $newName);
            $this->data['img'] = $newName;
        }

        if (!$this->servicesModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->servicesModel->errors());
        }

        return redirect()->to('admin/services')
            ->with('success', 'Service created successfully');
    }

    public function edit($id)
    {
        $this->data['service'] = $this->servicesModel->find($id);

        if (!$this->data['service']) {
            return redirect()->to('admin/services')
                ->with('error', 'Service not found');
        }

        $this->data['mainServices'] = $this->servicesModel->getMainServices();
        return view('admin/services/form', $this->data);
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Handle image upload
        $img = $this->request->getFile('img');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = time() . $img->getName();
            $img->move('./uploads/services', $newName);
            $this->data['img'] = $newName;
        }

        if (!$this->servicesModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->servicesModel->errors());
        }

        return redirect()->to('admin/services')
            ->with('success', 'Service updated successfully');
    }

    public function delete($id)
    {
        $this->servicesModel->delete($id);
        return redirect()->to('admin/services')
            ->with('success', 'Service deleted successfully');
    }
}
