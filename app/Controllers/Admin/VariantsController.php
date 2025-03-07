<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VariantsModel;
use App\Models\ServicesModel;

class VariantsController extends BaseController
{
    protected $variantsModel;
    protected $servicesModel;
    protected $perPage = 10;
    protected $data = [];

    public function __construct()
    {
        $this->variantsModel = new VariantsModel();
        $this->servicesModel = new ServicesModel();
    }

    public function index()
    {
        $this->data['search'] = $this->request->getGet('search');
        $this->data['serviceId'] = $this->request->getGet('service_id');
        $page = $this->request->getGet('page') ?? 1;

        $this->data['variants'] = $this->variantsModel->getFilteredVariants(
            $this->data['search'],
            $this->data['serviceId'],
            $this->perPage,
            $page
        );

        $this->data['pager'] = $this->variantsModel->pager;
        $this->data['services'] = $this->servicesModel->findAll();

        return view('admin/variants/index', $this->data);
    }

    public function create()
    {
        $this->data['services'] = $this->servicesModel->findAll();
        return view('admin/variants/form', $this->data);
    }

    public function store()
    {
        $this->data = $this->request->getPost();

        // Set default values and timestamps
        $this->data['created_by'] = session()->get('user_id');
        $this->data['is_active'] = $this->data['is_active'] ?? 0;
        $this->data['is_published'] = $this->data['is_published'] ?? 0;
        $this->data['published_at'] = $this->data['is_published'] ? date('Y-m-d H:i:s') : null;

        if (!$this->variantsModel->insert($this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->variantsModel->errors());
        }

        return redirect()->to('admin/variants')
            ->with('success', 'Variant created successfully');
    }

    public function update($id)
    {
        $this->data = $this->request->getPost();

        // Set updated_by and handle timestamps
        $this->data['updated_by'] = session()->get('user_id');
        $this->data['is_active'] = $this->data['is_active'] ?? 0;
        $this->data['is_published'] = $this->data['is_published'] ?? 0;
        $this->data['published_at'] = $this->data['is_published'] ? date('Y-m-d H:i:s') : null;

        if (!$this->variantsModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->variantsModel->errors());
        }

        return redirect()->to('admin/variants')
            ->with('success', 'Variant updated successfully');
    }

    public function edit($id)
    {
        $this->data['variant'] = $this->variantsModel->getVariantById($id);

        if (!$this->data['variant']) {
            return redirect()->to('admin/variants')
                ->with('error', 'Variant not found');
        }

        $this->data['services'] = $this->servicesModel->where('is_active', 1)->findAll();

        return view('admin/variants/form', $this->data);
    }

    public function delete($id)
    {
        // First, check if the variant exists
        $variant = $this->variantsModel->find($id);

        if (!$variant) {
            return redirect()->to('admin/variants')
                ->with('error', 'Variant not found');
        }

        try {
            // Attempt to delete
            if ($this->variantsModel->delete($id)) {
                return redirect()->to('admin/variants')
                    ->with('success', 'Variant deleted successfully');
            } else {
                return redirect()->to('admin/variants')
                    ->with('error', 'Failed to delete variant');
            }
        } catch (\Exception $e) {
            log_message('error', '[Variant Delete] Error: ' . $e->getMessage());
            return redirect()->to('admin/variants')
                ->with('error', 'An error occurred while deleting the variant');
        }
    }
}
