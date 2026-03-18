<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;

class StaffPos extends BaseController
{
    private function isAuthorized(): bool
    {
        return (bool) (session()->get('staff_id') || session()->get('admin_id'));
    }

    public function index()
    {
        if (! $this->isAuthorized()) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $data['products'] = $productModel->getProducts();

        $token = bin2hex(random_bytes(16));
        session()->set('staff_pos_token', $token);
        $data['pos_token'] = $token;

        return view('staff/pos', $data);
    }

    public function processSale()
    {
        if (! $this->isAuthorized()) {
            return redirect()->to('/login');
        }

        $postedToken = (string) $this->request->getPost('pos_token');
        $sessionToken = (string) session()->get('staff_pos_token');
        if ($postedToken === '' || $sessionToken === '' || ! hash_equals($sessionToken, $postedToken)) {
            return redirect()->to('/staff/pos')->with('error', 'Duplicate/invalid submission. Please try again.');
        }
        session()->remove('staff_pos_token');

        $items = $this->request->getPost('items');
        $cashReceived = $this->request->getPost('cash_received');
        $customerName = $this->request->getPost('customer_name');

        if (empty($items)) {
            return redirect()->to('/staff/pos')->with('error', 'No items in cart!');
        }

        $saleModel = new SaleModel();
        $productModel = new ProductModel();

        $totalAmount = 0;
        $transactionTime = date('Y-m-d H:i:s');

        if (! is_numeric($cashReceived) || $cashReceived < 0) {
            return redirect()->to('/staff/pos')->with('error', 'Invalid cash amount!');
        }

        $cashReceived = (float) $cashReceived;

        $groupedItems = [];
        foreach ($items as $item) {
            $productId = isset($item['product_id']) ? (int) $item['product_id'] : 0;
            $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
            $unitPrice = isset($item['unit_price']) ? (float) $item['unit_price'] : 0.0;

            if ($productId <= 0 || $quantity <= 0 || $unitPrice < 0) {
                return redirect()->to('/staff/pos')->with('error', 'Invalid cart item data!');
            }

            if (! isset($groupedItems[$productId])) {
                $groupedItems[$productId] = [
                    'product_id' => $productId,
                    'quantity' => 0,
                    'unit_price' => $unitPrice,
                ];
            }

            $groupedItems[$productId]['quantity'] += $quantity;
            $groupedItems[$productId]['unit_price'] = $unitPrice;
        }

        foreach ($groupedItems as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $unitPrice = $item['unit_price'];
            $totalPrice = $quantity * $unitPrice;

            $product = $productModel->getProduct($productId);
            if ($product) {
                $newQuantity = $product['quantity'] - $quantity;
                if ($newQuantity < 0) {
                    return redirect()->to('/staff/pos')->with('error', 'Insufficient stock for ' . $product['product_name']);
                }
            } else {
                return redirect()->to('/staff/pos')->with('error', 'Product not found.');
            }

            $totalAmount += $totalPrice;
        }

        if ($cashReceived < $totalAmount) {
            session()->set('staff_pos_token', $postedToken);
            return redirect()->to('/staff/pos')->with('error', 'Insufficient cash amount!');
        }

        foreach ($groupedItems as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $unitPrice = $item['unit_price'];
            $totalPrice = $quantity * $unitPrice;
            
            $product = $productModel->getProduct($productId);
            $newQuantity = $product['quantity'] - $quantity;
            $productModel->update($productId, ['quantity' => $newQuantity]);

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

            
        }

        $change = $cashReceived - $totalAmount;
        $saleModel->builder()->where('sold_at', $transactionTime)->update(['change' => $change]);

        return redirect()->to('/staff/pos')->with('success', 'Sale completed successfully!');
    }
}
