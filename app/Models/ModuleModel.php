<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    protected $beforeDelete = ['markStatusDeleted'];

    protected function markStatusDeleted(array $data)
    {
        if (isset($data['id'])) {
            $this->whereIn($this->primaryKey, (array)$data['id'])
                 ->set(['status' => 'deleted'])
                 ->update();
        }
        return $data;
    }

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]|is_unique[modules.name,id,{id}]'
    ];

        // Add to each model
    protected $beforeInsert = ['sanitizeData'];
    protected $beforeUpdate = ['sanitizeData'];

    protected function sanitizeData(array $data)
    {
        if (isset($data['data'])) {
            foreach ($data['data'] as $key => $value) {
                if (is_string($value)) {
                    $data['data'][$key] = trim(strip_tags($value));
                }
            }
        }
        return $data;
    }
}
