<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'quantity_sold', 'unit_price', 'total_price', 'cash_received', 'change', 'customer_name', 'sold_at'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getSales($limit = null)
    {
        $builder = $this->select('sales.*, products.product_name')
                    ->join('products', 'products.id = sales.product_id')
                    ->orderBy('sold_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }
    
    public function getTodaySales()
    {
        return $this->select('sales.*, products.product_name')
                    ->join('products', 'products.id = sales.product_id')
                    ->where('DATE(sold_at)', date('Y-m-d'))
                    ->orderBy('sold_at', 'DESC')
                    ->findAll();
    }
    
    public function getDailySalesSummary($days = 7)
    {
        $builder = $this->select('DATE(sold_at) as date, COUNT(*) as total_sales, SUM(total_price) as total_revenue')
                    ->where('sold_at >=', date('Y-m-d', strtotime("-$days days")))
                    ->groupBy('DATE(sold_at)')
                    ->orderBy('date', 'ASC');
        
        return $builder->findAll();
    }
    
    public function getTopProducts($limit = 5)
    {
        return $this->select('products.product_name, SUM(sales.quantity_sold) as total_sold, SUM(sales.total_price) as total_revenue')
                    ->join('products', 'products.id = sales.product_id')
                    ->groupBy('product_id')
                    ->orderBy('total_sold', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
