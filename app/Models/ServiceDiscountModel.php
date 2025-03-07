<?php
namespace App\Models;

// Namespace declaration - This tells PHP where to find this class
// It follows PSR-4 autoloading standard and CodeIgniter's directory structure

// Importing the base Model class from CodeIgniter
// This gives us access to all the built-in database functionalit
// Our model class extends BaseModel class to inherit all its features
class ServiceDiscountModel extends BaseModel
{
    // Specifies which database table this model will interact with
    // Best practice: Use snake_case for table names
    protected $table = 'service_discount';
    
    // Specifies the primary key column of the table
    // This is used by many Model methods like find(), update(), delete()
    protected $primaryKey = 'id';
    
    // List of fields that can be mass-assigned
    // This is a security feature - only these fields can be filled using $model->save()
    // We don't include created_at/updated_at as they're handled automatically
    protected $allowedFields = [
        'service_id', 
        'discount_id', 
        'code', 
        'effective_from', 
        'effective_to'
    ];
    
    // Enable automatic timestamp management
    // When true, CodeIgniter will automatically fill created_at and updated_at
    protected $useTimestamps = true;
    
    // Specify which fields are for timestamps
    // These match our database column names
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation rules for our fields
    // These are applied automatically when calling $model->save()
    protected $validationRules = [
        // service_id rules:
        // - required: field must be present and not empty
        // - numeric: must be a valid number
        // - is_not_unique[services.id]: must exist in services table (foreign key check)
        'service_id' => 'required|numeric|is_not_unique[services.id]',
        
        // discount_id rules:
        // Similar to service_id, ensures the discount exists
        'discount_id' => 'required|numeric|is_not_unique[discounts.id]',
        
        // code rules:
        // - required: must be present
        // - min_length[3]: must be at least 3 characters
        // - max_length[50]: must not exceed 50 characters (matches DB column)
        // - is_unique[service_discount.code,id,{id}]: must be unique in the table
        //   The ",id,{id}" part allows updating a record without "unique" error
        'code' => 'required|min_length[3]|max_length[50]|is_unique[service_discount.code,id,{id}]',
        
        // effective_from rules:
        // - required: must be present
        // - valid_date: must be a valid date format
        'effective_from' => 'required|valid_date',
        
        // effective_to rules:
        // - permit_empty: can be null/empty
        // - valid_date: if provided, must be valid date
        // - greater_than_equal_to[effective_from]: must not be earlier than effective_from
        'effective_to' => 'permit_empty|valid_date|greater_than_equal_to[effective_from]'
    ];

    // Custom method to get discount details with related data
    // This shows how to create complex queries using CodeIgniter's Query Builder
    public function getWithDetails($id = null)
    {
        // Start building the query using Query Builder
        // $this->db->table() is preferred over direct queries for security
        $builder = $this->db->table($this->table)
            // Select specific fields, including ones from joined tables
            // Using aliases (as service_name, as discount_name) for clarity
            ->select('service_discount.*, services.name as service_name, discounts.name as discount_name')
            // Join with services table to get service names
            ->join('services', 'services.id = service_discount.service_id')
            // Join with discounts table to get discount names
            ->join('discounts', 'discounts.id = service_discount.discount_id');
        
        // If an ID is provided, add a where clause to get specific record
        if ($id !== null) {
            // getRowArray() returns a single row as an array
            return $builder->where('service_discount.id', $id)->get()->getRowArray();
        }
        
        // If no ID provided, get all records
        // getResultArray() returns multiple rows as array
        return $builder->get()->getResultArray();
    }
}