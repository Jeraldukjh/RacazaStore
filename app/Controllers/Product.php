<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    public function __construct()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
    }
    
    public function index()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProducts();
        
        return view('admin/products/index', $data);
    }
    
    public function create()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        return view('admin/products/create');
    }
    
    public function store()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $productModel = new ProductModel();
        
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'price' => $this->request->getPost('price'),
            'quantity' => $this->request->getPost('quantity'),
            'expiry_date' => $this->request->getPost('expiry_date')
        ];
        
        $productModel->insert($data);
        
        return redirect()->to('/products')->with('success', 'Product added successfully!');
    }
    
    public function edit($id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $productModel = new ProductModel();
        $data['product'] = $productModel->getProduct($id);
        
        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found!');
        }
        
        return view('admin/products/edit', $data);
    }
    
    public function update($id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $productModel = new ProductModel();
        
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'price' => $this->request->getPost('price'),
            'quantity' => $this->request->getPost('quantity'),
            'expiry_date' => $this->request->getPost('expiry_date')
        ];
        
        $productModel->update($id, $data);
        
        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }
    
    public function delete($id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $productModel = new ProductModel();
        $productModel->delete($id);
        
        return redirect()->to('/products')->with('success', 'Product deleted successfully!');
    }
}
