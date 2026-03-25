<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'is_active'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getStaff(string $username)
    {
        return $this->where('username', $username)->first();
    }

    public function getAllStaff()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }
}
