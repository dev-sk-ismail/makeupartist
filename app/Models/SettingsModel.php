<?php

namespace App\Models;

class SettingsModel extends BaseModel
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'val'];
    
    public function fetchValidationRules($id = null)
    {
        if ($id) {
            // For updates - exclude current record from unique check
            return [
                'key' => "required|min_length[3]|max_length[255]",
                'val' => 'required'
            ];
        }
        
        // For new records
        return [
            'key' => 'required|min_length[3]|max_length[255]|is_unique[settings.key]',
            'val' => 'required'
        ];
    }

    protected $validationMessages = [
        'key' => [
            'required' => 'Settings key is required',
            'min_length' => 'Settings key must be at least 3 characters long',
            'max_length' => 'Settings key cannot exceed 255 characters',
            'is_unique' => 'This settings key already exists'
        ],
        'val' => [
            'required' => 'Settings value is required'
        ]
    ];

    public function getSettings($limit = '', $offset = 0)
    {
        if($limit)
            return $this->findAll($limit, $offset);
        else
            return $this->findAll();
    }

    public function getAllSettings(): array
    {
        $settings = $this->findAll();
        $transformed = [];
        
        foreach ($settings as $setting) {
            $transformed[$setting['key']] = $setting['val'];
        }
        
        return $transformed;
    }

    public function getSettingByKey(string $key)
    {
        return $this->where('key', $key)->first();
    }

    public function updateSetting(string $key, $value): bool
    {
        $existing = $this->where('key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], ['val' => $value]);
        }

        return $this->insert(['key' => $key, 'val' => $value]) ? true : false;
    }
}