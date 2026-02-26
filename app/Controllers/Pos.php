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

        $token = bin2hex(random_bytes(16));
        session()->set('pos_token', $token);
        $data['pos_token'] = $token;
        
        return view('admin/pos/index', $data);
    }
    
    public function processSale()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $postedToken = (string) $this->request->getPost('pos_token');
        $sessionToken = (string) session()->get('pos_token');
        if ($postedToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $postedToken)) {
            return redirect()->to('/pos')->with('error', 'Duplicate/invalid submission. Please try again.');
        }
        session()->remove('pos_token');
        
        $items = $this->request->getPost('items');
        $cashReceived = $this->request->getPost('cash_received');
        $customerName = $this->request->getPost('customer_name');
        
        if (empty($items)) {
            return redirect()->to('/pos')->with('error', 'No items in cart!');
        }
        
        $saleModel = new SaleModel();
        $productModel = new ProductModel();
        
        $totalAmount = 0;
        $transactionTime = date('Y-m-d H:i:s');
        
        // Validate cash received
        if (!is_numeric($cashReceived) || $cashReceived < 0) {
            return redirect()->to('/pos')->with('error', 'Invalid cash amount!');
        }

        $cashReceived = (float) $cashReceived;

        // Group items by product_id to prevent duplicate rows in sales
        $groupedItems = [];
        foreach ($items as $item) {
            $productId = isset($item['product_id']) ? (int) $item['product_id'] : 0;
            $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
            $unitPrice = isset($item['unit_price']) ? (float) $item['unit_price'] : 0.0;

            if ($productId <= 0 || $quantity <= 0 || $unitPrice < 0) {
                return redirect()->to('/pos')->with('error', 'Invalid cart item data!');
            }

            if (!isset($groupedItems[$productId])) {
                $groupedItems[$productId] = [
                    'product_id' => $productId,
                    'quantity' => 0,
                    'unit_price' => $unitPrice,
                ];
            }

            $groupedItems[$productId]['quantity'] += $quantity;
            // Keep the latest unit price (or you can enforce same price)
            $groupedItems[$productId]['unit_price'] = $unitPrice;
        }

        foreach ($groupedItems as $item) {
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
            } else {
                return redirect()->to('/pos')->with('error', 'Product not found.');
            }
            
            // Record sale
            $saleModel->insert([
                'product_id' => $productId,
                'quantity_sold' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'cash_received' => $cashReceived,
                'change' => 0,
                'customer_name' => $customerName,
                'sold_at' => $transactionTime,
            ]);
            
            $totalAmount += $totalPrice;
        }
        
        // Calculate change
        $change = $cashReceived - $totalAmount;
        
        // Update change for all sales in this transaction
        $saleModel->builder()->where('sold_at', $transactionTime)->update(['change' => $change]);
        
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
