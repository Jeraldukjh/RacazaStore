<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;

class Pos extends BaseController
{
    public function __construct()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
    }
    
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProducts();
        
        return view('admin/pos/index', $data);
    }
    
    public function processSale()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $items = $this->request->getPost('items');
        $cashReceived = $this->request->getPost('cash_received');
        $customerName = $this->request->getPost('customer_name');
        
        if (empty($items)) {
            return redirect()->to('/pos')->with('error', 'No items in cart!');
        }
        
        $saleModel = new SaleModel();
        $productModel = new ProductModel();
        
        $totalAmount = 0;
        $change = 0;
        
        // Process each item
        foreach ($items as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $unitPrice = $item['unit_price'];
            $totalPrice = $quantity * $unitPrice;
            
            // Update product quantity
            $product = $productModel->getProduct($productId);
            if ($product) {
                $newQuantity = $product['quantity'] - $quantity;
                if ($newQuantity < 0) {
                    return redirect()->to('/pos')->with('error', 'Insufficient stock for ' . $product['product_name']);
                }
                $productModel->update($productId, ['quantity' => $newQuantity]);
            }
            
            // Record sale
            $saleModel->insert([
                'product_id' => $productId,
                'quantity_sold' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'cash_received' => $cashReceived,
                'change' => $change,
                'customer_name' => $customerName,
                'sold_at' => date('Y-m-d H:i:s'),
            ]);
            
            $totalAmount += $totalPrice;
        }
        
        // Calculate change
        $change = $cashReceived - $totalAmount;
        
        // Update change for all sales in this transaction
        $saleModel->where('sold_at', date('Y-m-d H:i:s'))->update(['change' => $change]);
        
        return redirect()->to('/pos')->with('success', 'Sale completed successfully!');
    }
    
    public function sales()
    {
        $saleModel = new SaleModel();
        $data['sales'] = $saleModel->getTodaySales();
        $data['summary'] = $saleModel->getDailySalesSummary(7);
        $data['topProducts'] = $saleModel->getTopProducts();
        
        return view('admin/pos/sales', $data);
    }
}
