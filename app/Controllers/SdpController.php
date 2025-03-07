<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\VariantsModel;
use App\Models\BookingsModel;
use Config\Email;

class SdpController extends BaseController
{
    protected $servicesModel;
    protected $variantsModel;
    protected $bookingsModel;
    protected $email;

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
        $this->variantsModel = new VariantsModel();
        $this->bookingsModel = new BookingsModel();
        $this->email = \Config\Services::email();
    }

    public function sdp($slug = null)
    {
        $data = $this->data;
        $service = $this->servicesModel->getServiceBySlug($slug);
        $data['service'] = count($service) ? $service[0] : [];
        $serviceId = $data['service']['id'];
        $variants = $this->variantsModel->getVariantsByService($serviceId);
        $data['variants'] = count($variants) ? $variants : [];
        return view('sdp', $data);
    }


    public function services(): string
    {
        return view('services', $this->data);
    }

    public function servicesSingle(): string
    {
        return view('services-single', $this->data);
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

        // Send email to client
        $this->sendEmailToClient($data['client_email'], $data);

        // Send email to admin
        $this->sendEmailToAdmin($data);

        return redirect()->to($srcUrl)->with('success', 'Your booking has been received. We will update you soon.<br>Thank you.');
    }

    private function sendEmailToClient($clientEmail, $data)
    {
        $email = \Config\Services::email();
        $email->setTo($clientEmail);
        $email->setFrom('dev.sk.ismail@gmail.com', 'Makeup Artist Hena');
        $email->setSubject('Booking Confirmation');
        $email->setMessage('Dear ' . $data['client_name'] . ',<br>Your booking has been received. We will update you soon.<br>Thank you.');

        if (!$email->send()) {
            log_message('error', 'Email to client could not be sent. Error: ' . $email->printDebugger(['headers']));
        }
    }

    private function sendEmailToAdmin($data)
    {
        $email = \Config\Services::email();
        $email->setTo('rahamanzajibar@gmail.com');  // Replace with admin email
        $email->setFrom('dev.sk.ismail@gmail.com', 'Makeup Artist Hena');
        $email->setSubject('New Booking Received');
        $serviceName = $this->servicesModel->getServiceById($data['service_id'])['name'];
        $variantName = $this->variantsModel->getVariantById($data['variant_id'])['name'];
        $email->setMessage('A new booking has been made with the following details:<br>
        Service Name: ' . $serviceName . '<br>
        Variant Name: ' . $variantName . '<br>
        Client Name: ' . $data['client_name'] . '<br>
        Phone Number: ' . $data['client_phn'] . '<br>
        Email: ' . $data['client_email'] . '<br>
        Booking Date: ' . $data['booking_date'] . '<br>
        Booking Time: ' . $data['booking_hr'] . '<br>
        Remarks: ' . $data['remarks'] . '<br>
        Status: ' . $data['status'] . '<br>
        Payment Status: ' . $data['payment_status']);

        if (!$email->send()) {
            log_message('error', 'Email to admin could not be sent. Error: ' . $email->printDebugger(['headers']));
        }
    }
}
