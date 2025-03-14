<?php

namespace App\Controllers;

use App\Models\ContactMessagesModel;

class ContactController extends BaseController
{
    protected $contactModel;
    protected $email;
    protected $data = [];

    public function __construct()
    {
        $this->contactModel = new ContactMessagesModel();
        $this->email = \Config\Services::email();
    }

    public function contact(): string
    {
        return view('contact', $this->data);
    }

    public function submit()
    {
        // Get all form data at once
        $data = $this->request->getPost();

        // Set the status manually as it's not part of the form
        $data['is_read'] = '0';
        $data['is_responded'] = '0';

        if (!$this->contactModel->insert($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->contactModel->errors()
            ])->setStatusCode(400);
        }


        // Send email to admin
        $this->sendEmailToAdmin($data);

        return redirect()->to('contact')->with('success', 'We have received your message. We will get back to you soon.<br>Thank you.');
    }


    private function sendEmailToAdmin($data)
    {   
        $email = \Config\Services::email();
        $email->setTo('apanismail307@gmail.com');  // Replace with admin email
        $email->setFrom(config('Email')->fromEmail, config('Email')->fromName);
        $email->setSubject('New contact message Received');
        $email->setMessage('A new contact message has been made with the following details:<br>
        User Name: ' . $data['name']. '<br>
        Subject: ' . $data['sub'] . '<br>
        Message: ' . $data['msg'] . '<br>
        Phone Number: ' . $data['phone'] . '<br>
        Email: ' . $data['email']);

        if (!$email->send()) {
            log_message('error', 'Email to admin could not be sent. Error: ' . $email->printDebugger(['headers']));
        }
    }
}
