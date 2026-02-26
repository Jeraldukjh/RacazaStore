<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_name', 'price', 'quantity', 'expiry_date'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getProducts()
    {
        return $this->findAll();
    }
    
    public function getProduct($id)
    {
        return $this->find($id);
    }
}
