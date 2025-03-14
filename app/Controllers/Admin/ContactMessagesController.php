<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessagesModel;

class ContactMessagesController extends BaseController
{
    protected $contactMessagesModel;
    protected $data = [];
    protected $perPage = 10;

    public function __construct()
    {
        $this->contactMessagesModel = new ContactMessagesModel();
    }

    public function index()
    {
        // Get current page from the URL or use default
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        
        // Apply filters if any
        $readFilter = $this->request->getVar('read');
        $respondedFilter = $this->request->getVar('responded');
        
        // Start query
        $builder = $this->contactMessagesModel->builder();
        
        // Apply read filter
        if ($readFilter !== null) {
            $builder->where('is_read', $readFilter);
        }
        
        // Apply responded filter
        if ($respondedFilter !== null) {
            $builder->where('is_responded', $respondedFilter);
        }
        
        // Get total count for pagination
        $total = $builder->countAllResults(false);
        
        // Get paginated results
        $this->data['messages'] = $builder->orderBy('created_at', 'DESC')
                                        ->limit($this->perPage, ($page - 1) * $this->perPage)
                                        ->get()
                                        ->getResultArray();
        
        // Create pagination
        $pager = service('pager');
        $this->data['pager'] = $pager->makeLinks($page, $this->perPage, $total, 'default_full');
        $this->data['total'] = $total;
        
        // Pass filters to view
        $this->data['readFilter'] = $readFilter;
        $this->data['respondedFilter'] = $respondedFilter;
        
        return view('admin/messages/index', $this->data);
    }
    
    public function view($id)
    {
        $message = $this->contactMessagesModel->getMessageById($id);
        
        if (!$message) {
            return redirect()->to('admin/messages')->with('error', 'Message not found');
        }
        
        // Mark as read when viewing
        if (!$message['is_read']) {
            $this->contactMessagesModel->setReadStatus($id, 1);
            $message['is_read'] = 1;
        }
        
        $this->data['message'] = $message;
        return view('admin/messages/view', $this->data);
    }
    
    public function toggleRead($id)
    {
        $message = $this->contactMessagesModel->find($id);
        if (!$message) {
            return redirect()->to('admin/messages')->with('error', 'Message not found');
        }

        $newStatus = $message['is_read'] == 1 ? 0 : 1;
        $this->contactMessagesModel->setReadStatus($id, $newStatus);

        return redirect()->back()
            ->with('success', 'Message read status updated successfully');
    }
    
    public function toggleResponded($id)
    {
        $message = $this->contactMessagesModel->find($id);
        if (!$message) {
            return redirect()->to('admin/messages')->with('error', 'Message not found');
        }

        $newStatus = $message['is_responded'] == 1 ? 0 : 1;
        $this->contactMessagesModel->setRespondedStatus($id, $newStatus);
        $this->contactMessagesModel->update($id, ['updated_by' => session()->get('username')]);

        return redirect()->back()
            ->with('success', 'Message response status updated successfully');
    }
    
    public function clearFilters()
    {
        return redirect()->to('admin/messages');
    }
}