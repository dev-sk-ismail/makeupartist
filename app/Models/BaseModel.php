<?php 

namespace app\Models;
use CodeIgniter\Model;

class BaseModel extends Model{
    protected $db;
    protected $useTimestamps = true;  // Enable timestamps for all models
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function __construct()
    {
        parent :: __construct();
        $this->db = \Config\Database::connect();
    }
}