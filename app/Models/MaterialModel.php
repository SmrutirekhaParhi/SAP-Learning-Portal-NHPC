<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'topic_id', 'title', 'file_path', 'file_type',
        'status', 'uploaded_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'uploaded_at'; // only on insert
    protected $updatedField  = 'updated_at';  // only when you set it

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
        'topic_id' => 'required|integer|is_not_unique[topics.id]',
        'title' => 'required|min_length[3]|max_length[255]',
        'file_path' => 'required', // allow any file path
        'file_type' => 'required' // allow any detected type
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
