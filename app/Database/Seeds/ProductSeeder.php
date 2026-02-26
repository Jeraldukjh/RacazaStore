<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'product_name' => 'Youngstown Sardines (155g)',
                'price' => 28.00,
                'quantity' => 24,
                'expiry_date' => date('Y-m-d', strtotime('+120 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'product_name' => 'Lucky Me Pancit Canton (Chilimansi)',
                'price' => 18.00,
                'quantity' => 60,
                'expiry_date' => date('Y-m-d', strtotime('+90 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'product_name' => 'Nescafe 3-in-1 (Original) Sachet',
                'price' => 12.00,
                'quantity' => 100,
                'expiry_date' => date('Y-m-d', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'product_name' => 'Kopiko Brown Twin Sachet',
                'price' => 14.00,
                'quantity' => 80,
                'expiry_date' => date('Y-m-d', strtotime('+150 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}
