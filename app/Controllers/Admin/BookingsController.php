<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingsModel;
use App\Models\ServicesModel;
use App\Models\VariantsModel;

class BookingsController extends BaseController
{
    protected $bookingsModel;
    protected $servicesModel;
    protected $variantsModel;
    protected $data = [];

    public function __construct()
    {
        $this->bookingsModel = new BookingsModel();
        $this->servicesModel = new ServicesModel();
        $this->variantsModel = new VariantsModel();
    }

    public function index()
    {
        $this->data['bookings'] = $this->bookingsModel->getAllBookings();
        return view('admin/bookings/index', $this->data);
    }

    public function create()
    {
        $this->data['services'] = $this->servicesModel->findAll();
        $this->data['variants'] = [];
        return view('admin/bookings/form', $this->data);
    }

    public function store()
    {
        $data = $this->request->getPost();

        $data['status'] = 'pending';
        $data['payment_status'] = 'unpaid';
        $data['updated_by'] = session()->get('user_id') ?? 1;

        if (!$this->bookingsModel->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->bookingsModel->errors());
        }

        return redirect()->to('admin/bookings')
            ->with('success', 'Booking created successfully');
    }

    public function edit($id)
    {
        $this->data['booking'] = $this->bookingsModel->find($id);

        if (!$this->data['booking']) {
            return redirect()->to('admin/bookings')
                ->with('error', 'Booking not found');
        }

        $this->data['services'] = $this->servicesModel->findAll();
        $this->data['variants'] = $this->variantsModel->where('service_id', $this->data['booking']['service_id'])->findAll();

        return view('admin/bookings/form', $this->data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['updated_by'] = session()->get('user_id') ?? 1;

        if (!$this->bookingsModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->bookingsModel->errors());
        }

        return redirect()->to('admin/bookings')
            ->with('success', 'Booking updated successfully');
    }

    public function delete($id)
    {
        $this->bookingsModel->delete($id);
        return redirect()->to('admin/bookings')
            ->with('success', 'Booking deleted successfully');
    }

    public function getVariants()
    {
        $serviceId = $this->request->getGet('service_id');

        if (!$serviceId) {
            return $this->response->setJSON([]);
        }
    
        // Fetch variants for the selected service
        $variants = $this->variantsModel->getVariantsByService($serviceId);

        if (!$variants) {
            return $this->response->setJSON([]);
        }
    
        return $this->response->setJSON($variants);
    }

    public function getAvailableHours()
    {
        $date = $this->request->getGet('date');
        $serviceId = $this->request->getGet('service_id');

        $this->data['availableHours'] = $this->bookingsModel->getAvailableHours($date, $serviceId);
        return $this->response->setJSON($this->data['availableHours']);
    }

    public function updateStatus($id)
    {
        $this->data['status'] = $this->request->getPost('status');
        $this->data['payment_status'] = $this->request->getPost('payment_status');

        $updateData = [
            'status' => $this->data['status'],
            'payment_status' => $this->data['payment_status'],
            'updated_by' => session()->get('user_id') ?? 1
        ];

        $this->bookingsModel->update($id, $updateData);
        return redirect()->to('admin/bookings')
            ->with('success', 'Booking status updated successfully');
    }

    public function apiBooking()
    {
        $data = $this->request->getPost();

        // Set default values
        $data['status'] = 'pending';
        $data['payment_status'] = 'unpaid';
        $srcUrl = $data['src_url'];
        if (!$this->bookingsModel->insert($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->bookingsModel->errors()
            ])->setStatusCode(400);
        }

        return redirect()->to($srcUrl)->with('success', 'Booking submitted successfully.We will update soon.');
    }
}
