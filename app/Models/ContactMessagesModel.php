<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessagesModel extends Model
{
    protected $table = 'contact_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'sub', 'msg', 'email', 'phone', 'is_read','is_responded', 'updated_by'];
    
    // Validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
        'email' => 'permit_empty|valid_email|max_length[255]',
        'msg' => 'required',
        'phone' => 'required|max_length[15]',
        'sub' => 'permit_empty|max_length[255]',
    ];
    
    // Get all messages with pagination
    public function getMessages($limit = 10, $offset = 0)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }
    
    // Count total messages
    public function countAllMessages()
    {
        return $this->countAllResults();
    }
    
    // Filter messages by status
    public function getUnreadMessages()
    {
        return $this->where('is_read', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    
    // Count messages by status
    public function countUnreadMessages()
    {
        return $this->where('is_read', 0)
                    ->countAllResults();
    }
    
    // Update message status
    // Set is_read status
    public function setReadStatus($id, $status)
    {
        return $this->update($id, ['is_read' => $status]);
    }

     // Set is_resonded status
    public function setRespondedStatus($id, $status)
    {
        return $this->update($id, ['is_responded' => $status]);
    }
    
    // Get message by ID
    public function getMessageById($id)
    {
        return $this->find($id);
    }

    
}

