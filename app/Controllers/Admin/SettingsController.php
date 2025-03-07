<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    protected $settingsModel;
    protected $data = [];

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
    }

    public function index()
    {
        $this->data['title'] = 'Settings Management';
        $this->data['settingsList'] = $this->settingsModel->getSettings();
        return view('admin/settings/index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Create New Setting';
        return view('admin/settings/form', $this->data);
    }

    public function store()
    {
        // Set validation rules for new record
        $this->settingsModel->setValidationRules(
            $this->settingsModel->fetchValidationRules()
        );

        if (!$this->settingsModel->insert($this->request->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->settingsModel->errors());
        }

        return redirect()->to('admin/settings')
            ->with('success', 'Setting created successfully');
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Setting';
        $this->data['setting'] = $this->settingsModel->find($id);

        if (empty($this->data['setting'])) {
            return redirect()->to('admin/settings')
                ->with('error', 'Setting not found');
        }

        return view('admin/settings/form', $this->data);
    }

    public function update($id)
    {
        // Set validation rules for update
        $this->settingsModel->setValidationRules(
            $this->settingsModel->fetchValidationRules($id)
        );

        // Get existing record
        $existing = $this->settingsModel->find($id);
        if (!$existing) {
            return redirect()->to('admin/settings')
                ->with('error', 'Setting not found');
        }

        // Prepare update data
        $this->data = $this->request->getPost();

        // Ensure key remains unchanged
        $this->data['key'] = $existing['key'];

        if (!$this->settingsModel->update($id, $this->data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->settingsModel->errors());
        }

        return redirect()->to('admin/settings')
            ->with('success', 'Setting updated successfully');
    }
}
