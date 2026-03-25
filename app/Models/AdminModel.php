<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'is_active'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getAdmin($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getAllAdmins()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }
}
